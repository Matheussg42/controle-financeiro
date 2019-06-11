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
    public function show($id)
    {
        $periodo = auth()->user()->periodo()->find($id);
        if ($periodo) {
            return $periodo;
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
    public function update($fields, $id)
    {
        $periodo = $this->show($id);
        unset($fields['ano_mes'], $fields['status']);

        if($periodo['status'] == "fechado"){
            throw new \Exception('O mês já se encontra fechado.', -403);
        }else{
            $periodo->update($fields);
            return $periodo;
        }
    }

     /**
     * Update User logged
     *
     * @param fields
     * @return user
     */
    public function close($id)
    {
        $periodo = $this->show($id);
        $fields['status'] = 'fechado';

        if($periodo['status'] == "fechado"){
            throw new \Exception('O mês já se encontra fechado.', -403);
        }else{
            $periodo->update($fields);
            return $periodo;
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
        $periodo = $this->show($id);

        if($periodo['status'] == "fechado"){
            throw new \Exception('Você não pode deletar um mês fechado.', -403);
        }else{
            $periodo->delete();
            return $periodo;
        }

    }

    public function findBy($column, $value)
    {
        $periodo = auth()->user()->periodo()->where($column, $value)->first();
        return $periodo;
    }
}
