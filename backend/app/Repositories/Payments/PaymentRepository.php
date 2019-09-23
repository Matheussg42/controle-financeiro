<?php

namespace App\Repositories\Payments;

use App\Payment;
use Carbon\Carbon;
use App\Repositories\Month\MonthRepository;

class PaymentRepository
{
    public function all(){
        return auth()
        ->user()
        ->payment;
    }

    public function create($fields)
    {
        return auth()
        ->user()
        ->payment()
        ->create($fields);
    }

    public function show($id)
    {
        $payment = auth()
        ->user()
        ->payment()
        ->find($id);

        if (!$payment) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $payment;
    }

    public function update($fields, $id)
    {
        $payment = $this->show($id);

        $payment->update($fields);
        return $payment;
    }

    public function getMonthPayments($yearMonth)
    {
        $payments =  auth()->user()->month()->find($yearMonth)->payment;

        return $payments;
    }

    public function currentMonthPayments()
    {
        $MonthRepository = new MonthRepository;
        $yearMonth = $MonthRepository->getCurrentMonth();

        $payments = auth()
        ->user()
        ->income()
        ->where('yearMonth', '=', $yearMonth->id)->get();

        return $payments;
    }

    public function destroy($id)
    {
        $payment = $this->show($id);

        $payment->delete();
        return $payment;
    }
}
