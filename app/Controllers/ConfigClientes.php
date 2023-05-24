<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ConfigClientes extends BaseController
{
    public function index()
    {
        return view('administracao/responsavel');
    }
}
