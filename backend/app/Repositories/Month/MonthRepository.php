<?php

namespace App\Repositories\Month;

use App\Month;
use Carbon\Carbon;
use DB;

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

    public function update($fields, $id)
    {
        $month = $this->show($id);
        unset($fields['yearMonth'], $fields['status']);

        $this->checkMonthStatus($month);

        $month->update($fields);
        return $month;
    }

    public function close($id)
    {
        $month = $this->show($id);
        $fields['status'] = 'fechado';

        $this->checkMonthStatus($month);

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
}
