<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentWithoutNestedResource;
use App\Http\Resources\SuccessResource;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Throwable;

class CommentController extends Controller
{
    /**
     *
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        $model = Comment::with('nested')
            ->orderBy('created_at', 'ASC')
            ->where('parent_id', null)
            ->get();

        return new CommentCollection($model);
    }


    /**
     * @param int $id
     * @return JsonResource
     */
    public function get(int $id): JsonResource
    {
        try {
            $model = Comment::findOrFail($id);
        } catch (Throwable $e) {
            return new SuccessResource([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        return new CommentWithoutNestedResource($model);
    }

    /**
     * @param CommentRequest $request
     * @return JsonResource
     */
    public function post(CommentRequest $request): JsonResource
    {
        try {
            $model = Comment::create($request->all());
        } catch (Throwable $e) {
            return new SuccessResource([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        return new CommentWithoutNestedResource($model);
    }

    /**
     * @param CommentRequest $request
     * @param int $id
     * @return JsonResource
     */
    public function put(CommentRequest $request, int $id): JsonResource
    {
        try {
            $model = Comment::findOrFail($id);
            $model->update($request->all());
        } catch (Throwable $e) {
            return new SuccessResource([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        return new CommentWithoutNestedResource($model);
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function del(int $id): JsonResource
    {
        try {
            Comment::findOrFail($id)->delete();
        } catch (Throwable $e) {
            return new SuccessResource([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }

        return new SuccessResource(['success' => true]);
    }
}
