<?php

namespace Deokonai\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller {

    public function home() {
        return view('home');
    }


}
