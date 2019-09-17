<?php

namespace App\Transformers\PaymentInstallments;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Services\ResponseService;

class PaymentInstallmentsResourceCollection extends ResourceCollection
{
      /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @return void
     */
    public function toArray($request)
    {  
        return ['data' => $this->collection];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'status' => true,
            'msg'    => 'Listando dados',
            'url'    => route('payment-installments.index')
        ];
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
