<?php

namespace App\Http\Controllers;

use App\Income;
use Illuminate\Http\Request;
use App\Transformers\Income\IncomeResource;
use App\Transformers\Income\IncomeResourceCollection;
use App\Http\Requests\Income\StoreIncome;
use App\Http\Requests\Income\UpdateIncome;
use App\Services\ResponseService;
use App\Repositories\Income\IncomeRepository;

class IncomeController extends Controller
{
    private $income;

    public function __construct(IncomeRepository $income)
    {
        $this->income = $income;
    }

    public function index(){
        return new IncomeResourceCollection($this->income->all());
    }

    public function store(StoreIncome $request){
        try {
            $data = $this
                ->income
                ->create($request->all());
        } catch (\Throwable | \Exception $e) {
            dd($e);
            return ResponseService::exception('income.store', null, $e);
        }

        return new IncomeResource($data, array('type' => 'store', 'route' => 'income.store'));
    }

    public function show($id){
        try {
            $data = $this
                ->income
                ->show($id);
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('income.show', null, $e);
        }

        return new IncomeResource($data, array('type' => 'show', 'route' => 'income.show'));
    }

    public function update(UpdateIncome $request, $id){
        try {
            $data = $this
                ->income
                ->update($request->all(), $id);
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('income.update', $id, $e);
        }

        return new IncomeResource($data, array('type' => 'update', 'route' => 'income.update'));
    }

    public function getMonthIncome($yearMonth){
        try{
            $data = $this
            ->income
            ->getMonthIncomes($yearMonth);
        }catch(\Throwable|\Exception $e){
            dd($e);
            return ResponseService::exception('income.getMonth',$yearMonth,$e);
        }

        return new IncomeResourceCollection($data);
    }

    public function destroy($id){
        try{
            $data = $this
            ->income
            ->destroy($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('income.destroy',$id,$e);
        }
        return new IncomeResource($data,array('type' => 'destroy','route' => 'income.destroy'));
    }
}
