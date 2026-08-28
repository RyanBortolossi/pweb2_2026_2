<?php

namespace Database\Factories;

use App\Models\Aluno;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CategoriaAluno;

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
        // Puxa uma categoria existente ou cria uma nova automaticamente:
        'categoria_id' => CategoriaAluno::inRandomOrder()->first()?->id ?? CategoriaAluno::factory(),
    ];
}
    //public function definition(): array
    //{
      //   return [
        //    'nome' => fake()->name(),
          //  'cpf' => fake()->numerify('###.###.###-##'),
            //'telefone' => fake()->phoneNumber(),
            //'categoria_id' => (CategoriaAluno::All()->random())->id, //ele puxa os dados dql outra tabela que criamos (a estrangeira)
        //];
    //}
}
