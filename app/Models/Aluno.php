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
        'imagem', //é a primeira coisa que a gente faz, vamos fazer aql negocio de pedir uma imagem, depois vamos para a view ou controller
    ];

    protected $casts = ['categoria_id' => 'integer'];//converte a categoria_id em um campo inteiro //só para dados diferentes de string

    //ao inves de aparecer a categoria vai apareccer o nome
    public function categoria()
    {
        return $this->belongsTo(CategoriaAluno::class, 'categoria_id');
    }
}
