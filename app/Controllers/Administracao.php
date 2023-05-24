<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Administracao extends BaseController
{
    public function index()
    {
        return view('administracao/index');
    }
}
