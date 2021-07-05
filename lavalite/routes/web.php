<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\BotManController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

//Route::get('/', 'PublicController@home');

Route::get('/', [PublicController::class, 'home']);

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
//Route::match(['get', 'post'], 'botman', 'BotManController@handle');

Route::match(['get', 'post'], '/botman/tinker', [BotManController::class, 'tinker']);

//Rotas da Repo_Perguntas
Route::get('perguntas', 'RepoPerguntasController@index')->name('perguntas.index');
Route::get('perguntas/search', 'RepoPerguntasController@search')->name('perguntas.search');
Route::get('perguntas/create', 'RepoPerguntasController@create')->name('perguntas.create');
Route::any('/perguntas/store', 'RepoPerguntasController@store')->name('perguntas.store');
Route::get('perguntas/{id}/edit', 'RepoPerguntasController@edit')->name('perguntas.edit');
Route::any('perguntas/{id}/update', 'RepoPerguntasController@update')->name('perguntas.update');
Route::get('perguntas/{id}/show', 'RepoPerguntasController@show')->name('perguntas.show');
Route::get('perguntas/{id}/destroy', 'RepoPerguntasController@destroy')->name('perguntas.destroy');

//Rotas da Repo_Respostas
Route::get('respostas', 'RepoRespostasController@index')->name('respostas.index');
Route::get('respostas/search', 'RepoRespostasController@search')->name('respostas.search');
Route::get('respostas/create', 'RepoRespostasController@create')->name('respostas.create');
Route::any('respostas/store', 'RepoRespostasController@store')->name('respostas.store');
Route::get('respostas/{id}/edit', 'RepoRespostasController@edit')->name('respostas.edit');
Route::any('respostas/{id}/update', 'RepoRespostasController@update')->name('respostas.update');
Route::get('respostas/{id}/show', 'RepoRespostasController@show')->name('respostas.show');
Route::get('respostas/{id}/destroy', 'RepoRespostasController@destroy')->name('respostas.destroy');

//Rotas de Funcoes
Route::get('funcoes', 'FuncoesController@index')->name('funcoes.index');
Route::get('funcoes/search', 'FuncoesController@search')->name('funcoes.search');
Route::get('funcoes/create', 'FuncoesController@create')->name('funcoes.create');
Route::any('funcoes/store', 'FuncoesController@store')->name('funcoes.store');
Route::get('funcoes/{id}/edit', 'FuncoesController@edit')->name('funcoes.edit');
Route::any('funcoes/{id}/update', 'FuncoesController@update')->name('funcoes.update');
Route::get('funcoes/{id}/show', 'FuncoesController@show')->name('funcoes.show');
Route::get('funcoes/{id}/destroy', 'FuncoesController@destroy')->name('funcoes.destroy');

//Rotas das Conversas
Route::get('conversas', 'ConversasController@index')->name('conversas.index');
Route::get('conversas/search', 'ConversasController@search')->name('conversas.search');
Route::get('conversas/create', 'ConversasController@create')->name('conversas.create');
Route::any('conversas/store', 'ConversasController@store')->name('conversas.store');
Route::get('conversas/{id}/edit', 'ConversasController@edit')->name('conversas.edit');
Route::any('conversas/{id}/update', 'ConversasController@update')->name('conversas.update');
Route::get('conversas/{id}/show', 'ConversasController@show')->name('conversas.show');
Route::get('conversas/{id}/destroy', 'ConversasController@destroy')->name('conversas.destroy');

//Rota Classe
Route::get('classes', 'CriarClasseController@index')->name('classes.index');
Route::get('classes/search', 'CriarClasseController@search')->name('classes.search');
Route::get('classes/create', 'CriarClasseController@create')->name('classes.create');
Route::any('classes/store', 'CriarClasseController@store')->name('classes.store');
Route::get('classes/{id}/edit', 'CriarClasseController@edit')->name('classes.edit');
Route::any('classes/{id}/update', 'CriarClasseController@update')->name('classes.update');
Route::get('classes/{id}/show', 'CriarClasseController@show')->name('classes.show');
Route::get('classes/{id}/destroy', 'CriarClasseController@destroy')->name('classes.destroy');
Route::any('classes/gerar', 'CriarClasseController@gerarClasse')->name('classes.gerar');

//Rota Dinamica
Route::get('dinamica', 'DinamicaController@index')->name('dinamica.index');
Route::get('dinamica/search', 'DinamicaController@search')->name('dinamica.search');
Route::get('dinamica/create', 'DinamicaController@create')->name('dinamica.create');
Route::any('dinamica/store', 'DinamicaController@store')->name('dinamica.store');
Route::get('dinamica/{id}/edit', 'DinamicaController@edit')->name('dinamica.edit');
Route::any('dinamica/{id}/update', 'DinamicaController@update')->name('dinamica.update');
Route::get('dinamica/{id}/show', 'DinamicaController@show')->name('dinamica.show');
Route::get('dinamica/{id}/destroy', 'DinamicaController@destroy')->name('dinamica.destroy');
Route::any('dinamica/gerar', 'DinamicaController@gerarClasse')->name('dinamica.gerar');


Route::group(
    [
        'prefix' => '{guard}',
        'as' => 'guard.',
        'where' => ['guard' => implode('|', array_keys(config('auth.guards')))],
    ],

    function () {
        Auth::routes();
        Route::get('/', 'ResourceController@home')->name('home');
        Route::get('login/{provider}', 'Auth\SocialAuthController@redirectToProvider');
        Route::group(['prefix' => 'user'], function () {
            Route::resource('user', 'User\UserResourceController');
            Route::resource('{type}', 'User\ClientResourceController', ['parameters' => [
                '{type}' => 'client',
            ]]);

        });
        //Route::get('profile/{user}', 'UserPublicController@profile');

    }
    
);

Route::group(
    [
        'middleware' => 'trans',
        'prefix' => '{trans}',
        'as' => 'trans.',
        'where' => ['trans' => Trans::keys('|')],
    ],
    function () {
        Route::group(
            [
                'prefix' => '{guard}',
                'as' => 'guard.',
                'where' => ['guard' => implode('|', array_keys(config('auth.guards')))],
            ],
            function () {
                Auth::routes();
                Route::get('/', 'ResourceController@home')->name('home');
                Route::get('login/{provider}', 'Auth\SocialAuthController@redirectToProvider');
                Route::group(['prefix' => 'user'], function () {
                    Route::resource('user', 'User\UserResourceController');
                    Route::resource('{type}', 'User\ClientResourceController', ['parameters' => [
                        '{type}' => 'client',
                    ]]);
                });
                //Route::get('profile/{user}', 'UserPublicController@profile');
            }
        );
    }
);