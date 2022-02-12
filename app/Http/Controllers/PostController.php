<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Repository\Post\PostInterface;
use Illuminate\Http\Request;
use function is_null;
use function redirect;

class PostController extends Controller
{
    protected $post;

    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        $this->post->create($request);
        return redirect($_SERVER['HTTP_REFERER'])
            ->with('message', 'Post Created');
    }

    public function read($id)
    {
        $this->post->read($id);
        return view('post.edit')
            ->with('post', $this->post->read($id));
    }

    public function update(Request $request, $id)
    {
        $this->post->update($id, $request);
        return redirect($_SERVER['HTTP_REFERER'])
            ->with('message', 'Post Updated');
    }

    public function delete($id)
    {
        $this->post->delete($id);
        return redirect($_SERVER['HTTP_REFERER'])
            ->with('message', 'Post Deleted');
    }
}
