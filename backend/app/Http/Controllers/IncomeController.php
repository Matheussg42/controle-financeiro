<?php

namespace App\Http\Controllers;

use App\Income;
use Illuminate\Http\Request;
use App\Transformers\Income\IncomeResource;
use App\Transformers\Income\IncomeResourceCollection;
use App\Http\Requests\Income\StoreIncome;
use App\Http\Requests\Income\UpdateIncome;
use App\Services\ResponseService;
use App\Repositories\Income\IncomeRepository;
use App\Repositories\Month\MonthRepository;

/**
 * @group Income Controller
 * 
 * Endpoints para as funcionalidades de Recebimento.
 */
class IncomeController extends Controller
{
    private $income;

    public function __construct(IncomeRepository $income)
    {
        $this->income = $income;
    }

    /**
     * Todos os Recebimento
     * 
     * Busca todos os recebimento cadastrados por esse usuário
     * 
     * @response {
     *  "data": [
     *    {
     *      "id": 1,
     *      "User": "Name Teste",
     *      "Name": "Teste",
     *      "Mês": "2020_1",
     *      "Data": "01\/01\/2020",
     *      "Value": 1000,
     *      "Comment": "Caiu no dia 01\/01"
     *    },
     *    {
     *      "id": 2,
     *      "User": "Name Teste",
     *      "Name": "Teste",
     *      "Mês": "2020_1",
     *      "Data": "01\/01\/2020",
     *      "Value": 2000,
     *      "Comment": null
     *    },
     *    {
     *      "id": 3,
     *      "User": "Name Teste",
     *      "Name": "Teste",
     *      "Mês": "2020_2",
     *      "Data": "01\/02\/2020",
     *      "Value": 2000,
     *      "Comment": ""
     *    },
     *    {
     *      "id": 4,
     *      "User": "Name Teste",
     *      "Name": "Teste",
     *      "Mês": "2020_3",
     *      "Data": "01\/03\/2020",
     *      "Value": 2000,
     *      "Comment": ""
     *    },
     *    {
     *      "id": 5,
     *      "User": "Name Teste",
     *      "Name": "Teste",
     *      "Mês": "2020_4",
     *      "Data": "01\/04\/2020",
     *      "Value": 2000,
     *      "Comment": ""
     *    }
     *  ],
     *  "status": true,
     *  "msg": "Listando dados",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/income"
     *}
     * 
     */
    public function index(){
        return new IncomeResourceCollection($this->income->all());
    }

    /**
     * Cadastrar Recebimento
     * 
     * @bodyParam yearMonth int Id do mês que o recebimento ocorreu. Example: 4
     * @bodyParam value int Valor do recebimento. Example: 1000
     * @bodyParam name string Nome do recebimento. Example: Salario
     * @bodyParam date string Data que o recebimento ocorreu. Example: 01/04/2020
     * @bodyParam comment string Comentário do recebimento. Example: O recebimento caiu no dia 01/04/2020.
     * 
     *
     * 
     * @response {
     *  "data": {
     *    "id": 6,
     *    "User": "Name Teste",
     *    "Name": "Salario",
     *    "Mês": "2020_4",
     *    "Data": "1\/04\/2020",
     *    "Value": 1000,
     *    "Comment": "O recebimento caiu no dia 01/04/2020"
     *  },
     *  "status": true,
     *  "msg": "Dado inserido com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/income"
     *}
     * 
    */
    public function store(StoreIncome $request){
        try {
            $data = $this
                ->income
                ->create($request->all());

            $month = new MonthRepository();
            $month->updateValue($request->all()['yearMonth']);
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('income.store', null, $e);
        }

        return new IncomeResource($data, array('type' => 'store', 'route' => 'income.store'));
    }

    /**
     * Encontrar Recebimento pelo Id
     * 
     * @urlParam id required O codigo identificador do recebimento.
     * 
     * @response {
     *  "data": {
     *    "id": 6,
     *    "User": "Name Teste",
     *    "Name": "Salario",
     *    "Mês": "2020_4",
     *    "Data": "1\/04\/2020",
     *    "Value": 1000,
     *    "Comment": "O recebimento caiu no dia 01/04/2020"
     *  },
     *  "status": true,
     *  "msg": "Requisição realizada com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/income\/6"
     *}
     * 
    */
    public function show($id){
        try {
            $data = $this
                ->income
                ->show($id);
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('income.show', null, $e);
        }

        return new IncomeResource($data, array('type' => 'show', 'route' => 'income.show'));
    }

