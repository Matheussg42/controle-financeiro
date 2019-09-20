<?php

namespace App\Transformers\Payment;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MonthController;
use App\Http\Controllers\PaymentTypeController;
use App\Services\ResponseService;

class PaymentResource extends Resource
{
    /**
     * @var
     */
    private $config;

    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function __construct($resource, $config = array())
    {
        // Ensure you call the parent constructor
        parent::__construct($resource);

        $this->config = $config;
    }
    
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      
        return [
            'id' => $this->id,
            'user_id' => UserController::getUserName($this->user_id),
            'yearMonth' => MonthController::getMonthName($this->yearMonth),
            'type_id' => PaymentTypeController::getTypeName($this->type_id),
            'name' => $this->name,
            'value' => $this->value,
            'comment' => $this->comment
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return ResponseService::default($this->config,$this->id);
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param  \Illuminate\Http\Request
     * @param  \Illuminate\Http\Response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode(200);
    }
}
