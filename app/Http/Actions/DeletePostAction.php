<?php

namespace App\Http\Actions;

use App\Services\PostService;

class DeletePostAction
{
    public $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function execute($id)
    {
        $post = $this->postService->delete($id);

        return $post;
    }
}
