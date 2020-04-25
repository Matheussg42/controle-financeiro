<?php

namespace App\Repositories\Month;

use App\Month;
use Carbon\Carbon;
use DB;
use App\Repositories\Income\IncomeRepository;
use App\Repositories\Payments\PaymentRepository;

class MonthRepository
{
    public function all(){
        return auth()
        ->user()
        ->month;
    }

    public function create($fields)
    {
        $yearMonth = $this->getTheYearMonth();
        $this->checkOpenYearMonth($yearMonth);
        $fields = $this->createMonthFields($yearMonth); 

        return auth()
        ->user()
        ->month()
        ->create($fields);
    }

    public function show($id)
    {
        $month = auth()
        ->user()
        ->month()
        ->find($id);

        
        if (!$month) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $month;
    }

    public function getCurrentMonth()
    {
        $yearMonth = $this->getTheYearMonth();

        $month = auth()
        ->user()
        ->month()
        ->where("yearMonth", "=", $yearMonth)->first();

        if (!$month) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $month;
    }

    public function getCurrentYear()
    {
        $months = $this->currentYearMonths();

        if (!$months) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $months;
    }

    public function update($fields, $id)
    {
        $month = $this->show($id);
        unset($fields['yearMonth'], $fields['status']);

        $this->checkMonthStatus($month);

        $month->update($fields);
        return $month;
    }
    
    public function updateValue($id)
    {
        $IncomeRepository = new IncomeRepository;
        $PaymentRepository = new PaymentRepository;
        
        $totalIncome = $IncomeRepository->getMonthTotalIncomes($id);
        $totalPayment = $PaymentRepository->getMonthTotalPayments($id);

        
        $data['received'] = $totalIncome;
        $data['paid'] = $totalPayment;
        $data['total'] = $totalIncome - $totalPayment;
        
        $month = $this->show($id);
        $month->update($data);
    }

    public function close($request, $id)
    {

        $month = $this->show($id);
        
        if (!$month) {
            throw new \Exception('Nada Encontrado', -404);
        }

        $fields['status'] = 'fechado';
        $fields['received'] = $request['received'];
        $fields['paid'] = $request['paid'];
        $fields['total'] = (int)$request['received'] - (int)$request['paid'];

        $this->checkMonthStatus($month);

        $month->update($fields);
        return $month;
    }

    public function closeOtherMonth($id){
        $IncomeRepository = new IncomeRepository;
        $PaymentRepository = new PaymentRepository;
        
        $totalIncome = $IncomeRepository->getMonthTotalIncomes($id);
        $totalPayment = $PaymentRepository->getMonthTotalPayments($id);

        $fields['status'] = 'fechado';
        $fields['received'] = $totalIncome;
        $fields['paid'] = $totalPayment;
        $fields['total'] = $totalIncome - $totalPayment;

        $month = $this->show($id);
        $month->update($fields);
        return $month;
    }

    public function destroy($id)
    {
        $month = $this->show($id);
        $this->checkMonthStatus($month);

        $month->delete();
        return $month;
    }

    public function findBy($column, $value)
    {
        $month = auth()
        ->user()
        ->month()
        ->where($column, $value)
        ->first();

        return $month;
    }

    public function checkMonthStatus($month){
        if($month['status'] === "fechado"){
            throw new \Exception('O mês já se encontra fechado.', -403);
        }
    }

    public function checkOpenYearMonth($yearMonth){
        $check = auth()
        ->user()
        ->month()
        ->where('yearMonth', $yearMonth)
        ->first();

        if(!empty($check)){
            throw new \Exception('Esse mês já foi criado!', -403);
        }
    }

    public function getTheYearMonth(){
        $now = Carbon::now();
        $yearMonth = (string) $now->year . "_" . $now->month;
        
        return $yearMonth;
    }

    public function createMonthFields($yearMonth):array 
    {
        return [
            'yearMonth' => $yearMonth,
            'ticket'    => 0.00,
            'received'  => 0.00,
            'paid'      => 0.00,
            'total'     => 0.00,
            'status'    => 'aberto'
        ];
    }

    public function getMonthName($id){
        $name = DB::table('months')->where('id', $id)->pluck('yearMonth')->first();
        if (!$name) {
            $name = $id;
        }
        return $name;
    }

    public function currentYearMonths(){
        $yearMonth = $this->getTheYearMonth();
        $year = substr($yearMonth, 0, 4);

        $months = auth()
        ->user()
        ->month()
        ->where("yearMonth", 'like', '%' . $year . '%')
        ->get();

        return $months;
    }
}
