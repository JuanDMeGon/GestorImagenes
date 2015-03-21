<?php namespace GestorImagenes\Http\Controllers;

class InicioController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getIndex()
	{
		return view('inicio');
	}

	public function missingMethod($parameters = array())
	{
		abort(404);
	}

}
