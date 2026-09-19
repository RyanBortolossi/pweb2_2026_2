<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;

Route::get('/', function () {
    return view('main');
});

Route::get('/aluno', [AlunoController::class, 'index']);
Route::get('/aluno/create', [AlunoController::class, 'create']);
Route::post(
    '/aluno/store',
    [AlunoController::class, 'store']
)->name('aluno.store');

Route::get('/aluno/edit/{id}',
    [AlunoController::class, 'edit'])->name('aluno.edit');
Route::put(
    '/aluno/update/{id}',
    [AlunoController::class, 'update']
)->name('aluno.update');

Route::delete(
    '/aluno/{id}',
    [AlunoController::class, 'destroy']
)->name('aluno.destroy');

Route::post(
    '/aluno/search',
    [AlunoController::class, 'search']
)->name('aluno.search');

Route::resource('curso', \App\Http\Controllers\CursoController::class);
Route::post(
    '/curso/search',
    [AlunoController::class, 'search']
)->name('curso.search');


Route::resource('turma', \App\Http\Controllers\TurmaController::class);
Route::post(
    '/turma/search',
    [AlunoController::class, 'search']
)->name('turma.search');


Route::resource('matricula', \App\Http\Controllers\MatriculaController::class);
Route::post(
    '/matricula/search',
    [AlunoController::class, 'search']
)->name('matricula.search');
/*
Route::get('/aluno', function () {
    return view('aluno.list');
    //return "<h3>Olá mundo Laravel!</h3>";
});
*/
