<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\UpdateManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdateController extends Controller {

    public $updates;

    public function __construct(UpdateManager $updates) {

        $this->updates = $updates;

    }

    public function index() {


        return view('admin.update',[
            'lastVersion' => $this->updates->getLatestVersionNumber(),
            'hasUpdate' => $this->updates->hasUpdate(),
        ]);

    }


    public function update() {

        $this->updates->update();

        // return redirect()->route('admin.update.index');


    }
}
