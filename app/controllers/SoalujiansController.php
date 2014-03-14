<?php

class SoalujiansController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('soalujians.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('soalujians.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($userjawablembarId, $soalId = 0)
    {
        try {
            $userJawabLembar = UserJawabLembar::find($userjawablembarId);

            if (!$userJawabLembar)
                throw new Exception('Ujian tidak ditemukan');

            if (Sentry::getUser()->id != $userJawabLembar->user->id)
                throw new Exception('Ujian ini bukan untuk anda');

            //populate soal id
            $userJawabBelum = UserJawab::whereRaw('user_jawab_lembar_id = ? and jawaban_id is null', array($userJawabLembar->id));
            $userJawabAll   = UserJawab::whereRaw('user_jawab_lembar_id = ?', array($userJawabLembar->id));
            $soalIds        = $userJawabBelum->lists('soal_id');
            $AllsoalIds     = $userJawabAll->lists('soal_id');

            if (!$soalId)
                return Redirect::action('SoalujiansController@show', array($userJawabLembar->id, $soalIds[0]));

            if (!in_array($soalId, $soalIds))
                throw new Exception('Soal bukan termasuk dalam ujian');


            $nomor = array_keys($AllsoalIds, $soalId);
            $nomor = $nomor[0] + 1;

            //soal sudah terjawab semua
            $isLastSoal = false;
            if (sizeof($soalIds) == 1 && $soalId == $soalIds[0])
                $isLastSoal = true;

            $nextSoal = false;
            if (!$isLastSoal) {
                //get next soal
                //adalah soal terakhir
                $currentKey = array_keys($soalIds, $soalId);
                $currentKey = $currentKey[0];
                if ($soalIds[count($soalIds) - 1] == $soalId) {
                    //find sebelumnya
                    $nextSoal = $soalIds[0];
                } else {
                    $nextSoal = $soalIds[$currentKey + 1];
                }
            }

            $startTime = strtotime($userJawabLembar->wkt_mulai);
            $maxTime   = strtotime('+' . $userJawabLembar->lembar->batas_waktu . ' minutes', $startTime);

            if ($userJawabLembar->wkt_selesai)
                throw new Exception('Anda sudah menyelesaikan kuis ini');

            //check waktu
            if (time() > $maxTime) {
                //update waktu selesai jika diperlukan
                if (!$userJawabLembar->wkt_selesai) {
                    $userJawabLembar->wkt_selesai = date('Y-m-d H:i:s');
                    $userJawabLembar->save();
                }
                throw new Exception('Waktu mengerjakan sudah habis');
            }

            if ($startTime > time())
                throw new Exception('Waktu mengerjakan belum dimulai');

            $soal = Soal::find($soalId);

            if (!$soal)
                throw new Exception('Detail Soal dengan id ' . $soalId . ' tidak ditemukan');

            return View::make('soalujians.show')
                ->with('soal', $soal)
                ->with('userjawablembar', $userJawabLembar)
                ->with('is_last_soal', $isLastSoal)
                ->with('next_soal', $nextSoal)
                ->with('nomor', $nomor)
                ->with('all_soal_ids', $AllsoalIds)
                ->with('max_time', date('Y/m/d H:i:s', $maxTime));

        } catch (Exception $e) {
            return Redirect::action('LembarsController@show', array($userJawabLembar->lembar->id))->with('messages',
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
        return View::make('soalujians.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($userjawablembarId, $soalId)
    {
        //check time
        //update user jawab
        //update score
        //go to next soal
        try {
            DB::beginTransaction();
            $userJawabLembar = UserJawabLembar::find($userjawablembarId);

            if (!$userJawabLembar)
                throw new Exception('Ujian tidak ditemukan');

            if (Sentry::getUser()->id != $userJawabLembar->user->id)
                throw new Exception('Ujian ini bukan untuk anda');

            //populate soal id
            $userJawabBelum = UserJawab::whereRaw('user_jawab_lembar_id = ? and jawaban_id is null', array($userJawabLembar->id));
            $soalIds        = $userJawabBelum->lists('soal_id');

            if (!in_array($soalId, $soalIds))
                throw new Exception('Soal bukan termasuk dalam ujian atau sudah anda kerjakan');

            if (!Input::get('jawaban'))
                return Redirect::action('SoalujiansController@show', array($userJawabLembar->id, $soalId))->with('messages',
                    array(
                        array('error', 'Silakan pilih jawaban atau tekan tombol LEWATI untuk melewati soal ini')
                    ));

            //soal sudah terjawab semua
            $isLastSoal = false;
            if (sizeof($soalIds) == 1 && $soalId == $soalIds[0])
                $isLastSoal = true;

            $nextSoal = false;
            if (!$isLastSoal) {
                //get next soal
                //adalah soal terakhir
                $currentKey = array_keys($soalIds, $soalId);
                $currentKey = $currentKey[0];
                if ($soalIds[count($soalIds) - 1] == $soalId) {
                    //find sebelumnya
                    $nextSoal = $soalIds[0];
                } else {
                    $nextSoal = $soalIds[$currentKey + 1];
                }
            }

            $startTime = strtotime($userJawabLembar->wkt_mulai);
            $maxTime   = strtotime('+' . $userJawabLembar->lembar->batas_waktu . ' minutes', $startTime);

            if ($userJawabLembar->wkt_selesai)
                throw new Exception('Anda sudah menyelesaikan kuis ini');

            //check waktu
            if (time() > $maxTime) {
                //update waktu selesai jika diperlukan
                if (!$userJawabLembar->wkt_selesai) {
                    $userJawabLembar->wkt_selesai = date('Y-m-d H:i:s');
                    $userJawabLembar->save();
                }
                throw new Exception('Waktu mengerjakan sudah habis');
            }

            if ($startTime > time())
                throw new Exception('Waktu mengerjakan belum dimulai');

            $soal = Soal::find($soalId);

            if (!$soal)
                throw new Exception('Detail Soal dengan id ' . $soalId . ' tidak ditemukan');

            $jawaban = (int)Input::get('jawaban');
            if (!in_array($jawaban, $soal->jawaban()->lists('id')))
                throw new Exception('Jawaban tidak ada dalam sistem');


            $userJawab = UserJawab::whereRaw('user_jawab_lembar_id = ? and soal_id = ? and jawaban_id is null', array($userJawabLembar->id, $soal->id))->first();
            if (!$userJawab)
                throw new Exception('Soal bukan termasuk dalam ujian atau sudah anda kerjakan');

            $userJawab->jawaban_id = $jawaban;
            $userJawab->save();

            //check score
            $userJawabLembar->calcScore();
            $userJawabLembar->save();

            DB::commit();

            if (!$isLastSoal)
                return Redirect::action('SoalujiansController@show', array($userJawabLembar->id, $nextSoal));

            $userJawabLembar->wkt_selesai = date('Y-m-d H:i:s');
            $userJawabLembar->save();
            return Redirect::action('UjiansController@show', array($userJawabLembar->id));

        } catch (Exception $e) {
            DB::rollback();
            return Redirect::action('UjiansController@show', array($userJawabLembar->id))->with('messages',
                array(
                    array('error', $e->getMessage())
                ));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
