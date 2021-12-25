<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Codedge\Updater\UpdaterManager;

class AdminController extends Controller {

    public function index() {

        $userCount = User::count();
        return view('admin.index', compact('userCount'));

    }

}
