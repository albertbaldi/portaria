<div class="form-group">
	{!! Form::label('nome', 'Nome') !!}
	{!! Form::text('nome', null, ['class' => 'form-control']) !!}
</div>
<p class="text-right">
	{!! Form::submit('gravar', ['class' => 'btn btn-primary']) !!}
</p>
