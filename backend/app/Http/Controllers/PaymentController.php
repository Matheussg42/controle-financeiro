<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;
use App\Transformers\Payment\PaymentResource;
use App\Transformers\Payment\PaymentResourceCollection;
use App\Http\Requests\Payment\StorePayment;
use App\Http\Requests\Payment\UpdatePayment;
use App\Services\ResponseService;
use App\Http\Controllers\Notification;
use App\Repositories\Payments\PaymentRepository;
use App\Repositories\Month\MonthRepository;

/**
 * @group Payment Controller
 * 
 * Endpoints para as funcionalidades de Pagamento.
 */
class PaymentController extends Controller
{
    private $payment;

    public function __construct(PaymentRepository $payment){
        $this->payment = $payment;
    }

    /**
     * Todos os Pagamentos
     * 
     * Busca todos os Pagamentos cadastrados por esse usuário
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
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/payments"
     *}
     * 
     */
    public function index()
    {
        return new PaymentResourceCollection($this->payment->all());
    }

    /**
     * Cadastrar Pagamento
     * 
     * @bodyParam yearMonth int Id do mês que o pagamento ocorreu. Example: 4
     * @bodyParam value int Valor do pagamento. Example: 1000
     * @bodyParam name string Nome do pagamento. Example: Salario
     * @bodyParam date string Data que o pagamento ocorreu. Example: 01/04/2020
     * @bodyParam comment string Comentário do pagamento. Example: O pagamento caiu no dia 01/04/2020.
     * 
     *
     * 
     * @response {
     *  "data": {
     *    "id": 6,
     *    "User": "Name Teste",
     *    "Name": "Conta",
     *    "Mês": "2020_4",
     *    "Data": "1\/04\/2020",
     *    "Value": 1000,
     *    "Comment": "O pagamento da conta aconteceu no dia 01/04/2020"
     *  },
     *  "status": true,
     *  "msg": "Dado inserido com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/payments"
     *}
     * 
    */
    public function store(StorePayment $request)
    {
        try{        
            $data = $this
            ->payment
            ->create($request->all());
            
            $month = new MonthRepository();
            $month->updateValue($request->all()['yearMonth']);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payments.store',null,$e);
        }

        return new PaymentResource($data,array('type' => 'store','route' => 'payments.store'));
    }

    /**
     * Encontrar Pagamento pelo Id
     * 
     * @urlParam id required O codigo identificador do pagamento.
     * 
     * @response {
     *  "data": {
     *    "id": 6,
     *    "User": "Name Teste",
     *    "Name": "Conta",
     *    "Mês": "2020_4",
     *    "Data": "1\/04\/2020",
     *    "Value": 1000,
     *    "Comment": "O pagamento da conta aconteceu no dia 01/04/2020"
     *  },
     *  "status": true,
     *  "msg": "Requisição realizada com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/payments\/6"
     *}
     * 
    */
    public function show($id)
    {
        try{        
            $data = $this
            ->payment
            ->show($id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payments.show',null,$e);
        }

        return new PaymentResource($data,array('type' => 'show','route' => 'payments.show'));
    }

    /**
     * Atualizar pagamento pelo Id
     * 
     * @urlParam id required O codigo identificador do pagamento.
     * 
     * @bodyParam value int Valor do pagamento. Example: 1000
     * @bodyParam name string Nome do pagamento. Example: Salario
     * @bodyParam date string Data que o pagamento ocorreu. Example: 01/04/2020
     * @bodyParam comment string Comentário do pagamento. Example: O pagamento da conta foi feito no dia no dia 01/04/2020.
     * 
     * @response {
     *  "data": {
     *    "id": 6,
     *    "User": "Name Teste",
     *    "Name": "Conta",
     *    "Mês": "2020_4",
     *    "Data": "1\/04\/2020",
     *    "Value": 1000,
     *    "Comment": "O pagamento da conta foi feito no dia no dia 01/04/2020"
     *  },
     *  "status": true,
     *  "msg": "Requisição realizada com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/payments\/6"
     *}
     * 
    */
    public function update(UpdatePayment $request, $id)
    {
        try{        
            $data = $this
            ->payment
            ->update($request->all(), $id);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payments.update',$id,$e);
        }

        return new PaymentResource($data,array('type' => 'update','route' => 'payments.update'));
    }

    /**
     * Pegar o pagamento de um mês pelo Id
     * 
     * @urlParam id required O codigo identificador do pagamento.
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
     *      "Name": "Conta",
     *      "Mês": "2020_4",
     *      "Data": "1\/04\/2020",
     *      "Value": 1000,
     *      "Comment": "O pagamento da conta foi feito no dia no dia 01/04/2020"
     *    }
     *  ],
     *  "status": true,
     *  "msg": "Requisição realizada com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/currentMonth\/payment"
     *}
     * 
    */
    public function getMonthPayments($yearMonth){
        try{
            $data = $this
            ->payment
            ->getMonthPayments($yearMonth);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payments.getMonth',$yearMonth,$e);
        }

        return new PaymentResourceCollection($data);
    }

    /**
     * Pegar os pagamentos do mês atual
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
     *      "Name": "Conta",
     *      "Mês": "2020_4",
     *      "Data": "1\/04\/2020",
     *      "Value": 1000,
     *      "Comment": "O pagamento da conta foi feito no dia no dia 01/04/2020"
     *    }
     *  ],
     *  "status": true,
     *  "msg": "Requisição realizada com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/currentMonth\/payment"
     *}
     * 
    */
    public function currentMonthPayment(){
        try{
            $data = $this
            ->payment
            ->currentMonthPayments();
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payments.getCurrentPayments',null,$e);
        }

        return new PaymentResourceCollection($data);
    }

    /**
     * Deletar pagamento pelo Id
     * 
     * @urlParam id required O codigo identificador do pagamento.
     * 
     * @response {
     *  "data": {
     *    "id": 6,
     *    "User": "Name Teste",
     *    "Name": "Salario",
     *    "Mês": "2020_4",
     *    "Data": "1\/04\/2020",
     *    "Value": 1000,
     *    "Comment": "O pagamento da conta foi feito no dia no dia 01/04/2020"
     *  },
     *  "status": true,
     *  "msg": "Dado excluido com sucesso",
     *  "url": "http:\/\/127.0.0.1:8000\/api\/v1\/payments\/6"
     *}
     * 
    */
    public function destroy($id)
    {
        try{
            $payment = $this
            ->payment
            ->show($id);

            $data = $this
            ->payment
            ->destroy($id);
            
            $month = new MonthRepository();
            $month->updateValue($payment['yearMonth']);
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('payments.destroy',$id,$e);
        }
        return new PaymentResource($data,array('type' => 'destroy','route' => 'payments.destroy')); 
    }
}
