<?php

namespace portaria;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
	protected $fillable = ['nome', 'cpf', 'email', 'telefone', 'celular', 'data_nascimento', 'data_admissao', 'ativo', 'sindico', 'user_id', 'condominio_id'];
	protected $guarded = ['id'];
	protected $casts = ['ativo' => 'boolean'];

	public function setDataNascimentoAttribute($value)
	{
		$date = null;
		if(!empty($value))
			$date = \DateTime::createFromFormat("d/m/Y", $value)->format("Y-m-d");

		$this->attributes['data_nascimento'] = $date;
	}
	public function getDataNascimentoAttribute()
	{
		if(!isset($this->attributes['data_nascimento']))
			return '';
		
		$value = $this->attributes['data_nascimento'];

		return \DateTime::createFromFormat("Y-m-d", $value)->format("d/m/Y");
	}

	public function setDataAdmissaoAttribute($value)
	{
		$date = null;
		if(!empty($value))
			$date = \DateTime::createFromFormat("d/m/Y", $value)->format("Y-m-d");

		$this->attributes['data_admissao'] = $date;
	}
	public function getDataAdmissaoAttribute()
	{
		if(!isset($this->attributes['data_admissao']))
			return '';

		$value = $this->attributes['data_admissao'];

		return \DateTime::createFromFormat("Y-m-d", $value)->format("d/m/Y");
	}

	public function setAtivoAttribute($value)
	{
		$this->attributes['ativo'] = $value ? 1 : 0;
	}
	public function getAtivoAttribute()
	{
		if($this->id == 0)
			return true;

		return $this->attributes['ativo'] ? true : false;
	}

	public function setSindicoAttribute($value)
	{
		$this->attributes['sindico'] = $value ? 1 : 0;
	}
	public function getSindicoAttribute()
	{
		if($this->id == 0)
			return false;

		return $this->attributes['sindico'] ? true : false;
	}

	public function user()
	{
		return $this->hasOne('portaria\User', 'id', 'user_id');
	}

	public function condominio()
	{
		return $this->belongsTo('portaria\Condominio');
	}
}
