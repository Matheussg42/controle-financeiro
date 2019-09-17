<?php

namespace App\Http\Controllers;

use App\Bill;
use Illuminate\Http\Request;
use App\Transformers\Bill\BillResource;
use App\Transformers\Bill\BillResourceCollection;
use App\Http\Requests\Bill\StoreBill;
use App\Http\Requests\Bill\UpdateBill;
use App\Services\ResponseService;
use App\Http\Controllers\Notification;
use App\Repositories\Bill\BillRepository;

class BillController extends Controller
{
    private $bill;

    public function __construct(BillRepository $bill){
        $this->bill = $bill;
    }

    public function index()
    {
        return new BillResourceCollection($this->bill->all());
    }

    public function store(StoreBill $request)
    {
        try{        
            $data = $this
            ->bill
            ->create($request->all());
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('bills.store',null,$e);
        }

        return new BillResource($data,array('type' => 'store','route' => 'bills.store'));
    }

    public function show($id)
    {
        try{        
            $data = $this
            ->bill
            ->show($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('bills.show',null,$e);
        }

        return new BillResource($data,array('type' => 'show','route' => 'bills.show'));
    }

    public function update(UpdateBill $request, $id)
    {
        try{        
            $data = $this
            ->bill
            ->update($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('bills.update',$id,$e);
        }

        return new BillResource($data,array('type' => 'update','route' => 'bills.update'));
    }

    public function destroy($id)
    {
        try{
            $data = $this
            ->bill
            ->destroy($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('bills.destroy',$id,$e);
        }
        return new BillResource($data,array('type' => 'destroy','route' => 'bills.destroy')); 
    }
}
