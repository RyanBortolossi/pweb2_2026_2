<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;
class QtdAlunoCursoChart
{
    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        $qtdAlunosPorCurso = DB::table('matriculas')
            ->join('cursos', 'cursos.id', '=', 'matriculas.curso_id')
            ->select('cursos.nome', DB::raw('count(1) as qtd_alunos'))
            ->groupBy('cursos.nome')
            ->orderBy('qtd_alunos', 'desc')
            ->get();

        $qtdAlunos = [];
        $nomeCursos = [];
        foreach ($qtdAlunosPorCurso as $item) {
            $nomeCursos[] = $item->nome;
            $qtdAlunos[] = $item->qtd_alunos;
        }

        return (new LarapexChart)->pieChart()
            ->setTitle('Quantidade de Alunos por Alunos')
            ->setSubtitle('Season 2021.')
            ->addData($qtdAlunos)
            ->setLabels($nomeCursos);
    }
}

