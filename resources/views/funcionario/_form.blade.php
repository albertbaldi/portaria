<div class="panel-body">
	
	{!! Form::hidden('condominio_id') !!}
	<div class="form-group">
		{!! Form::label('nome', 'Nome') !!}
		{!! Form::text('nome', null, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('cpf', 'CPF') !!}
		{!! Form::text('cpf', null, ['class' => 'form-control cpf', 'style' => 'width:130px;']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('data_nascimento', 'Data nascimento') !!}
		{!! Form::text('data_nascimento', null, ['class' => 'form-control date', 'style' => 'width:105px;']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('email', 'E-mail') !!}
		{!! Form::text('email', null, ['class' => 'form-control text-lowercase']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('telefone', 'Telefone') !!}
		{!! Form::text('telefone', null, ['class' => 'form-control telefone', 'style' => 'width:120px;']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('celular', 'Celular') !!}
		{!! Form::text('celular', null, ['class' => 'form-control telefone', 'style' => 'width:120px;']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('data_admissao', 'Data admissão') !!}
		{!! Form::text('data_admissao', null, ['class' => 'form-control date', 'style' => 'width:105px;']) !!}
	</div>
	<div class="form-group">
		<div class="checkbox">
			<label>
				{!! Form::checkbox('ativo', 1, null) !!} Ativo
			</label>
		</div>
	</div>
	@if(Auth::user()->master)
	<div class="form-group">
		<div class="checkbox">
			<label>
				{!! Form::checkbox('sindico', 1, null) !!} Síndico
			</label>
		</div>
	</div>
	@endif
</div>
<div class="panel-footer text-right">
	@if(empty($row->user_id) && $row->id > 0)
	<a href="{!! action('UsuarioController@createUser', ['f', $row->id]) !!}"class="btn btn-default">gerar usuário</a> |
	@endif
	<a href="{!! route('funcionario.index', [$row->condominio_id]) !!}" class="btn btn-default">cancelar</a>
	{!! Form::submit('gravar', ['class' => 'btn btn-primary']) !!}
</div>
