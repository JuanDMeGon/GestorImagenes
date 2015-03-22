<?php namespace GestorImagenes\Http\Controllers;

use GestorImagenes\Http\Requests\EditarPerfilRequest;

use Illuminate\Support\Facades\Auth;
class UsuarioController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function getEditarPerfil()
	{
		return view('usuario.actualizar');
	}

	public function postEditarPerfil(EditarPerfilRequest $request)
	{
		$usuario = Auth::user();
		$nombre = $request->get('nombre');

		$usuario->nombre = $nombre;

		if($request->has('password'))
		{
			$usuario->password = bcrypt($request->get('password'));
		}

		if($request->has('pregunta'))
		{
			$usuario->pregunta = $request->get('pregunta');
			$usuario->respuesta = $request->get('respuesta');
		}

		$usuario->save();

		return redirect('/validado')->with('actualizado', 'Su perfil ha sido actualizado.');
	}

	public function missingMethod($parameters = array())
	{
		abort(404);
	}

}
