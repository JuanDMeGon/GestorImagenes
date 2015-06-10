<?php namespace GestorImagenes\Http\Controllers\Validacion;

use GestorImagenes\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

use GestorImagenes\Http\Requests\IniciarSesionRequest;
use GestorImagenes\Http\Requests\RecuperarContrasenaRequest;

use GestorImagenes\Usuario;

use Validator;
use Auth;

class ValidacionController extends Controller 
{
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'getSalida']);
	}

	public function getRegistro()
	{
		return view('validacion.registro');
	}

	public function postRegistro(Request $request)
	{
		$validator = $this->validator($request->all());

		if ($validator->fails())
		{
			$this->throwValidationException(
				$request, $validator
			);
		}

		Auth::login($this->create($request->all()));

		return redirect($this->redirectPath());
	}

	public function getInicio()
	{
		return view('validacion.inicio');
	}

	public function postInicio(IniciarSesionRequest $request)
	{
		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}

	protected function getFailedLoginMessage()
	{
		return 'email o contraseña incorrectos.';
	}

	public function getSalida()
	{
		Auth::logout();

		return redirect('/');
	}

	public function redirectPath()
	{
		if (property_exists($this, 'redirectPath'))
		{
			return $this->redirectPath;
		}

		return property_exists($this, 'redirectTo') ? $this->redirectTo : '/inicio';
	}

	public function loginPath()
	{
		return property_exists($this, 'loginPath') ? $this->loginPath : '/validacion/inicio';
	}

	public function getRecuperar()
	{
		return view('validacion.recuperar');
	}

	public function postRecuperar(RecuperarContrasenaRequest $request)
	{
		$pregunta = $request->get('pregunta');
		$respuesta = $request->get('respuesta');

		$email = $request->get('email');

		$usuario = Usuario::where('email', '=', $email)->first();

		if($pregunta === $usuario->pregunta && $respuesta === $usuario->respuesta)
		{
			$contrasena = $request->get('password');
			$usuario->password = bcrypt($contrasena);

			$usuario->save();

			return redirect('/validacion/inicio')->with(['recuperada' => 'La contarseña se cambió. Inicia sesión']);

		}

		return redirect('/validacion/recuperar')->withInput($request->only('email', 'pregunta'))
		->withErrors(['pregunta' => 'La pregunta y/o respuesta ingresadas no coinciden.']);
	}

	public function missingMethod($parameters = array())
	{
		abort(404);
	}

	public function validator(array $data)
	{
		return Validator::make($data, [
			'nombre' => 'required|max:255',
			'email' => 'required|email|max:255|unique:usuarios',
			'password' => 'required|confirmed|min:6',
			'pregunta' => 'required|max:255',
			'respuesta' => 'required|max:255'
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return Usuario::create([
			'nombre' => $data['nombre'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'pregunta' => $data['pregunta'],
			'respuesta' => $data['respuesta'],
		]);
	}

}
