<?php

class DashboardController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $soals      = Soal::orderBy('updated_at', 'desc')->limit(5)->get();
        $soalscount = Soal::count();

        $lembars         = Lembar::orderBy('updated_at', 'desc')->get();
        $lembarscount    = Lembar::count();
        $userJawabLembar = UserJawabLembar::whereRaw('user_id = ?', array(Sentry::getUser()->id))->orderBy('id', 'desc')->get();

        return View::make('dashboards.index')
            ->with('soals', $soals)
            ->with('soalscount', $soalscount)
            ->with('lembars', $lembars)
            ->with('userJawabLembars', $userJawabLembar)
            ->with('lembarscount', $lembarscount);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('dashboards.create');
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
        return View::make('dashboards.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        return View::make('dashboards.edit');
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
