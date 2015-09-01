<?php

namespace portaria;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
	protected $fillable = ['numero', 'bloco_id'];
	protected $guarded = ['id'];

	public function bloco()
	{
		return $this->belongsTo('portaria\Bloco');
	}

	public function moradores()
	{
		return $this->hasMany('portaria\Morador');
	}

	public function visitas()
	{
		return $this->hasMany('portaria\Visita');
	}
}
