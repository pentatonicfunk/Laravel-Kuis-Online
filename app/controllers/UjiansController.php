<?php

class UjiansController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('Admin', array('on' => array('destroy')));
        $this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('ujians.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('ujians.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $lembarId = Input::get('lembar_id');
        try {
            DB::beginTransaction();
            if (!$lembarId)
                throw new Exception('Kode Kuis Tidak ditemukan');

            $lembar = Lembar::find($lembarId);

            if (!$lembar)
                throw new Exception('Lembar tidak ditemukan');

            $userjawablembar = UserJawabLembar::whereRaw('user_id = ? and lembar_id = ?', array(Sentry::getUser()->id, $lembar->id))->get();

            if (!$userjawablembar->isEmpty())
                throw new Exception('Anda sudah pernah mengambil kuis ini, periksa kembali pada Daftar Pengambilan Kuis di dashboard, atau hubungi admin untuk informasi lebih lanjut');

            $userjawablembar            = new UserJawabLembar();
            $userjawablembar->lembar_id = $lembar->id;
            $userjawablembar->user_id   = Sentry::getUser()->id;
            $userjawablembar->wkt_mulai = date('Y-m-d H:i:s');
            $userjawablembar->score     = (4 * 0) - (2 * 0) - (int)$lembar->limit + (int)$lembar->batas_waktu;
            $userjawablembar->save();


            //populate soal
            if ($lembar->is_random) {
                $soalIds = $lembar->soalhaslembar()->orderBy(DB::raw('RAND()'))->limit($lembar->limit)->lists('soal_id');
            } else {
                $soalIds = $lembar->soalhaslembar()->orderBy('soal_has_lembar.created_at')->limit($lembar->limit)->lists('soal_id');
            }

            foreach ($soalIds as $soalId) {
                $userJawab                       = new UserJawab();
                $userJawab->soal_id              = $soalId;
                $userJawab->jawaban_id           = null;
                $userJawab->user_jawab_lembar_id = $userjawablembar->id;
                $userJawab->save();
            }

            DB::commit();

            return Redirect::action('SoalujiansController@show', array($userjawablembar->id, $soalIds[0]))->with('messages',
                array(
                    array('success', 'Selamat Mengerjakan')
                ));

        } catch (Exception $e) {
            DB::rollback();

            Log::error($e);
            return Redirect::action('LembarsController@show', array($lembarId))->with('messages',
                array(
                    array('error', $e->getMessage())
                ));

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $userJawabLembar = UserJawabLembar::find($id);

            if (!$userJawabLembar)
                throw new Exception('Informasi pengambilan kuis tidak ditemukan');

            if ($userJawabLembar->user->id != Sentry::getUser()->id)
                throw new Exception('Detail Ujian ini bukan milik anda');

            $lembar = Lembar::find($userJawabLembar->lembar->id);
            if (!$lembar)
                throw new Exception('Detail Kuis dengan id ' . $userJawabLembar->lembar->id . ' tidak ditemukan');


            //tampilkan jawaban dan soals
            $userJawab = UserJawab::whereRaw('user_jawab_lembar_id = ?', array($userJawabLembar->id))->get();

            $interval = '';
            if ($userJawabLembar->wkt_selesai) {
                $start_date  = new DateTime($userJawabLembar->wkt_mulai);
                $since_start = $start_date->diff(new DateTime($userJawabLembar->wkt_selesai));
                $interval    = $since_start->h . ' jam ' . $since_start->i . ' menit ' . $since_start->s . ' detik';
            }


            //formatting
            foreach ($userJawab as $jawab) {
                $jawab->is_kosong = false;
                $jawab->is_benar  = false;
                if (!$jawab->jawaban_id)
                    $jawab->is_kosong = true;
                else {
                    //get jawaban benar of soal
                    $jawabanBenars = $jawab->soal->jawaban->filter(function ($jawaban) {
                        if ($jawaban->is_benar) {
                            return $jawaban;
                        }
                    });

                    $isBenar = false;
                    foreach ($jawabanBenars as $jawabanBenarFromSoal) {
                        if ($jawab->jawaban_id == $jawabanBenarFromSoal->id) {
                            $isBenar = true;
                        }
                    }

                    if ($isBenar)
                        $jawab->is_benar = true;
                }

            }

            return View::make('ujians.show')
                ->with('lembar', $lembar)
                ->with('userjawablembar', $userJawabLembar)
                ->with('userJawab', $userJawab)
                ->with('interval', $interval);

        } catch (Exception $e) {
            return Redirect::action('DashboardController@index')->with('messages',
                array(
                    array('error', $e->getMessage())
                ));

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        return View::make('ujians.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $userJawabLembar = UserJawabLembar::find($id);

            if (!$userJawabLembar)
                throw new Exception('Informasi pengambilan kuis tidak ditemukan');

            //hapus user jawab
            $userJawab = UserJawab::whereRaw('user_jawab_lembar_id = ? ', array($userJawabLembar->id))->get();
            foreach ($userJawab as $uj) {
                $uj->delete();
            }
            $userJawabLembar->delete();

            DB::commit();
            return Redirect::action('UserjawablembarsController@show', $userJawabLembar->lembar->id)->with('messages',
                array(
                    array('success', 'Pengambilan berhasil dihapus')
                ));

        } catch (Exception $e) {
            DB::rollback();
            if ($userJawabLembar)
                return Redirect::action('UserjawablembarsController@show', $userJawabLembar->lembar->id)->with('messages',
                    array(
                        array('error', $e->getMessage())
                    ));
            else
                return Redirect::action('DashboardController@show')->with('messages',
                    array(
                        array('error', $e->getMessage())
                    ));


        }
    }

}
