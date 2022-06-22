<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request): array
    {
        $v = (object)$this->resource;

        return [
            'success' => $v->success ?? null,
            'message' => $v->message ?? null,
        ];
    }

    public function withResponse($request, $response)
    {
        if ($this->httpCode ?? $this['httpCode'] ?? null) {
            $httpCode = $this->httpCode ?? $this['httpCode'];
        } else {
            if ($this->success ?? $this['success'] !== false) {
                $httpCode = 200;
            } else {
                $httpCode = 406;
            }
        }

        $response->setStatusCode($httpCode);
    }
}
