<?php

namespace App\Http\Resources\Comment;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class CommentWithoutNestedCollection extends ResourceCollection
{
    public $collects = CommentWithoutNestedResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
