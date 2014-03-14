<?php

class LembarsController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('Admin', array('on' => array('show')));
        $this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $lembars = Lembar::orderBy('updated_at', 'desc')->paginate(10);
        $count   = Lembar::count();

        return View::make('lembars.index')
            ->with('lembars', $lembars)
            ->with('count', $count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $kategoris      = Kategori::all();
        $kategoriselect = array();
        foreach ($kategoris as $kategori) {
            $kategoriselect[$kategori->id] = $kategori->nama;
        }

        return View::make('lembars.create')
            ->with('kategoriselect', $kategoriselect);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        try {
            DB::beginTransaction();
            $save = $this->save(true);
            DB::commit();

            return Redirect::action('LembarsController@show', $save)->with('messages',
                array(
                    array('success', 'Kuis Baru Berhasil dibuat')
                ));

        } catch (Exception $e) {
            DB::rollback();
            return Redirect::action('LembarsController@create')->with('messages',
                array(
                    array('error', $e->getMessage())
                ))->withInput();
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
            $lembar = Lembar::find($id);
            if (!$lembar)
                throw new Exception('Detail Kuis dengan id ' . $id . ' tidak ditemukan');

            $soalhaslembar = $lembar->soalhaslembar->sortBy(function ($model) {
                $model->created_at;
            });

            $countBankSoal = Soal::count();
            if (!$soalhaslembar->isEmpty())
                $banksoal = Soal::whereNotIn('id', $soalhaslembar->lists('id'))->orderBy('created_at', 'desc')->get();
            else
                $banksoal = Soal::all()->sortBy(function ($model) {
                    $model->created_at;
                });

            return View::make('lembars.show')
                ->with('lembar', $lembar)
                ->with('banksoal', $banksoal)
                ->with('countBankSoal', $countBankSoal)
                ->with('soalhaslembar', $soalhaslembar);

        } catch (Exception $e) {
            return Redirect::action('LembarsController@index')->with('messages',
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
        try {
            $kategoris      = Kategori::all();
            $kategoriselect = array();
            foreach ($kategoris as $kategori) {
                $kategoriselect[$kategori->id] = $kategori->nama;
            }

            $lembar = Lembar::find($id);
            if (!$lembar)
                throw new Exception('Detail Kuis dengan id ' . $id . ' tidak ditemukan');

            return View::make('lembars.edit')->with('lembar', $lembar)->with('kategoriselect', $kategoriselect);

        } catch (Exception $e) {
            return Redirect::action('LembarsController@index')->with('messages',
                array(
                    array('error', $e->getMessage())
                ));

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        try {
            DB::beginTransaction();
            $save = $this->save(false, $id);
            DB::commit();

            return Redirect::action('LembarsController@show', $save)->with('messages',
                array(
                    array('success', 'Kuis Berhasil Diperbaharui')
                ));

        } catch (Exception $e) {
            DB::rollback();
            return Redirect::action('LembarsController@edit', $id)->with('messages',
                array(
                    array('error', $e->getMessage())
                ))->withInput();
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
        try {

            if (!$id)
                throw new Exception('kode lembar tidak ditemukan');

            $lembar = Lembar::find($id);

            if (!$lembar)
                throw new Exception('soal tidak ditemukan');

            DB::beginTransaction();

            $lembar->SoalHasLembar->each(function ($soal) {
                $soal->delete();
            });

            $lembar->soalhaslembar->each(function ($soal) {
                $soal->delete();
            });

            $lembar->userjawablembar->each(function ($userJawabLembar) {
                $userJawabLembar->userjawab->each(function ($userJawab) {
                    $userJawab->delete();
                });
            });

            $lembar->userjawablembar->each(function ($userJawabLembar) {
                $userJawabLembar->delete();
            });


            $lembar->delete();
            DB::commit();

            return Redirect::action('LembarsController@index')->with('messages',
                array(
                    array('success', 'Kuis Berhasil Dihapus')
                ));

        } catch (Exception $e) {
            DB::rollback();
            return Redirect::action('LembarsController@show', array($id))->with('messages',
                array(
                    array('error', $e->getMessage())
                ));

        }
    }


    /**
     * Logic of saving  a lembar
     * @param bool $isInsert
     * @param null $id
     * @return mixed
     * @throws Exception
     */
    private function save($isInsert = false, $id = null)
    {
        $validator = Validator::make(
            Input::all(),
            array(
                'Judul'       => 'required',
                'Kategori'    => 'required|in:1,2',
                'Jumlah_Soal' => 'required|numeric|min:1',
                'Batas_Waktu' => 'required|numeric|min:1',
            )
        );


        if ($validator->fails()) {

            $messages = $validator->messages();
            throw new Exception($messages->first());
        } else {
            if ($isInsert)
                $lembar = new Lembar();
            else
                $lembar = Lembar::find($id);

            $lembar->nama        = Input::get('Judul');
            $lembar->keterangan  = Input::get('Keterangan');
            $lembar->kategori_id = Input::get('Kategori');
            $lembar->user_id     = Sentry::getUser()->id;
            $lembar->limit       = (int)Input::get('Jumlah_Soal');
            $lembar->is_random   = (int)Input::get('Acak_Soal');
            $lembar->batas_waktu = (int)Input::get('Batas_Waktu');

            if (!$lembar->save())
                throw new Exception('Gagal Menyimpan Kuis');

            return $lembar->id;

        }
    }

}
