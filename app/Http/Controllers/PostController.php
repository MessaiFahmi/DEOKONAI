<?php

namespace Deokonai\Http\Controllers;

use App\Http\Controllers\Controller;
use Deokonai\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {

    public function __construct() {

        $this->middleware('can:posts-create')->only('create');
        $this->middleware('can:posts-edit')->only('edit');
        $this->middleware('can:posts-delete')->only('delete');

    }

    public function index() {

        $posts = Post::all();
        return view('posts.index', ['posts' => $posts]);

    }

}
