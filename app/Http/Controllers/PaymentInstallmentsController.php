<?php

namespace App\Http\Controllers;

use App\PaymentInstallments;
use Illuminate\Http\Request;
use App\Transformers\PaymentInstallments\PaymentInstallmentsResource;
use App\Transformers\PaymentInstallments\PaymentInstallmentsResourceCollection;
use App\Http\Requests\PaymentInstallments\StorePaymentInstallments;
use App\Http\Requests\PaymentInstallments\UpdatePaymentInstallments;
use App\Services\ResponseService;
use App\Repositories\Payments\PaymentInstallmentsRepository;

class PaymentInstallmentsController extends Controller
{
    private $paymentInstallments;

    public function __construct(PaymentInstallmentsRepository $paymentInstallments){
        $this->paymentInstallments = $paymentInstallments;
    }

    public function index()
    {
        return new PaymentInstallmentsResourceCollection($this->paymentInstallments->all());
    }

    public function store(StorePaymentInstallments $request)
    {
        try{        
            $data = $this
            ->paymentInstallments
            ->create($request->all());
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-installments.store',null,$e);
        }

        return new PaymentInstallmentsResource($data,array('type' => 'store','route' => 'payment-installments.store'));
    }

    public function show($id)
    {
        try{        
            $data = $this
            ->paymentInstallments
            ->show($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-installments.show',null,$e);
        }

        return new PaymentInstallmentsResource($data,array('type' => 'show','route' => 'payment-installments.show'));
    }

    public function update(UpdatePaymentInstallments $request, $id)
    {
        try{        
            $data = $this
            ->paymentInstallments
            ->update($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-installments.update',$id,$e);
        }

        return new PaymentInstallmentsResource($data,array('type' => 'update','route' => 'payment-installments.update'));
    }

    public function destroy($id)
    {
        try{
            $data = $this
            ->paymentInstallments
            ->destroy($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-installments.destroy',$id,$e);
        }
        return new PaymentInstallmentsResource($data,array('type' => 'destroy','route' => 'payment-installments.destroy')); 
    }
}
