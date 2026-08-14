<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;

class AlunoController extends Controller
{
    public function index()
    {
        $dados = Aluno::All();

        return view('aluno.list')->with(['dados' => $dados]);
    }
    
    function create()
    {
        return view('aluno.form');
    }
}
