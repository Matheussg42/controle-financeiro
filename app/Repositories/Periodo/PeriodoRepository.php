<?php

namespace App\Repositories\Periodo;

use App\Periodo;
use Carbon\Carbon;

/**
 * Repository decouple models from controllers and
 * assign readable names to complicated queries
 *
 * @author Alexandre Simon
 */
class PeriodoRepository
{

    /**
     * Get All Budgets
     * 
     * @return budgets
     */
    public function all(){
        return auth()->user()->periodo;
    }

    /**
     * Create User
     *
     * @param  fields
     * @return user
     */
    public function create($fields)
    {
        $now = Carbon::now();
        $ano_mes = (string) $now->year . "_" . $now->month;
        $check = auth()->user()->periodo()->where('ano_mes', $ano_mes)->first();

        if(!empty($check)){
            throw new \Exception('Já existe um periodo aberto para este mês!', -403);
        }else{
            $fields['ano_mes']  = $ano_mes;
            $fields['refeicao'] = 0.00;
            $fields['lucro']    = 0.00;
            $fields['despesa']  = 0.00;
            $fields['total']    = 0.00;
            $fields['status']   = 'aberto';
            return auth()->user()->periodo()->create($fields);
        }
         
    }

    /**
     * Show User logged
     *
     * @return user
     */
    public function show()
    {
        $user = auth()->user();
        if ($user) {
            return $user;
        } else {
            throw new \Exception('Nada Encontrado', -404);
        }
    }

    /**
     * Update User logged
     *
     * @param fields
     * @return user
     */
    public function update($fields)
    {
        $user = $this->show();
        $user->update($fields);
        return $user;
    }

    /**
     * Update Password User logged
     *
     * @param fields
     * @return user
     */
    public function updatePassword($password)
    {
        $user = $this->show();
        $fields = ['password' => \Hash::make($password)];
        $user->update($fields);
        return $user;
    }

    /**
     * Find User By Id
     *
     * @param  id
     * @return user
     */
    public function find($id)
    {
        $user = User::find($id);
        if ($user) {
            return $user;
        } else {
            throw new \Exception('Nada Encontrado', -404);
        }
    }

    /**
     * Destroy User
     *
     * @param  id
     * @return user
     */
    public function destroy($id)
    {
        $user = $this->find($id);
        $user->delete();
        return $user;
    }

    public function findBy($column, $value)
    {
        $user = User::where($column, $value)->first();
        return $user;
    }
}
