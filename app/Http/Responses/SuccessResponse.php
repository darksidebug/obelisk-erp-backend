<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class SuccessResponse implements Responsable
{
    /**
     * @param  mixed  $data
     * @param  array  $metadata
     * @param  int  $code
     * @param  array  $headers
     */
    public function __construct(
        private mixed $data,
        private mixed $message,
        private int $code = Response::HTTP_OK,
        private array $headers = [],
    ) {}

    /**
     * @param  $request
     * @return \Symfony\Component\HttpFoundation\Response|void
     */
    public function toResponse($request)
    {
        $response =  [
            'status' =>  $this->code,
            'message' => $this->message,
            'data' => $this->data,
        ];

        //Check if pagination
        if ($this->isResource($this->data)) {
            $lists =  $this->data->response()->getData(true);
            if(isset($lists['meta'])) {
                $response['meta'] = $lists['meta'];
            }
            if(isset($lists['links'])) {
                $response['links'] = $lists['links'];
            }
            
        }
        
        return response()->json(
            $response,
            $this->code,
            $this->headers
        );
    }

    private function isResource($data)
    {
        return $data instanceof ResourceCollection || (is_array($data) && isset($data['data']) && $data['data'] instanceof ResourceCollection);
    }
}