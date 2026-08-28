<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aluno extends Model
{
    use Hasfactory;

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'categoria_id',
    ];

    protected $casts = ['categoria_id' => 'integer'];//converte a categoria_id em um campo inteiro

    //ao inves de aparecer a categoria vai apareccer o nome
    public function categoria()
    {
        return $this->belongsTo(CategoriaAluno::class, 'categoria_id');
    }
}
