<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repository\Post\PostInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $post;

    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        return $this->post->getAll();
    }

    public function store(Request $request)
    {
        return $this->post->create($request);
    }

    public function show($id)
    {
        return $this->post->read($id);
    }

    public function search($query)
    {
        return $this->post->search($query);
    }

    public function update(Request $request, $id)
    {
        return $this->post->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->post->delete($id);
    }
}
