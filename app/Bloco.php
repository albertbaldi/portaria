<?php

namespace portaria;

use Illuminate\Database\Eloquent\Model;

class Bloco extends Model
{
	protected $fillable = ['numero', 'condominio_id'];
	protected $guarded = ['id'];

	public function condominio()
	{
		return $this->belongsTo(\portaria\Condominio::class);
	}

	public function unidades()
	{
		return $this->hasMany(\portaria\Unidade::class);
	}
}
