<?php

namespace App\Http\Controllers;

use App\PaymentType;
use Illuminate\Http\Request;
use App\Transformers\PaymentType\PaymentTypeResource;
use App\Transformers\PaymentType\PaymentTypeResourceCollection;
use App\Http\Requests\PaymentType\StorePaymentType;
use App\Http\Requests\PaymentType\UpdatePaymentType;
use App\Services\ResponseService;
use App\Http\Controllers\Notification;
use App\Repositories\Payments\PaymentTypeRepository;

class PaymentTypeController extends Controller
{
    private $paymentType;

    public function __construct(PaymentTypeRepository $paymentType){
        $this->paymentType = $paymentType;
    }

    public function index()
    {
        return new PaymentTypeResourceCollection($this->paymentType->all());
    }

    public function store(StorePaymentType $request)
    {
        try{        
            $data = $this
            ->paymentType
            ->create($request->all());
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-types.store',null,$e);
        }

        return new PaymentTypeResource($data,array('type' => 'store','route' => 'payment-types.store'));
    }

    public function show($id)
    {
        try{        
            $data = $this
            ->paymentType
            ->show($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-types.show',null,$e);
        }

        return new PaymentTypeResource($data,array('type' => 'show','route' => 'payment-types.show'));
    }

    public function update(UpdatePaymentType $request, $id)
    {
        try{        
            $data = $this
            ->paymentType
            ->update($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-types.update',$id,$e);
        }

        return new PaymentTypeResource($data,array('type' => 'update','route' => 'payment-types.update'));
    }

    public function destroy($id)
    {
        try{
            $data = $this
            ->paymentType
            ->destroy($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payment-types.destroy',$id,$e);
        }
        return new PaymentTypeResource($data,array('type' => 'destroy','route' => 'payment-types.destroy')); 
    }
}
