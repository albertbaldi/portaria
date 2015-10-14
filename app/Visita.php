<?php

namespace portaria;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
	protected $fillable = ['unidade_id', 'data_entrada', 'data_saida', 'placa'];
	protected $guarded = ['id'];


	public function setDataEntradaAttribute($value)
	{
		$date = null;
		if(!empty($value))
			$date = \DateTime::createFromFormat("d/m/Y H:i:s", $value)->format("Y-m-d H:i:s");

		$this->attributes['data_entrada'] = $date;
	}
	public function getDataEntradaAttribute()
	{
		if(empty($this->attributes['data_entrada']))
			return '';

		$date = $this->attributes['data_entrada'];
		return \DateTime::createFromFormat("Y-m-d H:i:s", $date)->format("d/m/Y H:i:s");
	}

	public function setDataSaidaAttribute($value)
	{
		$date = null;
		if(!empty($value))
			$date = \DateTime::createFromFormat("d/m/Y H:i:s", $value)->format("Y-m-d H:i:s");

		$this->attributes['data_saida'] = $date;
	}
	public function getDataSaidaAttribute()
	{

		if(empty($this->attributes['data_saida']))
			return '';

		$date = $this->attributes['data_saida'];
		return \DateTime::createFromFormat("Y-m-d H:i:s", $date)->format("d/m/Y H:i:s");
	}

	public function unidade()
	{
		return $this->belongsTo(\portaria\Unidade::class);
	}
}
