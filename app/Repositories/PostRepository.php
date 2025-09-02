<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function all()
    {
        $posts = Post::paginate(7);

        return $posts;
    }

    public function getByID($id)
    {
        try {
            $post = Post::where('id', $id)->first();
        } catch (\Exception $e) {
            throw new \Exception('error!');
        }

        if ($post) {
            return $post;
        }
    }

    public function create($cred)
    {
        $uid = \Auth::user()->id;
        $post = new Post();

        $post->title = $cred->title;
        $post->text = $cred->text;
        $post->user_id = $uid;
        $post->save();

        return $post;
    }

    public function delete($id)
    {
        $post = $this->getByID($id)->delete();

        return $post;
    }
}
