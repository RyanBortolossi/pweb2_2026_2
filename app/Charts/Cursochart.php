<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class Cursochart
{
    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        $cursos = Curso::all();
        //dd($cursos);
        $qtdTurmas=[];
        $nomeCursos = [];
        foreach($cursos as $item){
        $nomeCursos [] = $item->nome;
        $qtdTurmas [] = $item->turmas->count();
        }

        return (new LarapexChart)->pieChart()
            ->setTitle('Cursos Disponíveis')
            ->setSubtitle('Season 2021.')
            ->addData($qtdTurmas)
            ->setLabels($nomeCursos);
    }
}
