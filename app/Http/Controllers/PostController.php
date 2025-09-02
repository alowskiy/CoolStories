<?php

namespace App\Http\Controllers;

use App\Http\Actions\CreatePostAction;
use App\Http\Actions\DeletePostAction;
use App\Http\Actions\GetPostByIDAction;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $postService;
    public $createPostAction;
    public $deletePostAction;
    public $getPostByIDAction;

    public function __construct(CreatePostAction $createPostAction, DeletePostAction $deletePostAction, GetPostByIDAction $getPostByIDAction)
    {
        $this->createPostAction = $createPostAction;
        $this->deletePostAction = $deletePostAction;
        $this->getPostByIDAction = $getPostByIDAction;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  $posts = $this->getPostByIDAction->execute();

        // return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $postRequest)
    {
        $cred = $postRequest->validated();
        $post = $this->createPostAction->execute($cred);

        return response()->json([
            'success' => true,
            'message' => 'Created successfuly',
            'data' => [
                'post' => $post,
            ],
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = $this->getPostByIDAction->execute($id);
        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Error. Post Not Found',
            ], 404);
        }

        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = $this->deletePostAction->execute($id);
        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Deleted successfuly',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error',
            ], 403);
        }
    }
}
