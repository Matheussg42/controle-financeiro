<?php

namespace App\Repositories\Payments;

use App\PaymentInstallments;
use Carbon\Carbon;

class PaymentInstallmentsRepository
{
    public function all(){
        return auth()
        ->user()
        ->paymentInstallments;
    }

    public function create($fields)
    {
        return auth()
        ->user()
        ->paymentInstallments()
        ->create($fields);
    }

    public function show($id)
    {


        $paymentInstallments = auth()
        ->user()
        ->paymentInstallments()
        ->find($id);

        if (!$paymentInstallments) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $paymentInstallments;
    }

    public function update($fields, $id)
    {
        $paymentInstallments = $this->show($id);

        $paymentInstallments->update($fields);
        return $paymentInstallments;
    }

    public function destroy($id)
    {
        $paymentInstallments = $this->show($id);

        $paymentInstallments->delete();
        return $paymentInstallments;
    }
}
