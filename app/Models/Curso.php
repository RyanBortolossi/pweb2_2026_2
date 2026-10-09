<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\WithoutTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{

  protected $fillable = [
    'nome',
    'requisito',
    'carga_horaria',
    'valor',
  ];
  protected $casts = [
    'carga_horaria' => 'float',
    'valor' => 'float',
  ];


  public function turmas()
  {
    return $this->hasMany(Turma::class);
  }
  public function alunos()
  {
    return $this->belongsToMany(ALuno::class, 'matriculas', 'curso_id', 'aluno_id')
    ->withPivot('turma_id', 'data_matricula')
    ->WithoutTimestamps; //pivot é uma relação
  }
  public function matriculas()
  {
    return $this->hasMany(Matricula::class);
  }

}
