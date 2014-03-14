<?php

class UserjawablembarsController extends BaseController
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
        return View::make('userjawablembars.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('userjawablembars.create');
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
    public function show($id)
    {
        try {
            $userjawablembar = UserJawabLembar::whereRaw('lembar_id = ? and wkt_selesai is not null', array($id))
                ->orderBy('score', 'desc')
                ->orderBy('int_time', 'asc')->get(
                    array(DB::raw("TIMEDIFF(wkt_selesai, wkt_mulai) as 'int_time'"),
                        DB::raw('user_jawab_lembar.*')
                    ));

            $lembar = Lembar::find($id);

            if (!$lembar)
                throw new Exception('Detail Lembar dengan kode ' . $id . ' tidak ditemukan');

            if (!$userjawablembar->isEmpty()) {
                foreach ($userjawablembar as $ujb) {
                    $start_date    = new DateTime($ujb->wkt_mulai);
                    $since_start   = $start_date->diff(new DateTime($ujb->wkt_selesai));
                    $ujb->interval = $since_start->h . ' jam ' . $since_start->i . ' menit ' . $since_start->s . ' detik';
                }
            }

            return View::make('userjawablembars.show')
                ->with('userJawabLembars', $userjawablembar)
                ->with('lembar', $lembar);

        } catch (Exception $e) {
            Log::error($e);
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
        return View::make('userjawablembars.edit');
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
    public function destroy($id)
    {
        //
    }

}
