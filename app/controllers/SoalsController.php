<?php

class SoalsController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('Admin');
        $this->beforeFilter('csrf', array('on' => array('post', 'delete', 'put')));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $soals = Soal::orderBy('updated_at', 'desc')->paginate(10);

        $count = Soal::count();

        return View::make('soals.index')
            ->with('soals', $soals)
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

        return View::make('soals.create')
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
            return Redirect::action('SoalsController@show', $save)->with('messages',
                array(
                    array('success', 'Soal Baru Berhasil dibuat')
                ));
        } catch (Exception $e) {
            DB::rollback();
            return Redirect::action('SoalsController@create')->with('messages',
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
            $soal = Soal::find($id);
            if (!$soal)
                throw new Exception('Detail Soal dengan id ' . $id . ' tidak ditemukan');

            return View::make('soals.show')->with('soal', $soal);

        } catch (Exception $e) {
            return Redirect::action('SoalsController@index')->with('messages',
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

            $soal = Soal::find($id);
            if (!$soal)
                throw new Exception('Detail Soal dengan id ' . $id . ' tidak ditemukan');

            return View::make('soals.edit')->with('soal', $soal)->with('kategoriselect', $kategoriselect);

        } catch (Exception $e) {
            return Redirect::action('SoalsController@index')->with('messages',
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

            return Redirect::action('SoalsController@show', $save)->with('messages',
                array(
                    array('success', 'Soal Berhasil Diperbaharui')
                ));

        } catch (Exception $e) {
            DB::rollback();
            return Redirect::action('SoalsController@edit', $id)->with('messages',
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
                throw new Exception('kode soal tidak ditemukan');

            $soal = Soal::find($id);

            if (!$soal)
                throw new Exception('soal tidak ditemukan');

            DB::beginTransaction();

            $soal->jawaban->each(function ($jawaban) {
                $jawaban->userjawab->each(function ($userjawab) {
                    $userjawab->delete();
                });

            });
            $soal->jawaban->each(function ($jawaban) {
                $jawaban->delete();

            });

            $soal->soalhaslembar()->detach();

            $soal->delete();
            DB::commit();

            return Redirect::action('SoalsController@index')->with('messages',
                array(
                    array('success', 'Soal Berhasil Dihapus')
                ));

        } catch (Exception $e) {
            DB::rollback();
            return Redirect::action('SoalsController@show', array($id))->with('messages',
                array(
                    array('error', $e->getMessage())
                ));

        }
    }

    /**
     * Logic of saving  a soal
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
                'Pertanyaan'      => 'required',
                'Kategori'        => 'required|in:1,2',
                'Estimasi_Durasi' => 'required|numeric|min:1|max:15',
                'Jawaban_A'       => 'required',
                'Jawaban_B'       => 'required',
                'Jawaban_C'       => 'required',
                'Jawaban_D'       => 'required',
                'Point_Jawaban_A' => 'numeric|min:0',
                'Point_Jawaban_B' => 'numeric|min:0',
                'Point_Jawaban_C' => 'numeric|min:0',
                'Point_Jawaban_D' => 'numeric|min:0',
            )
        );


        if ($validator->fails()) {

            $messages = $validator->messages();
            throw new Exception($messages->first());
        } else {
            if ($isInsert)
                $soal = new Soal;
            else
                $soal = Soal::find($id);

            $soal->pertanyaan  = Input::get('Pertanyaan');
            $soal->kategori_id = Input::get('Kategori');
            $soal->user_id     = Sentry::getUser()->id;
            $soal->durasi      = (int)Input::get('Estimasi_Durasi');

            if (!$soal->save())
                throw new Exception('Gagal Menyimpan Soal');

            if ($isInsert)
                $jawaban = new Jawaban();
            else
                $jawaban = $soal->jawaban[0];
            //a
            $jawaban->jawaban  = Input::get('Jawaban_A');
            $jawaban->is_benar = (int)Input::get('a_is_benar');
            $jawaban->poin     = (int)Input::get('Point_Jawaban_A');
            $jawaban->soal_id  = $soal->id;
            if (!$jawaban->save())
                throw new Exception('Gagal Menyimpan Jawaban A');

            if ($isInsert)
                $jawaban = new Jawaban();
            else
                $jawaban = $soal->jawaban[1];
            //b
            $jawaban->jawaban  = Input::get('Jawaban_B');
            $jawaban->is_benar = (int)Input::get('b_is_benar');
            $jawaban->poin     = (int)Input::get('Point_Jawaban_B');
            $jawaban->soal_id  = $soal->id;
            if (!$jawaban->save())
                throw new Exception('Gagal Menyimpan Jawaban B');

            if ($isInsert)
                $jawaban = new Jawaban();
            else
                $jawaban = $soal->jawaban[2];
            //c
            $jawaban->jawaban  = Input::get('Jawaban_C');
            $jawaban->is_benar = (int)Input::get('c_is_benar');
            $jawaban->poin     = (int)Input::get('Point_Jawaban_C');
            $jawaban->soal_id  = $soal->id;
            if (!$jawaban->save())
                throw new Exception('Gagal Menyimpan Jawaban C');

            if ($isInsert)
                $jawaban = new Jawaban();
            else
                $jawaban = $soal->jawaban[3];
            //c
            $jawaban->jawaban  = Input::get('Jawaban_D');
            $jawaban->is_benar = (int)Input::get('d_is_benar');
            $jawaban->poin     = (int)Input::get('Point_Jawaban_D');
            $jawaban->soal_id  = $soal->id;
            if (!$jawaban->save())
                throw new Exception('Gagal Menyimpan Jawaban D');

            return $soal->id;

        }
    }

}
