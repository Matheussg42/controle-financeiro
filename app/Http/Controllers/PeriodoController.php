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
    public function show($id)
    {
        try{        
            $data = $this->periodo->show($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('periodos.show',null,$e);
        }

        return new PeriodoResource($data,array('type' => 'show','route' => 'periodos.show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeriodo $request, $id)
    {
        try{        
            $data = $this->periodo->update($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('periodos.update',$id,$e);
        }

        return new PeriodoResource($data,array('type' => 'update','route' => 'periodos.update'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function close($id)
    {
        try{        
            $data = $this->periodo->close($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('periodos.close', $id, $e);
        }

        return new PeriodoResource($data,array('type' => 'update','route' => 'periodos.close'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Periodo  $periodo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $data = $this->periodo->destroy($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('periodos.destroy',$id,$e);
        }
        return new PeriodoResource($data,array('type' => 'destroy','route' => 'periodos.destroy')); 
    }
}
