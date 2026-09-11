@extends('main')
@section('titulo', 'Formulário de Alunos')
@section('conteudo')
<div class="row">
    @php
        if (!empty($data->id)) {
            $action = route('aluno.update', $data->id);
        } else {
            $action = route('aluno.store');
        }
    @endphp

    <h4>Formulário Aluno</h4>
    <form action="{{ $action }}" method="post" enctype="multipart/form-data"> <!--ESSE ENCTYPE É ESSENCIAL PARA SUBMETER A IMAGEM, PQ ELE FALA QUE O FORM VAI ENVIR ARQUIVOS PRO BANCO-->
        @csrf
        @if (!empty($data->id))
            @method('PUT')
        @endif

        <input type="hidden" name="id" value="{{ old('id', $data->id ?? '') }}">
        <div class="col-6">
            <label for="nome">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome', $data->nome ?? '') }}">
        </div>
        <div class="col-6">
            <label for="cpf">CPF</label>
            <input type="cpf" name="cpf" class="form-control" value="{{ old('cpf', $data->cpf ?? '') }}">
        </div>
        <div class="col-6">
            <label for="telefone">Telefone</label>
            <input type="text" name="telefone" class="form-control"
                value="{{ old('telefone', $data->telefone ?? '') }}">
        </div>

        <!--IMAGEM-->
        <!--FILE SERVE PARA QUALQUER TIPO DE ARQUIVO, DAI NO CONTROLLER FAZ O REQUIREMENT PARA PERMITIR Q O USER SÓ COLOQUE IMAGENS-->
        <!--TEM QUE COLOCAR O ENCTYPE LÁ EM CIMA-->
        <div class="col-6">
            <label for="imagem">Imagem</label>

            @php
             $nome_imagem = !empty($data->imagem) ? $data->imagem : ''; // if else se o dado da imagem estiver vazio
            @endphp
            <img src="/storage/{{ $nome_imagem }}" 
            class="rounded-circle" width="200px" height="200px" alt="Imagem"/>
            <input type="file" name="imagem" class="form-control" 
                value="{{ old('imagem', $data->imagem ?? '') }}">
        </div>
        <div class="col-6">
            <label for="categoria">Categoria</label>

            <select name="categoria_id" class="form-select">
                @foreach ($categorias as $item)
                    <!--Todas os itens foram jogados em $categorias (que vem do controller)-->
                    <!--Isso é para fazer aquele negocio de quando vc edita ele fica selecionado-->
                    <!--Percore os itens para preencher as options-->
                    <option value="{{ $item->id }}" {{ old('categoria', $data->categoria ?? '') == $item->id ? 'selected' : ''  }}> <!--se o id existir, carrega o selected, se não, carrega vazio-->
                        {{ $item->nome }}
                    </option>
                @endforeach

            </select>

            <input type="text" name="categoria" class="form-control"
                value="{{ old('categoria', $data->categoria ?? '') }}">
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ url('aluno') }}" class="btn btn-primary"> Voltar</a>
        </div>
    </form>
</div>
@stop