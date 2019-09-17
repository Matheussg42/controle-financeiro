<?php

namespace App\Repositories\Bill;

use App\Bill;
use Carbon\Carbon;

class BillRepository
{
    public function all(){
        return auth()
        ->user()
        ->bill;
    }

    public function create($fields)
    {
        return auth()
        ->user()
        ->bill()
        ->create($fields);
    }

    public function show($id)
    {
        $bill = auth()
        ->user()
        ->bill()
        ->find($id);

        if (!$bill) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $bill;
    }

    public function update($fields, $id)
    {
        $bill = $this->show($id);

        $bill->update($fields);
        return $bill;
    }

    public function destroy($id)
    {
        $bill = $this->show($id);

        $bill->delete();
        return $bill;
    }
}
