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

        if (!$payment) {
            throw new \Exception('Nada Encontrado', -404);
        }

        $payment->update($fields);
        return $payment;
    }

    public function getMonthPayments($yearMonth)
    {
        $payments = auth()
        ->user()
        ->payment()
        ->where('yearMonth', '=', $yearMonth)->get();

        return $payments;
    }

    public function getMonthTotalPayments($yearMonth)
    {
        $totalValue = 0;
        $payments = $this->getMonthPayments($yearMonth);

        foreach($payments as $payment){
            $totalValue +=$payment['value'];
        }

        return $totalValue;
    }

    public function currentMonthPayments()
    {
        $MonthRepository = new MonthRepository;
        $yearMonth = $MonthRepository->getCurrentMonth();

        $payments = $this->getMonthPayments($yearMonth->id); 

        if (count($payments) === 0) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $payments;
    }

    public function destroy($id)
    {
        $payment = $this->show($id);

        $payment->delete();
        return $payment;
    }
}
