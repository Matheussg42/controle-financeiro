<?php

namespace App\Http\Controllers;

use App\Periodo;
use Illuminate\Http\Request;
use App\Transformers\Periodo\PeriodoResource;
use App\Transformers\Periodo\PeriodoResourceCollection;
use App\Http\Requests\Periodo\StorePeriodo;
use App\Http\Requests\Periodo\UpdatePeriodo;
use App\Services\ResponseService;
use App\Http\Controllers\Notification;
use App\Repositories\Periodo\PeriodoRepository;

class PeriodoController extends Controller
{
    private $periodo;

    public function __construct(PeriodoRepository $periodo){
        $this->periodo = $periodo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PeriodoResourceCollection($this->periodo->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeriodo $request)
    {
        try{        
            $data = $this->periodo->create($request->all());
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('periodos.store',null,$e);
        }

        return new PeriodoResource($data,array('type' => 'store','route' => 'periodos.store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function show(Periodo $periodo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function edit(Periodo $periodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periodo $periodo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periodo $periodo)
    {
        //
    }
}
