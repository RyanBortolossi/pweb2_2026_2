<?php

namespace App\Http\Controllers;

use App\Models\CategoriaMatricula;
use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Curso;
use App\Models\Turma;

class MatriculaController extends Controller
{
    public function index()
    {
        $dados = Matricula::All();

        return view('matricula.list')->with(['dados' => $dados]);
    }

    function create()
    {

        $curso = Curso::orderBy('nome')->get();
        $turma = Turma::orderBy('nome')->get();
        $aluno = Aluno::orderBy('nome')->get();
        return view('matricula.form')->with(compact('curso', 'turma', 'aluno'));
    }


    //AQUI VAMOS FAZER A VALIDAÇÃO DA IMAGEM
    //TEM QUE COLOCAR NO UPDATE TBM
    function validateForm(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:curso,id',
            'turma_id' => 'required|exists:turma,id',
            'aluno_id' => 'r.equired|exists:aluno,id',
            'data_matricula' => 'required',
        ], [
            'nome.required' => "O :attribute é obrigatorio",
            'turma.required' => "O :attribute é obrigatorio",
            'aluno.required' => "O :attribute é obrigatorio",
            'data_matricula.required' => "O :attribute é obrigatorio",

        ]);
    }

    function store(Request $request)
    {
        //dd($request->all());
        $this->validateForm($request);

        $data = $request->all(); //vai puxar todos os dados salvos

        Matricula::create($request->all());

        return redirect('matricula')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Matricula::find($id);
        $curso = Curso::orderBy('nome')->get();
        $turma = Turma::orderBy('nome')->get();
        $aluno = Aluno::orderBy('nome')->get();
        return view('matricula.form')->with(compact('curso', 'turma', 'aluno'));
        // dd($data);
        //return view('matricula.form')->with(['data' => $data]);
        return view('matricula.form')->with(compact('data', 'curso', 'turma', 'aluno'));//tem que retornar assim se nn ele n puxa as categorias


    }


    function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validateForm($request);

        $data = $request->all(); //vai puxar todos os dados salvos

        Matricula::find($id)->update($data);

        return redirect('matricula')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        Matricula::destroy($id);

        return redirect('matricula')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $query = Matricula::with(['curso', 'turma', 'aluno']);
            $valor = $request->valor;

            $query = whereHas(
                $request->tipo,
                function ($q) use ($valor) {
                    $q->where('nome', 'like', "%$valor%");
                }
            )->get();
        } else {
            $dados = Matricula::All();
        }

        return view('matricula.list', compact('dados'));
    }
}
