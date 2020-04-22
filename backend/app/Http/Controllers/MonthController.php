<?php

namespace App\Http\Controllers;

use App\Month;
use Illuminate\Http\Request;
use App\Transformers\Month\MonthResource;
use App\Transformers\Month\MonthResourceCollection;
use App\Http\Requests\Month\StoreMonth;
use App\Http\Requests\Month\UpdateMonth;
use App\Services\ResponseService;
use App\Http\Controllers\Notification;
use App\Repositories\Month\MonthRepository;

/**
 * @group Month Controller
 * 
 * Endpoints para as funcionalidades do Mês.
 */
class MonthController extends Controller
{
    private $month;

    public function __construct(MonthRepository $month){
        $this->month = $month;
    }

    /**
     * Todos os Meses
     * 
     * Busca todos os meses cadastrados por esse usuário
     * 
     * @response {
     *  "data": [
     *    {
     *      "id": 1,
     *      "User": "Name Teste",
     *      "Data": "2020_1",
     *      "Ano": "2020",
     *      "VR": 0,
     *      "Received": 3100,
     *      "Paid": 900,
     *      "Total": 2200,
     *      "Status": "fechado"
     *    },
     *    {
     *      "id": 2,
     *      "User": "Name Teste",
     *      "Data": "2020_2",
     *      "Ano": "2020",
     *      "VR": 0,
     *      "Received": 3100,
     *      "Paid": 900,
     *      "Total": 2200,
     *      "Status": "fechado"
     *    },
     *    {
     *      "id": 3,
     *      "User": "Name Teste",
     *      "Data": "2020_3",
     *      "Ano": "2020",
     *      "VR": 0,
     *      "Received": 3100,
     *      "Paid": 900,
     *      "Total": 2200,
     *      "Status": "fechado"
     *    }
     *  ],
     *  "status": true,
     *  "msg": "Listando dados",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/months"
     * }
     * 
     */
    public function index()
    {
        return new MonthResourceCollection($this->month->all());
    }

    /**
     * Cadastrar  Mês
     * 
     * Não é possível cadastrar o mesmo mês duas vezes.
     * 
     * @bodyParam name string Nome do Usuário. Example: Nome Teste
     * @bodyParam email string E-mail do Usuário. Example: nometeste@mail.com
     * @bodyParam password string Senha do Usuário. Example: 123456
     * @bodyParam password_confirmation string Confirmação da senha do Usuário. Example: 123456
     * 
     * @response {
     *  "data": {
     *    "id": 4,
     *    "User": "Name Teste",
     *    "Data": "2020_4",
     *    "Ano": "2020",
     *    "VR": 0,
     *    "Received": 0,
     *    "Paid": 0,
     *    "Total": 0,
     *    "Status": "aberto"
     *  },
     *  "status": true,
     *  "msg": "Dado inserido com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/months"
     *}
     * 
     */
    public function store(StoreMonth $request)
    {
        try{        
            $data = $this
            ->month
            ->create($request->all());
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.store',null,$e);
        }

        return new MonthResource($data,array('type' => 'store','route' => 'months.store'));
    }

