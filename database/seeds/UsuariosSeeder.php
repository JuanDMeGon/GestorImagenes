<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use GestorImagenes\Album;
use GestorImagenes\Foto;
use GestorImagenes\Usuario;

class UsuariosSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i=0; $i < 50; $i++)
		{
			Usuario::create(
			[
				'nombre' => "usuario$i",
				'email' => "email$i@test.com",
				'password' => bcrypt("pass$i"),
				'pregunta' => "preg$i",
				'respuesta' => "resp$i"
			]);
		}
	}

}
