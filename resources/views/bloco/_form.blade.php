{!! Form::hidden('condominio_id') !!}
<div class="form-group">
	{!! Form::label('numero', 'Número') !!}
	{!! Form::text('numero', null, ['class' => 'form-control']) !!}
</div>
<p class="text-right">
	{!! Form::submit('gravar', ['class' => 'btn btn-primary']) !!}
</p>
