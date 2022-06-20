<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\Comment\CommentWithNestedResource;
use App\Http\Resources\Comment\CommentWithoutNestedCollection;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentController extends Controller
{
    /**
     * Получить модели верхнего уровня без вложенностей
     *
     * @param Request $request
     * @return ResourceCollection
     */
    public function getTopLevel (Request $request): ResourceCollection
    {
        $model = Comment::orderBy('created_at', 'ASC')->where('parent_id', null)->get();

        return new CommentWithoutNestedCollection($model);
    }

    /**
     * Получить модель по id c вложенност
     *
     * @param int $id
     * @return JsonResource
     */
    public function getWithNested (int $id): JsonResource
    {
        $model = Comment::with('nested')->findOrFail($id);

        return new CommentWithNestedResource($model);
    }

    /**
     * @param Request $request
     * @return JsonResource
     */
    public function post(Request $request): JsonResource
    {
        $model = Comment::orderBy('created_at', 'ASC')->get();

        return new CommentWithoutNestedCollection($model);
    }

    /**
     * @param Request $request
     * @return JsonResource
     */
    public function put(Request $request, int $id): JsonResource
    {
        $model = Comment::orderBy('created_at', 'ASC')->get();

        return new CommentWithNestedResource($model);
    }

    /**
     * @param Request $request
     * @return JsonResource
     */
    public function del(int $id): JsonResource
    {
        $model = Comment::findOrFail($id)->delete();

        return CategoryResource::collection($model);
    }
}
