<?php

namespace App\Services;

use App\Http\Data\PostDTO;
use App\Repositories\PostRepository;

class PostService
{
    public $postData;
    public $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function create($postData)
    {
        $postDTO = new PostDTO($postData['text'], $postData['title'], null);
        if (\Gate::allows('create-post')) {
            $post = $this->postRepository->create($postDTO);

            return $post;
        } else {
            return 0;
        }
    }

    public function delete($id)
    {
        $post = $this->postRepository->getByID($id);
        if (!$post) {
            return false;
        }

        if (!\Gate::allows('delete-post', $post)) {
            return false;
        }
        $post->delete();

        return true;
    }

    public function getAll()
    {
        $posts = new PostRepository();

        return $posts->all();
    }

    public function getSpecifiedPost($id)
    {
        $post = $this->postRepository->getByID($id);

        return $post;
    }
}
