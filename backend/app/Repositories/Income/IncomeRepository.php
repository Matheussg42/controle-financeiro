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
        $payments =  auth()->user()->month()->find((int)$yearMonth)->income;
        return $payments;
    }

    public function currentMonthIncome()
    {
        $MonthRepository = new MonthRepository;
        $yearMonth = $MonthRepository->getCurrentMonth();

        $income = auth()
        ->user()
        ->income()
        ->where('yearMonth', '=', $yearMonth->id)->get();

        return $income;
    }

    public function destroy($id)
    {
        $income = $this->show($id);

        $income->delete();
        return $income;
    }
}
