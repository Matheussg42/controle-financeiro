<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Transformers\Payment\PaymentResource;
use App\Transformers\Payment\PaymentResourceCollection;
use App\Http\Requests\Payment\StorePayment;
use App\Http\Requests\Payment\UpdatePayment;
use App\Services\ResponseService;
use App\Http\Controllers\Notification;
use App\Repositories\Payments\PaymentRepository;

class PaymentController extends Controller
{
    private $payment;

    public function __construct(PaymentRepository $payment){
        $this->payment = $payment;
    }

    public function index()
    {
        return new PaymentResourceCollection($this->payment->all());
    }

    public function store(StorePayment $request)
    {
        try{        
            $data = $this
            ->payment
            ->create($request->all());
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-installments.store',null,$e);
        }

        return new PaymentResource($data,array('type' => 'store','route' => 'payment-installments.store'));
    }

    public function show($id)
    {
        try{        
            $data = $this
            ->payment
            ->show($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-installments.show',null,$e);
        }

        return new PaymentResource($data,array('type' => 'show','route' => 'payment-installments.show'));
    }

    public function update(UpdatePayment $request, $id)
    {
        try{        
            $data = $this
            ->payment
            ->update($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-installments.update',$id,$e);
        }

        return new PaymentResource($data,array('type' => 'update','route' => 'payment-installments.update'));
    }

    public function destroy($id)
    {
        try{
            $data = $this
            ->payment
            ->destroy($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-installments.destroy',$id,$e);
        }
        return new PaymentResource($data,array('type' => 'destroy','route' => 'payment-installments.destroy')); 
    }
}
