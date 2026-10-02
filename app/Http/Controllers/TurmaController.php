<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index(Curso $curso)
    {
        $dados = $curso->turmas;

        return view('turma.list')->with([
            'dados' => $dados,
            'curso' => $curso,
        ]);
    }

    function create(Curso $curso)//já passa filytrado pela url
    {
        return view('turma.form')->with(compact('curso'));
    }


    //AQUI VAMOS FAZER A VALIDAÇÃO DA IMAGEM
    //TEM QUE COLOCAR NO UPDATE TBM
    function validateForm(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'curso_id' => 'required',

        ], [
            'nome.required' => "O :attribute é obrigatorio",
            'curso_id.required' => "O :attribute é obrigatorio",

        ]);
    }

    function store(Request $request)
    {
        //dd($request->all());
        $this->validateForm($request);

        $data = $request->all(); //vai puxar todos os dados salvos
        $imagem = $request->file('imagem'); //puxa a imagem, pede a imagem

        //se existir a imagem ele passa pelo if e salva, se ão ele só pula e salva direto
        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension(); //salva a imagem como a data e hora quando ela foi salva para garantir que ela é unica +(.) a extensão dela
            $diretorio = "imagem/turma/"; //escolhe onde a imagem vai ser salva
            $imagem->storeAs($diretorio, $nome_imagem, 'public'); //função nativa do laravel paraa salvar, passa o caminho, a imagem e a classificação dela (public)
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        $turma = Turma::create($request->all());

        return redirect()->route('curso.turmas', $turma->curso_id)->with("success", 'Registro Salvo com sucesso!'); //o route é para que as alterações feitas dentro da aba sempre retornem para o mesmo id/curso
        //Quando carregar a turma ele tem que passar o id do curso no url, dai vc envia os dados pelo route
    }

    function edit($id)
    {
        $data = Turma::find($id);
        $curso = Curso::find($data->curso_id);

        // dd($data);
        //return view('turma.form')->with(['data' => $data]);
        return view('turma.form')->with(compact('data', 'categorias'));//tem que retornar assim se nn ele n puxa as categorias


    }


    function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validateForm($request);

        $data = $request->all(); //vai puxar todos os dados salvos
        $imagem = $request->file('imagem'); //puxa a imagem, pede a imagem

        //se existir a imagem ele passa pelo if e salva, se ão ele só pula e salva direto
        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension(); //salva a imagem como a data e hora quando ela foi salva para garantir que ela é unica +(.) a extensão dela
            $diretorio = "imagem/turma/"; //escolhe onde a imagem vai ser salva
            $imagem->storeAs($diretorio, $nome_imagem, 'public'); //função nativa do laravel paraa salvar, passa o caminho, a imagem e a classificação dela (public)
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        $turma = Turma::find($id)->update($data);

        return redirect()->route('curso.turmas', $request->curso_id)->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {

        $data = Turma::find($id);

        Turma::ddestroy($id);

        return redirect()->route('curso.turmas', $data->curso_id)->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        $curso = Turma::findOrFail($request->curso_id);

        if (!empty($request->valor)) {
            $dados = Turma::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Turma::All();
        }

        return view('turma.list', compact('dados', 'curso'));
    }
}

