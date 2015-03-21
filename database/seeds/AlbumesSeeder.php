<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use GestorImagenes\Album;
use GestorImagenes\Foto;
use GestorImagenes\Usuario;

class AlbumesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$usuarios = Usuario::all();

		foreach ($usuarios as $usuario)
		{
			$cantidad = rand(0, 15);
			for ($i=0; $i < $cantidad; $i++)
			{
				Album::create(
				[
					'nombre' => "Nombre album$i",
					'descripcion' => "Descripcion album $i", 
					'usuario_id' => $usuario->id
				]);
			}
		}
	}

}
