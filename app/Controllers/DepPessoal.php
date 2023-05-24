<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DepPessoal extends BaseController
{
    public function index()
    {
        return view('deppessoal/index');
    }

    public function tarefas()
    {
        return view('deppessoal/tarefas');
    }
}
