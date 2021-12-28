<?php

namespace Deokonai\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Codedge\Updater\UpdaterManager;
use Deokonai\Models\Post;

class AdminController extends Controller {

    public function index() {

        $userCount = User::count();
        $postCount = Post::count();
        return view('admin.index', [
            'userCount' => $userCount,
            'postCount' => $postCount
        ]);

    }

}
