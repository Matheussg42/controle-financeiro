<?php

namespace App\Repositories\Income;

use App\IncomeInstallments;
use Carbon\Carbon;

class IncomeInstallmentsRepository
{
    public function all(){
        return auth()
        ->user()
        ->incomeInstallments;
    }

    public function create($fields)
    {
        return auth()
        ->user()
        ->incomeInstallments()
        ->create($fields);
    }

    public function show($id)
    {


        $incomeInstallments = auth()
        ->user()
        ->incomeInstallments()
        ->find($id);

        if (!$incomeInstallments) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $incomeInstallments;
    }

    public function update($fields, $id)
    {
        $incomeInstallments = $this->show($id);

        $incomeInstallments->update($fields);
        return $incomeInstallments;
    }

    public function destroy($id)
    {
        $incomeInstallments = $this->show($id);

        $incomeInstallments->delete();
        return $incomeInstallments;
    }
}
