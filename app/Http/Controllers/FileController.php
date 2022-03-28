<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends AppController
{
    public function authCheck()
    {
        if (!auth()->check()) {
            abort(404);
        } else if (auth()->user()->isDisable()) {
            abort(403, 'This action is unauthorized.');
        }
    }

    public function index()
    {
        $this->authCheck();
        return view('vendor.file-manager.tinymce');
    }

    public function manager()
    {
        $this->authCheck();
        return view('admin.file.index');
    }
}
