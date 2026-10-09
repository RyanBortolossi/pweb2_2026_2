<!DOCTYPE html>
<html lang="en">

<head>

    <title>{{ $titulo }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

</html>
<div class="row mt-4">


    @foreach ($dados as $item)
        <h4>Curso: {{$item->nome}}</h4>

        @if($item->alunos->isEmpty())
            <p>Nenhum registo encontrado</p>
        @else
            <p>Total de alunos matriculados neste curso: {{ $item->alunos->count() }}</p>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">requisito</th>
                        <th scope="col">carga_horaria</th>
                        <th scope="col">valor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($item->alunos as $alunos)
                        <tr>
                            <th scope='row'>{{ $aluno->id }}</th>
                            <td>{{ $aluno->nome }}</td>
                            <td>{{ $aluno->cpf }}</td>
                            <td>{{ $aluno->telefone }}</td>
                            <td>{{ $aluno->categoria->nome ?? ' - ' }}</td>
                            <td>{{ $dataMatricula ?? ' - ' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endforeach

    </table>
</div>
@stop
</body>

</html>