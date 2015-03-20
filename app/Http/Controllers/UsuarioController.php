<?php namespace GestorImagenes\Http\Controllers;

class UsuarioController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getEditarPerfil()
	{
		return 'mostrando formulario';
	}

	public function postEditarPerfil()
	{
		return 'generando actualizacion de perfil';
	}

	public function missingMethod($parameters = array())
	{
		abort(404);
	}

}
