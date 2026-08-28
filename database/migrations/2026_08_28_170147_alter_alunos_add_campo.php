<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

//php artisan make:migration alter_alunos_add_campo
//
//A gente chama depois ela na Factory para ela se incorporar no aluno
//depois define a chave estrangeira no model categoria aluno 
//depois vai no databaseseeder e chama primeiro a categoria alunoseeder e depois
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('alunos', function (Blueprint $table) {
            $table->string('imagem', 150)->nullable();
            $table->foreignId('categoria_id') //chave nestrangeira (foreing key (tem na documentação))
            ->constrained('categoria_alunos'); //tabela para fazer a relação com a categoria_id
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
