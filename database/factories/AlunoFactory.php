<?php

namespace Database\Factories;

use App\Models\Aluno;
use App\Models\CategoriaAluno;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Aluno>
 */
class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'nome' => fake()->name(),
            'cpf' => fake()->numerify('###.###.###-##'),
            'telefone' => fake()->phoneNumber(),
            'categooria_id' => (CategoriaAluno::All->random())->id, //ele puxa os dados dql outra tabela que criamos (a estrangeira)
        ];
    }
}
