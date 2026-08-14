@extends('main')
@section('titulo', 'Formulário de Alunos')
@section('conteudo') <!-- Aqui ele da um "play" no arquivo-->

    <div class="row">

        <!--Mesma coisa que a tag-->
        @php
            if(!empty($dado->id)){
                $action = route("aluno.uptade", $dados->id);
            }else{
                $action = route('aluno.store');
            }
        @endphp

        <h4>Formulário Aluno</h4>

        <form action="{{ route('aluno.store') }}" method="post"> <!--{{}} pega a variabel php e poe no html--> <!--rotas configuram na routes-->
            @csrf
            <!--Faz com que o laravel faça uma verificação para ver se a submiussão do formulario
                vem de uma rede extern ou não;. se for externa ele bloqueia-->
            <h3>Formulário Usuário</h3>
            <input type="hidden" name="id" value="{{old('id', $data->id ?? '')}}"> <!--Essa parte dos ?? é a validação. "Se tal coisa existir faça isso, se não faça isso-->
            <div class="col-6">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{old('nome', $data->nome ?? '')}}"> <!--esse $data é p fazer o formato que o form pode ser editado depois também-->
            </div>
            <div class="col-6">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{old('email', $data->email ?? '')}}">
            </div>
            <div class="col-6">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="{{old('telefone', $data->telefone ?? '')}}">
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="./UsuarioList.php" class="btn btn-primary"> Voltar</a>
            </div>


        </form>

    </div>
@stop <!--Aqui ele para-->
