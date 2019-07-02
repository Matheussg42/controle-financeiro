<?php

namespace App\Repositories\Income;

use App\Income;
use Carbon\Carbon;

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

    public function destroy($id)
    {
        $income = $this->show($id);

        $income->delete();
        return $income;
    }
}
