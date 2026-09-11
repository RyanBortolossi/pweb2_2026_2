<?php

namespace App\Http\Controllers;

use App\Models\CategoriaAluno;
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
        $categorias = CategoriaAluno::orderBy('nome')->get(); //tem q chamar la em cima o use
        return view('aluno.form')->with(compact('data', 'categorias'));//tem que retornar assim se nn ele n puxa as categorias
    }


    //AQUI VAMOS FAZER A VALIDAÇÃO DA IMAGEM
    //TEM QUE COLOCAR NO UPDATE TBM
    function validateForm(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'categoria_id' => 'required',
            'imagem' => 'nullabe|image|mimes:png,jpg,jpeg', //opcional | tipo do arquivo | validações dos tipos de arquivo que ele vai aceitar
        ], [
            'nome.required' => "O :attribute é obrigatorio",
            'cpf.required' => "O :attribute é obrigatorio",
            'categoria_id.required' => "O :attribute é obrigatorio",
            //'imagem.imagem' => "O :attribute deve ser enviado" //Nn sei oq é isso, perdi a parte q ele apagou ou colocou isso
            'imagem.mimes' => "O :attribute deve ser das extensões: PNG, JPG ou JPEG",
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
            $diretorio = "imagem/aluno/"; //escolhe onde a imagem vai ser salva
            $imagem->storeAs($diretorio , $nome_imagem, 'public'); //função nativa do laravel paraa salvar, passa o caminho, a imagem e a classificação dela (public)
            $data['imagem'] = $diretorio . $nome_imagem;
            }

        Aluno::create($request->all());

        return redirect('aluno')->with("success", 'Registro Salvo com sucesso!');
    }

    function edit($id)
    {
        $data = Aluno::find($id);
        $categorias = CategoriaAluno::orderBy('nome')->get(); //tem q chamar la em cima o use

        // dd($data);
        //return view('aluno.form')->with(['data' => $data]);
        return view('aluno.form')->with(compact('data', 'categorias'));//tem que retornar assim se nn ele n puxa as categorias


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
            $diretorio = "imagem/aluno/"; //escolhe onde a imagem vai ser salva
            $imagem->storeAs($diretorio , $nome_imagem, 'public'); //função nativa do laravel paraa salvar, passa o caminho, a imagem e a classificação dela (public)
            $data['imagem'] = $diretorio . $nome_imagem;
            }

        Aluno::find($id)->update($data);

        return redirect('aluno')->with("success", 'Registro Atualizado com sucesso!');
    }

    function destroy($id)
    {
        Aluno::destroy($id);

        return redirect('aluno')->with("success", 'Registro removido com sucesso!');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Aluno::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Aluno::All();
        }

        return view('aluno.list', compact('dados'));
    }
}
