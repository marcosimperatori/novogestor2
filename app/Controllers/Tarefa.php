<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Tarefa extends BaseController
{
    public function index()
    {
        return view('tarefas/index');
    }
}
