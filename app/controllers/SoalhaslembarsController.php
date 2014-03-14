<?php

class SoalhaslembarsController extends BaseController
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
        return View::make('soalhaslembars.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('soalhaslembars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($lembarId)
    {

        $soalId = Input::get('soal_id');
        try {
            DB::beginTransaction();
            if (!$soalId)
                throw new Exception('Kode Soal Tidak ditemukan');

            $soal = Soal::find($soalId);

            if (!$soal)
                throw new Exception('Soal Tidak ditemukan');

            $lembar = Lembar::find($lembarId);
            if (in_array($soalId, $lembar->soalhaslembar->lists('id')))
                throw new Exception('Soal sudah pernah dimasukkan sebelumnya pada kuis ini');

            $lembar->touch();
            $lembar->soalhaslembar()->attach($soal->id);

            DB::commit();

            return Redirect::action('LembarsController@show', array($lembar->id))->with('messages',
                array(
                    array('success', 'Soal berhasil dimasukkan ke dalam kuis')
                ));

        } catch (Exception $e) {
            DB::rollback();

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
        return View::make('soalhaslembars.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        return View::make('soalhaslembars.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($lembarId)
    {
        $soalId = Input::get('soal_id');
        try {
            DB::beginTransaction();
            if (!$soalId)
                throw new Exception('Kode Soal Tidak ditemukan');

            $lembar = Lembar::find($lembarId);
            if (!in_array($soalId, $lembar->soalhaslembar->lists('id')))
                throw new Exception('Soal tidak pernah dimasukkan sebelumnya pada kuis ini');

            $lembar->touch();
            $lembar->soalhaslembar()->detach($soalId);

            DB::commit();

            return Redirect::action('LembarsController@show', array($lembar->id))->with('messages',
                array(
                    array('success', 'Soal berhasil dihapus dari kuis')
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

}
