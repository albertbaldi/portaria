<?php

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'api/dropdown', 'as' => 'api_dropdown_'], function () {
	Route::get('condominio_blocos', ['as' => 'condominio_blocos', 'uses' => 'BlocoController@getFromCondominio']);
	Route::get('bloco_unidades', ['as' => 'bloco_unidades', 'uses' => 'UnidadeController@getFromBloco']);
});

Route::group(['middleware' => 'auth'], function () {

	/**
	 * Grupo de rotas para o administrador do sistema
	 *
	 * O administrador tem permissão em:
	 * Condominio | Bloco | Unidade | Funcionario
	 */
	Route::group(['middleware' => 'administrador', 'prefix' => 'admin', 'as' => 'admin.'], function () {

		Route::group(['prefix' => 'condominio', 'as' => 'condominio.'], function () {
			Route::get('', ['as' => 'index', 'uses' => 'CondominioController@index']);
			Route::get('novo', ['as' => 'create', 'uses' => 'CondominioController@create']);
			Route::post('salvar', ['as' => 'store', 'uses' => 'CondominioController@store']);
			Route::get('editar/{id}', ['as' => 'edit', 'uses' => 'CondominioController@edit']);
			Route::post('atualizar/{id}', ['as' => 'update', 'uses' => 'CondominioController@update']);
			Route::get('excluir/{id}', ['as' => 'destroy', 'uses' => 'CondominioController@destroy']);
			Route::get('criarEstrutura/{id}', ['as' => 'createStructure', 'uses' => 'CondominioController@createStructure']);
		});

		Route::group(['prefix' => 'condominio/{condominio_id}/funcionario', 'as' => 'funcionario.'], function () {
			Route::get('', ['as' => 'index', 'uses' => 'FuncionarioController@index']);
			Route::get('novo', ['as' => 'create', 'uses' => 'FuncionarioController@create']);
			Route::post('incluir', ['as' => 'store', 'uses' => 'FuncionarioController@store']);
		});

		Route::group(['prefix' => 'funcionario', 'as' => 'funcionario.'], function () {
			Route::get('editar/{id}', ['as' => 'edit', 'uses' => 'FuncionarioController@edit']);
			Route::post('atualizar/{id}', ['as' => 'update', 'uses' => 'FuncionarioController@update']);
			Route::get('excluir/{id}', ['as' => 'destroy', 'uses' => 'FuncionarioController@destroy']);
			Route::get('desativar/{id}', ['as' => 'deactivate', 'uses' => 'FuncionarioController@deactivate']);
		});

		Route::group(['prefix' => 'condominio/{condominio_id}/bloco', 'as' => 'bloco.'], function () {
			Route::get('', ['as' => 'index', 'uses' => 'BlocoController@index']);
			Route::get('novo', ['as' => 'create', 'uses' => 'BlocoController@create']);
			Route::post('incluir', ['as' => 'store', 'uses' => 'BlocoController@store']);
		});

		Route::group(['prefix' => 'bloco', 'as' => 'bloco.'], function () {
			Route::get('editar/{id}', ['as' => 'edit', 'uses' => 'BlocoController@edit']);
			Route::post('atualizar/{id}', ['as' => 'update', 'uses' => 'BlocoController@update']);
			Route::get('excluir/{id}', ['as' => 'destroy', 'uses' => 'BlocoController@destroy']);
		});

		Route::group(['prefix' => 'bloco/{bloco_id}/unidade', 'as' => 'unidade.'], function () {
			Route::get('', ['as' => 'index', 'uses' => 'UnidadeController@index']);
			Route::get('novo', ['as' => 'create', 'uses' => 'UnidadeController@create']);
			Route::post('incluir', ['as' => 'store', 'uses' => 'UnidadeController@store']);
		});

		Route::group(['prefix' => 'unidade', 'as' => 'unidade.'], function () {
			Route::get('editar/{id}', ['as' => 'edit', 'uses' => 'UnidadeController@edit']);
			Route::post('atualizar/{id}', ['as' => 'update', 'uses' => 'UnidadeController@update']);
			Route::get('excluir/{id}', ['as' => 'destroy', 'uses' => 'UnidadeController@destroy']);
		});

		Route::group(['prefix' => 'unidade/{unidade_id}', 'as' => 'unidade.'], function () {
			Route::get('moradores', ['as' => 'moradores', 'uses' => 'MoradorController@index']);
		});
	});

	/**
	 * Grupo de rotas para funcionários do sistema
	 * 
	 * O funcionário tem permissão de:
	 * Morador | Visita | Funcionario | Despesa | Receita
	 */
	Route::group(['middleware' => 'sindico', 'prefix' => 'sindico', 'as' => 'sindico.'], function () {
		
		Route::get('funcionario', ['as' => 'funcionario', 'uses' => 'funcionarioController@getByLoggedUser']);

		Route::group(['as' => 'morador.', 'prefix' => 'morador'], function () {
			Route::get('novo', ['as' => 'create', 'uses' => 'MoradorController@create']);
			Route::post('incluir', ['as' => 'store','uses' => 'MoradorController@store']);
			Route::get('editar/{id}', ['as' => 'edit', 'uses' => 'MoradorController@edit']);
			Route::post('atualizar/{id}', ['as' => 'update','uses' => 'MoradorController@update']);
			Route::get('excluir/{id}', ['as' => 'destroy', 'uses' => 'MoradorController@destroy']);
		});

	});

	Route::group(['middleware' => 'funcionario', 'as' => 'funcionario.'], function () {
		
		Route::group(['prefix' => 'visita', 'as' => 'visita.'], function () {
			Route::get('novo', ['as' => 'create', 'uses' => 'VisitaController@create']);
			Route::post('incluir', ['as' => 'store', 'uses' => 'VisitaController@store']);
			Route::get('editar/{id}', ['as' => 'edit', 'uses' => 'VisitaController@edit']);
			Route::post('atualizar/{id}', ['as' => 'update', 'uses' => 'VisitaController@update']);
			Route::get('finalizar/{id}', ['as' => 'checkout', 'uses' => 'VisitaController@checkout']);
		});

	});

	Route::group(['middleware' => 'morador', 'prefix' => 'morador', 'as' => 'morador.'], function () {	
		Route::group(['as' => 'morador.'], function (){
			Route::get('show', ['as' => 'show', 'uses' => 'UnidadeController@show']);
			Route::get('visitas', ['as' => 'visita', 'uses' => 'VisitaController@index']);

			Route::get('moradores', ['as' => 'morador', 'uses' => 'MoradorController@index']);
			Route::get('novo', ['as' => 'create', 'uses' => 'MoradorController@create']);
			Route::post('incluir', ['as' => 'store','uses' => 'MoradorController@store']);
			Route::get('editar/{id}', ['as' => 'edit', 'uses' => 'MoradorController@edit']);
			Route::post('atualizar/{id}', ['as' => 'update','uses' => 'MoradorController@update']);
			Route::get('excluir/{id}', ['as' => 'destroy', 'uses' => 'MoradorController@destroy']);

		});
	});

	Route::get('visita', ['as' => 'visita.index','uses' => 'VisitaController@index']);
	
	Route::get('criarUsuario/{type}/{id}', ['as' => 'create_user','uses' => 'UsuarioController@createUser']);
});

