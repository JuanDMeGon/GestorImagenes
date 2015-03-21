<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use GestorImagenes\Album;
use GestorImagenes\Foto;
use GestorImagenes\Usuario;

class FotosSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$albumes = Album::all();

		foreach ($albumes as $album)
		{
			$cantidad = rand(0, 5);
			for ($i=0; $i < $cantidad; $i++)
			{
				Foto::create(
				[
					'nombre' => "Nombre album$i",
					'descripcion' => "Descripcion album $i",
					'ruta' => '/img/text.png',
					'album_id' => $album->id
				]);
			}
		}
	}

}
