<?php

namespace App\Http\Actions;

use App\Services\PostService;

class GetAllPostsAction
{
    public $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function execute()
    {
        $posts = $this->postService->getAll();

        return $posts;
    }
}
