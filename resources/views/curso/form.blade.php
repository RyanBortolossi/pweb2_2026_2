@extends('main')
@section('titulo', 'Formulário de Cursos')
@section('conteudo')
<div class="row">
    @php
        if (!empty($data->id)) {
            $action = route('curso.update', $data->id);
        } else {
            $action = route('curso.store');
        }
    @endphp

    <h4>Formulário Curso</h4>
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
            <label for="requisito">CPF</label>
            <input type="text" name="requisito" class="form-control" value="{{ old('requisito', $data->requisito ?? '') }}">
        </div>
        <div class="col-6">
            <label for="carga_horaria">Carga Horaria</label>
            <input type="text" name="carga_horaria" class="form-control"
                value="{{ old('carga_horaria', $data->carga_horaria ?? '') }}">
        </div>
        <div class="col-6">
            <label for="valor">Valor</label>
            <input type="text" name="valor" class="form-control"
                value="{{ old('valor', $data->valor ?? '') }}">
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
            <a href="{{ url('curso') }}" class="btn btn-primary"> Voltar</a>
        </div>
    </form>
</div>
@stop