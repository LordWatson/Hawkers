<?php

namespace App\Repository\Post;
use App\Models\Post;

class PostRepository implements PostInterface
{
    public function getAll()
    {
        return Post::latest()->get();
    }

    public function create($data)
    {
        $post = new Post();
        $post->name = $data['name'];
        $post->body = $data['body'];
        return $post->save();
    }

    public function read($id)
    {
        return Post::find($id);
    }

    public function update($id, $data)
    {
        $post = Post::find($id);
        $post->name = $data['name'];
        $post->body = $data['body'];
        return $post->save();
    }

    public function delete($id)
    {
        return Post::find($id)->delete();
    }
}
