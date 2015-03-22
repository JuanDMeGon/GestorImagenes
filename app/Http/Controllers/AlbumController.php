<?php namespace GestorImagenes\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use GestorImagenes\Http\Requests\CrearAlbumRequest;

use GestorImagenes\Album;

class AlbumController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}


	public function getIndex()
	{
		$usuario = Auth::user();

		$albumes = $usuario->albumes;

		return view('albumes.mostrar', ['albumes' => $albumes]);
	}

	public function getCrearAlbum()
	{
		return view('albumes.crear-album');
	}

	public function postCrearAlbum(CrearAlbumRequest $request)
	{
		$usuario = Auth::user();

		Album::create
		(
			[
				'nombre' => $request->get('nombre'),
				'descripcion' => $request->get('descripcion'),
				'usuario_id' => $usuario->id
			]
		);

		return redirect('/validado/albumes')->with('creado', 'El album ha sido creado');
	}

	public function getActualizarAlbum()
	{
		return 'formulario de actualizar Albums';
	}

	public function postActualizarAlbum()
	{
		return 'actualizar Album';
	}

	public function getEliminarAlbum()
	{
		return 'formulario de eliminar Albums';
	}

	public function postEliminarAlbum()
	{
		return 'eliminar Album';
	}

	public function missingMethod($parameters = array())
	{
		abort(404);
	}

}
