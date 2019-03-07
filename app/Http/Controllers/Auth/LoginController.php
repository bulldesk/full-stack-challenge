<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var  string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return  void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Login do usuário
     * 
     * @param  object  $request  Objeto contendo email e password
     * @return  response
     */
    public function login(Request $request)
    {
        // Inicialzia as variaveis
        $data = $request->all();
        $user = false;
        $code = 403;

        // Valida os dados
        $validation =  Validator::make($data, [
          'email'      => 'required|string|email|max:255',
          'password'   => 'required|string',
        ]);

        // Em caso de erro
        if ($validation->fails()) {
            $v = $validation->errors();
            $v = json_decode($v);

            if (isset($v->password)) {
                $message = "Por favor verifique sua senha!";
            } else if (isset($v->email)) {
                $message = "Por favor verifique seu e-mail!";
            }

        // Em caso de sucesso
        } else {

            // Autentica o usuário
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {

                $user = auth()->user();
                $user->token = $user->createToken($user->email)->accessToken;

                $message = 'Login efetuado com sucesso!';
                $code = 200;

            } else {
                $message = 'E-mail e/ou senha incorreto';
            }
        }

        return $this->api_response($user, $code, $message);
    }

    /**
     * Logout do usuário
     * 
     * @return response
     */
    public function logout()
    {
      $code = 200;
      $message = "Logout realizado com sucesso!";
      $user = \Auth::user();
      DB::table("oauth_access_tokens")->where("user_id", $user->id)->delete();
      return $this->api_response(null, $code, $message);
    }
}
