<?php

namespace App\Repositories\Income;

use App\Income;
use Carbon\Carbon;
use App\Repositories\Month\MonthRepository;

class IncomeRepository
{
    public function all(){
        return auth()
        ->user()
        ->income;
    }

    public function create($fields)
    {
        return auth()
        ->user()
        ->income()
        ->create($fields);
    }

    public function show($id)
    {


        $income = auth()
        ->user()
        ->income()
        ->find($id);

        if (!$income) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $income;
    }

    public function update($fields, $id)
    {
        $income = $this->show($id);

        $income->update($fields);
        return $income;
    }

    public function getMonthIncomes($yearMonth)
    {
        $incomes = auth()
        ->user()
        ->income()
        ->where('yearMonth', '=', $yearMonth)->get();
        
        return $incomes;
    }

    public function getMonthTotalIncomes($yearMonth)
    {
        $totalValue = 0;

        $incomes = $this->getMonthIncomes($yearMonth);

        foreach($incomes as $income){
            $totalValue +=$income['value'];
        }

        return $totalValue;
    }
    
    public function currentMonthIncome()
    {
        $MonthRepository = new MonthRepository;
        $yearMonth = $MonthRepository->getCurrentMonth();

        $income = $this->getMonthIncomes($yearMonth->id);

        if (count($income) === 0) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $income;
    }

    public function destroy($id)
    {
        $income = $this->show($id);

        $income->delete();
        return $income;
    }
}
