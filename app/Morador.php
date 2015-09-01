<?php

namespace portaria;

use Illuminate\Database\Eloquent\Model;

class Morador extends Model
{
	protected $table = 'moradores';

	protected $fillable = ['nome', 'email', 'telefone', 'celular', 'data_nascimento', 'cpf', 'responsavel', 'user_id', 'unidade_id'];
	protected $guarded = ['id'];
	protected $casts = ['responsavel' => 'boolean'];

	public function setDataNascimentoAttribute($value)
	{
		$date = null;
		if(!empty($value))
			$date = \DateTime::createFromFormat("d/m/Y", $value)->format("Y-m-d");

		$this->attributes['data_nascimento'] = $date;
	}
	public function getDataNascimentoAttribute()
	{
		$value = $this->attributes['data_nascimento'];

		if(empty($value))
			return '';

		return \DateTime::createFromFormat("Y-m-d", $value)->format("d/m/Y");
	}

	public function setResponsavelAttribute($value)
	{
		$this->attributes['responsavel'] = $value ? 1 : 0;
	}
	public function getResponsavelAttribute()
	{
		if($this->id == 0)
			return false;
		
		return $this->attributes['responsavel'] ? true : false;
	}


	public function user()
	{
		return $this->hasOne('portaria\User', 'id', 'user_id');
	}

	public function unidade()
	{
		return $this->belongsTo('portaria\Unidade');
	}
}
