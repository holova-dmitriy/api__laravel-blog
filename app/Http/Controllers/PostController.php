<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\MessageResource;
use App\Http\Requests\Post\IndexRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Repositories\PostRepository;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\Post\DestroyRequest;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('verified')->only('store');

        $this->postRepository = new PostRepository();
    }

    public function index(IndexRequest $request)
    {
        return PostResource::collection($this->postRepository->getPostsList(
            $request->input('per_page', 15),
            $request->input('page', 1),
            $request->get('filter')
        ));
    }

    public function store(StoreRequest $request)
    {
        return new PostResource(
            Post::create(
                array_merge(
                    $request->validated(),
                    [
                        'user_id' => auth()->id(),
                    ]
                )
            )
        );
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $post->update($request->validated());

        return new PostResource($post);
    }

    public function destroy(DestroyRequest $request, Post $post)
    {
        $post->delete();

        return new MessageResource([trans('messages.deleted')]);
    }
}
