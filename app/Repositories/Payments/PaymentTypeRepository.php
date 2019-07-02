<?php

namespace App\Repositories\Payments;

use App\PaymentType;
use DB;

class PaymentTypeRepository
{
    public function all(){
        return auth()
        ->user()
        ->paymentType;
    }

    public function create($fields)
    {
        return auth()
        ->user()
        ->paymentType()
        ->create($fields);
    }

    public function show($id)
    {


        $paymentType = auth()
        ->user()
        ->paymentType()
        ->find($id);

        if (!$paymentType) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $paymentType;
    }

    public function update($fields, $id)
    {
        $paymentType = $this->show($id);

        $paymentType->update($fields);
        return $paymentType;
    }

    public function destroy($id)
    {
        $paymentType = $this->show($id);

        $paymentType->delete();
        return $paymentType;
    }

    public function getTypeName($id){
        $name = DB::table('payment_types')->where('id', $id)->pluck('name')->first();
        if (!$name) {
            $name = $id;
        }
        return $name;
    }
}
