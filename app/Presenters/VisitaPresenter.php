<?php

namespace portaria\Presenters;

use Laracasts\Presenter\Presenter;

class VisitaPresenter extends Presenter 
{

public function dataEntrada()
{
	return Carbon\Carbon::parse($this)
}

}