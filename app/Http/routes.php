<?php

Route::get('/', 'HomeController@index');

Route::get('api/dropdown/condominio_blocos', 'BlocoController@getFromCondominio');
Route::get('api/dropdown/bloco_unidades', 'UnidadeController@getFromBloco');

Route::group(['middleware' => 'auth'], function () {

	/**
	 * Grupo de rotas para o administrador do sistema
	 *
	 * O administrador tem permissão em:
	 * Condominio | Bloco | Unidade | Funcionario
	 */
	Route::group(['prefix' => 'admin'], function () {

		Route::group(['middleware' => 'administrador'], function () {

			//condominios
			Route::get('condominios', ['as' => 'condominio.index', 'uses' => 'CondominioController@index']);
			Route::get('condominio/create', ['as' => 'condominio.create', 'uses' => 'CondominioController@create']);
			Route::post('condominio/store', ['as' => 'condominio.store', 'uses' => 'CondominioController@store']);
			Route::get('condominio/{id}', ['as' => 'condominio.edit', 'uses' => 'CondominioController@edit']);
			Route::post('condominio/{id}', ['as' => 'condominio.update', 'uses' => 'CondominioController@update']);
			Route::get('condominio/destroy/{id}', ['as' => 'condominio.destroy', 'uses' => 'CondominioController@destroy']);
			Route::get('condominio/createStructure/{id}', ['as' => 'condominio.createStructure', 'uses' => 'CondominioController@createStructure']);

			Route::group(['prefix' => 'condominio/{condominio_id}'], function () {
				Route::get('funcionarios', ['as' => 'funcionario.index', 'uses' => 'FuncionarioController@index']);
				Route::get('funcionario/create', ['as' => 'funcionario.create', 'uses' => 'FuncionarioController@create']);
				Route::post('funcionario/create', ['as' => 'funcionario.store', 'uses' => 'FuncionarioController@store']);

				Route::get('blocos', ['as' => 'bloco.index', 'uses' => 'BlocoController@index']);
				Route::get('bloco/create', ['as' => 'bloco.create', 'uses' => 'BlocoController@create']);
				Route::post('bloco/create', ['as' => 'bloco.store', 'uses' => 'BlocoController@store']);
			});
			
			Route::group(['prefix' => 'bloco/{bloco_id}'], function () {
				Route::get('unidades', ['as' => 'unidade.index', 'uses' => 'UnidadeController@index']);
				Route::get('unidade/create', ['as' => 'unidade.create', 'uses' => 'UnidadeController@create']);
				Route::post('unidade/create', ['as' => 'unidade.store', 'uses' => 'UnidadeController@store']);
			});

			Route::get('funcionario/{id}', ['as' => 'funcionario.edit', 'uses' => 'FuncionarioController@edit']);
			Route::post('funcionario/{id}', ['as' => 'funcionario.update', 'uses' => 'FuncionarioController@update']);
			Route::get('funcionario/destroy/{id}', ['as' => 'funcionario.destroy', 'uses' => 'FuncionarioController@destroy']);
			Route::get('funcionario/deactivate/{id}', ['as' => 'funcionario.deactivate', 'uses' => 'FuncionarioController@deactivate']);

			Route::get('bloco/{id}', ['as' => 'bloco.edit', 'uses' => 'BlocoController@edit']);
			Route::post('bloco/{id}', ['as' => 'bloco.update', 'uses' => 'BlocoController@update']);
			Route::get('bloco/destroy/{id}', ['as' => 'bloco.destroy', 'uses' => 'BlocoController@destroy']);
			
			Route::get('unidade/{id}', ['as' => 'unidade.edit', 'uses' => 'UnidadeController@edit']);
			Route::post('unidade/{id}', ['as' => 'unidade.update', 'uses' => 'UnidadeController@update']);
			Route::get('unidade/destroy/{id}', ['as' => 'unidade.destroy', 'uses' => 'UnidadeController@destroy']);

			Route::group(['prefix' => 'unidade/{unidade_id}'], function () {
				Route::get('moradores', ['as' => 'unidade.moradores', 'uses' => 'MoradorController@index']);
			});
		});
});

	/**
	 * Grupo de rotas para funcionários do sistema
	 * 
	 * O funcionário tem permissão de:
	 * Morador | Visita | Funcionario | Despesa | Receita
	 */
	Route::group(['prefix' => 'employee'], function () {

		Route::group(['middleware' => 'sindico'], function () {

			Route::get('funcionarios', ['as' => 'funcionarios', 'uses' => 'funcionarioController@getByLoggedUser']);

			Route::get('morador/create', 'MoradorController@create');
			Route::put('morador/create', 'MoradorController@store');
			Route::put('morador/{id}/destroy', 'MoradorController@destroy');
		});
		
		Route::group(['middleware' => 'funcionario'], function () {
			
			Route::get('visita/create', 'VisitaController@create');
			Route::put('visita/create', 'VisitaController@store');
			Route::get('visita/{id}/edit', 'VisitaController@edit');
			Route::post('visita/{id}/edit', 'VisitaController@update');
			Route::get('visita/{id}/checkout', 'VisitaController@checkout');

		});
	});

	Route::group(['middleware' => 'morador'], function () {	
		Route::get('show', 'UnidadeController@show');
		
	});
	
	Route::get('moradores', 'MoradorController@index');
	Route::get('morador/create', 'MoradorController@create');
	Route::put('morador/create', 'MoradorController@store');
	Route::get('morador/{id}/edit', 'MoradorController@edit');
	Route::post('morador/{id}/edit', 'MoradorController@update');

	Route::get('visitas', 'VisitaController@index');

	Route::get('createUser/{type}/{id}', 'UsuarioController@createUser');

// 	Route::get('report/moradores', 'ReportController@moradores');
// 	Route::get('report/visitasmes', 'ReportController@visitasmes');

// 	Route::group(['middleware' => 'morador'], function () {

// 		Route::group(['prefix' => 'm'], function () {

// 			//index

// 			//moradores
// 			Route::get('moradores', ['as' => 'm_moradores', 'uses' => 'MoradorController@index']);
// 			//morador create
// 			Route::get('morador/create', ['as' => 'm_morador_create', 'uses' => 'MoradorController@create']);
// 			Route::put('morador/create', ['as' => 'm_morador_create', 'uses' => 'MoradorController@store']);
// 			//morador edit
// 			Route::get('morador/{id}', ['as' => 'm_morador_edit', 'uses' => 'MoradorController@edit']);
// 			Route::post('morador/{id}', ['as' => 'm_morador_edit', 'uses' => 'MoradorController@update']);
// 			//morador delete
// 			Route::get('morador/destroy/{id}', ['as' => 'm_morador_destroy', 'uses' => 'MoradorController@destroy']);
// 			//morador create user
// 			Route::get('createUser/{id}', ['as' => 'm_morador_createUser', 'uses' => 'UsuarioController@createUser']);

// 			//visitas
// 			Route::get('visitas', ['as' => 'm_morador_visitas', 'uses' => 'VisitaController@index']);

// 		});
// });



// 			//moradores

// 			//visitas
// 		Route::get('visitas', ['as' => 'f_visitas', 'uses' => 'VisitaController@index']);
// 			//visita create
// 		Route::get('visita/create', ['as' => 'f_visita_create', 'uses' => 'VisitaController@create']);
// 		Route::put('visita/create', ['as' => 'f_visita_create', 'uses' => 'VisitaController@store']);
// 			//visita edit
// 		Route::get('visita/{id}', ['as' => 'f_visita_edit', 'uses' => 'VisitaController@edit']);
// 		Route::post('visita/{id}', ['as' => 'f_visita_edit', 'uses' => 'VisitaController@update']);
// 			//visita checkout
// 		Route::get('visita/checkout/{id}', ['as' => 'f_visita_checkout', 'uses' => 'VisitaController@checkout']);

// 		Route::get('receitas', ['as' => 'f_receitas', 'uses' => 'ReceitaController@index']);
// 		Route::get('despesas', ['as' => 'f_despesas', 'uses' => 'DespesaController@index']);

// 	});



// 			//morador create
// 		Route::get('morador/create', ['as' => 'f_morador_create', 'uses' => 'MoradorController@create']);
// 		Route::put('morador/create', ['as' => 'f_morador_create', 'uses' => 'MoradorController@store']);

// 			//funcionarios
// 			//funcionario create
// 		Route::get('funcionario/create', ['as' => 'f_funcionario_create', 'uses' => 'funcionarioController@create']);
// 		Route::put('funcionario/create', ['as' => 'f_funcionario_create', 'uses' => 'funcionarioController@store']);
// 			//funcionario edit
// 		Route::get('funcionario/{id}', ['as' => 'f_funcionario_edit', 'uses' => 'funcionarioController@edit']);
// 		Route::post('funcionario/{id}', ['as' => 'f_funcionario_edit', 'uses' => 'funcionarioController@update']);
// 			//funcionario delete
// 		Route::get('funcionario/destroy/{id}', ['as' => 'f_funcionario_destroy', 'uses' => 'funcionarioController@destroy']);
// 			//funcionario deactive
// 		Route::get('funcionario/deactivate/{id}', ['as' => 'f_funcionario_deactivate', 'uses' => 'funcionarioController@deactivate']);
// 			//funcionario create user
// 		Route::get('funcionario/createUser/{id}', ['as' => 'f_funcionario_createUser', 'uses' => 'UsuarioController@createUser']);

// 	});
// });


});

