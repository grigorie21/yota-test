<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentWithoutNestedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $v = (object)$this->resource;

        return [
            'id' => $v->id ?? null,
            'text' => $v->text ?? null,
            'created_at' => $v->created_at ?? null,
            'updated_at' => $v->updated_at ?? null,
        ];
    }

    /**
     * @param Request $request
     * @param JsonResponse $response
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode(200);
    }
}
