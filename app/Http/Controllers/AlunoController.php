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

    function store(Request $request) {
        dd($request->all());// o request é quando vc n sabe se o adado veio do post ou da url, dai ele pega os dois
        //aqui ele pega todos os dad9os do formulario

        Aluno::create($request->all()); //pega os itnens do forms e salva o formulario

        return redirect('aluno')->with("sucesso", 'Registro salvo com sucesso!');
    }
}
