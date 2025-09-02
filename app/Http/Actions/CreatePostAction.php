<?php

namespace App\Http\Actions;

use App\Services\PostService;

class CreatePostAction
{
    public PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function execute($cred)
    {
        $post = $this->postService->create($cred);

        return $post;
    }
}
