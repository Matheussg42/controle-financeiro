<?php

    namespace App\Http\Controllers;

    use App\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
    use JWTAuth;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use App\Repositories\User\UserRepository;

    /**
     * @group User Controller
     * 
     * Endpoints para as funcionalidades de Usuário.
     */
    class UserController extends Controller
    {
        /**
         * Login de Usuário
         * 
         * @bodyParam email string E-mail do Usuário. Example: nometeste@mail.com
         * @bodyParam password string Senha do Usuário. Example: 123456
         * 

         * @response {
         *   "user": {
         *     "id": 14,
         *     "name": "Nome Teste",
         *     "email": "nometeste@mail.com"
         *   },
         *   "status": "success",
         *   "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9yZWdpc3RlciIsImlhdCI6MTU4NzUxMzM5OSwiZXhwIjoxMDI1NDE3OTc5OSwibmJmIjoxNTg3NTEzMzk5LCJqdGkiOiJJeWlZZ0hiY1VMQXpvemxXIiwic3ViIjoxNCwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.vafNnsQt9SymgstX3B6CRkypIfwz7NM8TFhkIXg3DvE"
         * }
         * 
         */
        public function authenticate(Request $request)
        {
            $credentials = $request->only('email', 'password');

            try {
                if (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json(['error' => 'invalid_credentials'], 400);
                }
            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }

            $userRepository = new UserRepository();
            $userLoginData = $userRepository->userLoginData($credentials['email']); 
            
            return response([
                'user' => $userLoginData,
                'status' => 'success',
                'token' => $token,
            ],200);
        }

        /**
         * Cadastrar  usuário
         * 
         * @bodyParam name string Nome do Usuário. Example: Nome Teste
         * @bodyParam email string E-mail do Usuário. Example: nometeste@mail.com
         * @bodyParam password string Senha do Usuário. Example: 123456
         * @bodyParam password_confirmation string Confirmação da senha do Usuário. Example: 123456
         * 
         * @response {
         *   "user": {
         *     "name": "Nome Teste",
         *     "email": "nometeste@mail.com",
         *     "updated_at": "2020-04-21 20:56:39",
         *     "created_at": "2020-04-21 20:56:39",
         *     "id": 14
         *   },
         *   "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC9yZWdpc3RlciIsImlhdCI6MTU4NzUxMzM5OSwiZXhwIjoxMDI1NDE3OTc5OSwibmJmIjoxNTg3NTEzMzk5LCJqdGkiOiJJeWlZZ0hiY1VMQXpvemxXIiwic3ViIjoxNCwicHJ2IjoiODdlMGFmMWVmOWZkMTU4MTJmZGVjOTcxNTNhMTRlMGIwNDc1NDZhYSJ9.vafNnsQt9SymgstX3B6CRkypIfwz7NM8TFhkIXg3DvE"
         * }
         * 
         */
        public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|confirmed',
            ]);

            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }

            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
            ]);

            $token = JWTAuth::fromUser($user);

            return response()->json(compact('user','token'),201);
        }

        /**
         * Logout de Usuário
         * 
         * @response {
         *  "status": "success",
         *  "msg": "Deslogado com sucesso"
         * }
         * 
         */
        public function logout(Request $request) {
            try {
                JWTAuth::invalidate($request->input('token'));
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

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        // public function store(StoreUser $request)
        // {
        //     try{        
        //         $data = $this->user->create($request->all());
        //     }catch(\Throwable|\Exception $e){
        //         return ResponseService::exception('users.store',null,$e);
        //     }

        //     return new UserResource($data,array('type' => 'store','route' => 'users.store'));
        // }

        static function getUserName($id){
            $user = new UserRepository();
            $userName = $user->getUserName($id);
            return $userName;
        }
    }