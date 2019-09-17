<?php

namespace App\Http\Controllers;

use App\IncomeInstallments;
use Illuminate\Http\Request;
use App\Transformers\IncomeInstallments\IncomeInstallmentsResource;
use App\Transformers\IncomeInstallments\IncomeInstallmentsResourceCollection;
use App\Http\Requests\IncomeInstallments\StoreIncomeInstallments;
use App\Http\Requests\IncomeInstallments\UpdateIncomeInstallments;
use App\Services\ResponseService;
use App\Repositories\Income\IncomeInstallmentsRepository;

class IncomeInstallmentsController extends Controller
{
    private $incomeInstallments;

    public function __construct(IncomeInstallmentsRepository $incomeInstallments)
    {
        $this->incomeInstallments = $incomeInstallments;
    }

    public function index(){
        return new IncomeInstallmentsResourceCollection($this->incomeInstallments->all());
    }

    public function store(StoreIncomeInstallments $request)
    {
        try {
            $data = $this
                ->incomeInstallments
                ->create($request->all());
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('income-installments.store', null, $e);
        }

        return new IncomeInstallmentsResource($data, array('type' => 'store', 'route' => 'income-installments.store'));
    }

    public function show($id)
    {
        try {
            $data = $this
                ->incomeInstallments
                ->show($id);
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('income-installments.show', null, $e);
        }

        return new IncomeInstallmentsResource($data, array('type' => 'show', 'route' => 'income-installments.show'));
    }

    public function update(UpdateIncomeInstallments $request, $id){
        try {
            $data = $this
                ->incomeInstallments
                ->update($request->all(), $id);
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('income-installments.update', $id, $e);
        }

        return new IncomeInstallmentsResource($data, array('type' => 'update', 'route' => 'income-installments.update'));
    }

    public function destroy($id){
        try{
            $data = $this
            ->incomeInstallments
            ->destroy($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('income-installments.destroy',$id,$e);
        }
        return new IncomeInstallmentsResource($data,array('type' => 'destroy','route' => 'income-installments.destroy')); 
    }
}