    /**
     * Encontrar Mês pelo Id
     * 
     * @urlParam id required O codigo identificador do mês.
     * 
     * @response {
     *  "data": {
     *      "id": 3,
     *      "User": "Name Teste",
     *      "Data": "2020_3",
     *      "Ano": "2020",
     *      "VR": 0,
     *      "Received": 3100,
     *      "Paid": 900,
     *      "Total": 2200,
     *      "Status": "fechado"
     *  },
     *  "status": true,
     *  "msg": "Requisição realizada com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/months\/3"
     *}
     * 
    */
    public function show($id)
    {
        try{        
            $data = $this
            ->month
            ->show($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.show',$id,$e);
        }

        return new MonthResource($data,array('type' => 'show','route' => 'months.show'));
    }

    /**
     * Busca mês atual
     * 
     * @response {
     *  "data": {
     *    "id": 4,
     *    "User": "Name Teste",
     *    "Data": "2020_4",
     *    "VR": 0,
     *    "Received": 0,
     *    "Paid": 0,
     *    "Total": 0,
     *    "Status": "aberto"
     *  },
     *  "status": true,
     *  "msg": "Requisição realizada com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/currentMonth"
     *}
     * 
     */    
    public function getCurrentMonth(){
        try{        
            $data = $this
            ->month
            ->getCurrentMonth();
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.getCurrent',null,$e);
        }

        return new MonthResource($data,array('type' => 'show','route' => 'months.getCurrent'));
    }
    
    /**
     * Busca todos os meses do ano atual
     * 
     * @response {
     *  "data": [
     *    {
     *      "id": 1,
     *      "User": "Name Teste",
     *      "Data": "2020_1",
     *      "Ano": "2020",
     *      "VR": 0,
     *      "Received": 3100,
     *      "Paid": 900,
     *      "Total": 2200,
     *      "Status": "fechado"
     *    },
     *    {
     *      "id": 2,
     *      "User": "Name Teste",
     *      "Data": "2020_2",
     *      "Ano": "2020",
     *      "VR": 0,
     *      "Received": 3100,
     *      "Paid": 900,
     *      "Total": 2200,
     *      "Status": "fechado"
     *    },
     *    {
     *      "id": 3,
     *      "User": "Name Teste",
     *      "Data": "2020_3",
     *      "Ano": "2020",
     *      "VR": 0,
     *      "Received": 3100,
     *      "Paid": 900,
     *      "Total": 2200,
     *      "Status": "fechado"
     *    },
     *    {
     *      "id": 4,
     *      "User": "Name Teste",
     *      "Data": "2020_4",
     *      "Ano": "2020",
     *      "VR": 0,
     *      "Received": 0,
     *      "Paid": 0,
     *      "Total": 0,
     *      "Status": "aberto"
     *    }
     *  ],
     *  "status": true,
     *  "msg": "Requisição realizada com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/months"
     *}
     * 
     */
    public function getCurrentYear(){
        try{        
            $data = $this
            ->month
            ->getCurrentYear();
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.getCurrentYear',null,$e);
        }

        return new MonthResourceCollection($data);
    }

    /**
     * Atualiza mês
     * 
     * Não é possível atualizar um mês 'fechado'
     * 
     * @urlParam id required O codigo identificador do mês.
     * 
     * @response {
     *  "data": {
     *    "id": 5,
     *    "User": "Name Teste",
     *    "Data": "2020_4",
     *    "Ano": "2020",
     *    "VR": 0,
     *    "Received": 0,
     *    "Paid": 0,
     *    "Total": 0,
     *    "Status": "aberto"
     *  },
     *  "status": true,
     *  "msg": "Dados Atualizado com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/months\/10"
     *}
     * 
     */
    public function update(UpdateMonth $request, $id)
    {
        try{        
            $data = $this
            ->month
            ->update($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.update',$id,$e);
        }

        return new MonthResource($data,array('type' => 'update','route' => 'months.update'));
    }

    /**
     * Fechar mês
     * 
     * Fecha o mês passando o Valor total recebido e pago
     * 
     * @urlParam id required O codigo identificador do mês.
     * 
     * @bodyParam received int required Valor recebido no mês. Example: 3000
     * @bodyParam paid int required Valor pago no mês. Example: 900
     * 
     * @response {
     *  "data": {
     *    "id": 5,
     *    "User": "Name Teste",
     *    "Data": "2020_4",
     *    "Ano": "2020",
     *    "VR": 0,
     *    "Received": 3000,
     *    "Paid": 900,
     *    "Total": 2100,
     *    "Status": "fechado"
     *  },
     *  "status": true,
     *  "msg": "Dados Atualizado com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/closeMonth\/9"
     *}
     * 
     */
    public function close(Request $request, $id)
    {
        try{        
            $data = $this
            ->month
            ->close($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.close', $id, $e);
        }

        return new MonthResource($data,array('type' => 'update','route' => 'months.close'));
    }
    
    /**
     * Fechar mês
     * 
     * Fecha o mês sem passar o Valor total recebido e pago. 
     * 
     * @urlParam id required O codigo identificador do mês.
     * 
     * @response {
     *  "data": {
     *    "id": 5,
     *    "User": "Name Teste",
     *    "Data": "2020_4",
     *    "Ano": "2020",
     *    "VR": 0,
     *    "Received": 3000,
     *    "Paid": 900,
     *    "Total": 2100,
     *    "Status": "fechado"
     *  },
     *  "status": true,
     *  "msg": "Dados Atualizado com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/closeMonth\/9"
     *}
     * 
     */
    public function closeOtherMonth($id)
    {
        try{        
            $data = $this
            ->month
            ->closeOtherMonth($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.closeOther', $id, $e);
        }

        return new MonthResource($data,array('type' => 'update','route' => 'months.closeOther'));
    }

    /**
     * Apaga um mês
     * 
     * Não é possível apagar um mês 'fechado'
     * 
     * @urlParam id required O codigo identificador do mês.
     * 
     * @response {
     *  "data": {
     *    "id": 5,
     *    "User": "Name Teste",
     *    "Data": "2020_4",
     *    "Ano": "2020",
     *    "VR": 0,
     *    "Received": 0,
     *    "Paid": 0,
     *    "Total": 0,
     *    "Status": "aberto"
     *  },
     *  "status": true,
     *  "msg": "Dado excluido com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/months\/10"
     *}
     * 
     */
    public function destroy($id)
    {
        try{
            $data = $this
            ->month
            ->destroy($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('months.destroy',$id,$e);
        }
        return new MonthResource($data,array('type' => 'destroy','route' => 'months.destroy')); 
    }

    static function getMonthName($id){
        $month = new MonthRepository();
        $monthName = $month->getMonthName($id);
        return $monthName;
    }
}
