<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Auth;
// use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;

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
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        dd(\JWTAuth::attempt($credentials));

        if (!$token = \JWTAuth::attempt($credentials)) {
            return response([
                'status' => 'error',
                'error' => 'invalid.credentials',
                'msg' => 'Invalid Credentials.'
            ], 400);
        }

        $userRepository = new UserRepository();
        $userLoginData = $userRepository->userLoginData($credentials['email']); 
        
        return response([
            'user' => $userLoginData,
            'status' => 'success',
            'token' => $token,
        ],200);

    }

    public function logout(Request $request) {
        try {
            \JWTAuth::invalidate($request->input('token'));
            return response([
                'status' => 'success',
                'msg' => 'Deslogado com sucesso'
            ], 200);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response([
                'status' => 'error',
                'msg' => 'Erro. Tente novamente.'
            ],400);
        }
    }
}
