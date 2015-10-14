<?php

namespace portaria;

use Illuminate\Database\Eloquent\Model;

class Condominio extends Model
{
	protected $fillable = ['nome'];

	protected $guarded = ['id'];

	public function blocos()
	{
		return $this->hasMany(\portaria\Bloco::class);
	}

	public function funcionarios()
	{
		return $this->hasMany(\portaria\Funcionario::class);
	}
}