    /**
     * Atualizar Recebimento pelo Id
     * 
     * @urlParam id required O codigo identificador do recebimento.
     * 
     * @bodyParam value int Valor do recebimento. Example: 1000
     * @bodyParam name string Nome do recebimento. Example: Salario
     * @bodyParam date string Data que o recebimento ocorreu. Example: 01/04/2020
     * @bodyParam comment string Comentário do recebimento. Example: O recebimento caiu no dia 01/04/2020.
     * 
     * @response {
     *  "data": {
     *    "id": 6,
     *    "User": "Name Teste",
     *    "Name": "Salario",
     *    "Mês": "2020_4",
     *    "Data": "1\/04\/2020",
     *    "Value": 1000,
     *    "Comment": "O recebimento caiu no dia 01/04/2020"
     *  },
     *  "status": true,
     *  "msg": "Requisição realizada com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/income\/6"
     *}
     * 
    */
    public function update(UpdateIncome $request, $id){
        try {
            $data = $this
                ->income
                ->update($request->all(), $id);
        } catch (\Throwable | \Exception $e) {
            return ResponseService::exception('income.update', $id, $e);
        }

        return new IncomeResource($data, array('type' => 'update', 'route' => 'income.update'));
    }

    /**
     * Pegar o recebimento de um mês pelo Id
     * 
     * @urlParam id required O codigo identificador do recebimento.
     * 
     * @response {
     *  "data": [
     *    {
     *      "id": 5,
     *      "User": "Name Teste",
     *      "Name": "Teste",
     *      "Mês": "2020_4",
     *      "Data": "01\/04\/2020",
     *      "Value": 2000,
     *      "Comment": ""
     *    },
     *    {
     *      "id": 6,
     *      "User": "Name Teste",
     *      "Name": "Salario",
     *      "Mês": "2020_4",
     *      "Data": "1\/04\/2020",
     *      "Value": 1000,
     *      "Comment": "O recebimento caiu no dia 01/04/2020"
     *    }
     *  ],
     *  "status": true,
     *  "msg": "Requisição realizada com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/income"
     *}
     * 
    */
    public function getMonthIncome($yearMonth){
        try{
            $data = $this
            ->income
            ->getMonthIncomes($yearMonth);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('income.getMonth',$yearMonth,$e);
        }

        return new IncomeResourceCollection($data);
    }
    
    /**
     * Pegar o recebimento do mês atual
     * 
     * @response {
     *  "data": [
     *    {
     *      "id": 5,
     *      "User": "Name Teste",
     *      "Name": "Teste",
     *      "Mês": "2020_4",
     *      "Data": "01\/04\/2020",
     *      "Value": 2000,
     *      "Comment": ""
     *    },
     *    {
     *      "id": 6,
     *      "User": "Name Teste",
     *      "Name": "Salario",
     *      "Mês": "2020_4",
     *      "Data": "1\/04\/2020",
     *      "Value": 1000,
     *      "Comment": "O recebimento caiu no dia 01/04/2020"
     *    }
     *  ],
     *  "status": true,
     *  "msg": "Requisição realizada com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/currentMonth\/income"
     *}
     * 
    */
    public function currentMonthIncome(){
        try{
            $data = $this
            ->income
            ->currentMonthIncome();
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('income.getCurrentIncome',null,$e);
        }

        return new IncomeResourceCollection($data);
    }

    /**
     * Deletar Recebimento pelo Id
     * 
     * @urlParam id required O codigo identificador do recebimento.
     * 
     * @response {
     *  "data": {
     *    "id": 6,
     *    "User": "Name Teste",
     *    "Name": "Salario",
     *    "Mês": "2020_4",
     *    "Data": "1\/04\/2020",
     *    "Value": 1000,
     *    "Comment": "O recebimento caiu no dia 01/04/2020"
     *  },
     *  "status": true,
     *  "msg": "Dado excluido com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/income\/6"
     *}
     * 
    */
    public function destroy($id){
        try{
            $income = $this
            ->income
            ->show($id);

            $data = $this
            ->income
            ->destroy($id);

            $month = new MonthRepository();
            $month->updateValue($income['yearMonth']);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('income.destroy',$id,$e);
        }
        return new IncomeResource($data,array('type' => 'destroy','route' => 'income.destroy'));
    }
}
