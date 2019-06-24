<?php

namespace App\Repositories\Payments;

use App\PaymentType;
use Carbon\Carbon;

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
}
