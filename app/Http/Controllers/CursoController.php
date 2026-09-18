<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $dados = Curso::All();

        return view('curso.list')->with(['dados' => $dados]);
    }

    function create()
    {
     return view('curso.form');
    }


    //AQUI VAMOS FAZER A VALIDAÇÃO DA IMAGEM
    //TEM QUE COLOCAR NO UPDATE TBM
    function validateForm(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'requisito' => 'nullabe|string',
            'carga_horaria' => 'nullabe|numeric',
            'valor' => 'nullabe|numeric',
        ], [
            'nome.required' => "O :attribute é obrigatorio",
            'requisito.string' => "O :attribute é caracter",
            'carga_horaria.numeric' => "O :attribute é numeric",
        ]);
    }

    function store(Request $request)
    {
        //dd($request->all());
        $this->validateForm($request);

        $data = $request->all(); //vai puxar todos os dados salvos
        $imagem = $request->file('imagem'); //puxa a imagem, pede a imagem
        
        //se existir a imagem ele passa pelo if e salva, se ão ele só pula e salva direto
        if($imagem){
            $nome_imagem = date('YmdiHs').".". $imagem->getClientOriginalExtension(); //salva a imagem como a data e hora quando ela foi salva para garantir que ela é unica +(.) a extensão dela
            $diretorio = "imagem/curso/"; //escolhe onde a imagem vai ser salva
            $imagem->storeAs($diretorio , $nome_imagem, 'public'); //função nativa do laravel paraa salvar, passa o caminho, a imagem e a classificação dela (public)
            $data['imagem'] = $diretorio . $nome_imagem;
            }

        Curso::create($request->all());

        return redirect('curso')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Curso::find($id);
        $categorias = CategoriaCurso::orderBy('nome')->get(); //tem q chamar la em cima o use

        // dd($data);
        //return view('curso.form')->with(['data' => $data]);
        return view('curso.form')->with(compact('data', 'categorias'));//tem que retornar assim se nn ele n puxa as categorias


    }


    function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validateForm($request);

                $data = $request->all(); //vai puxar todos os dados salvos
        $imagem = $request->file('imagem'); //puxa a imagem, pede a imagem
        
        //se existir a imagem ele passa pelo if e salva, se ão ele só pula e salva direto
        if($imagem){
            $nome_imagem = date('YmdiHs').".". $imagem->getClientOriginalExtension(); //salva a imagem como a data e hora quando ela foi salva para garantir que ela é unica +(.) a extensão dela
            $diretorio = "imagem/curso/"; //escolhe onde a imagem vai ser salva
            $imagem->storeAs($diretorio , $nome_imagem, 'public'); //função nativa do laravel paraa salvar, passa o caminho, a imagem e a classificação dela (public)
            $data['imagem'] = $diretorio . $nome_imagem;
            }

        Curso::find($id)->update($data);

        return redirect('curso')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        Curso::destroy($id);

        return redirect('curso')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Curso::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Curso::All();
        }

        return view('curso.list', compact('dados'));
    }
}