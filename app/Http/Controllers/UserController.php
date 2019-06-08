<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Transformers\User\UserResource;
use App\Transformers\User\UserResourceCollection;
use App\Http\Requests\User\StoreUser;
use App\Http\Requests\User\UpdateUser;
use App\Http\Requests\User\UpdatePassword;
use App\Services\ResponseService;
use App\Http\Controllers\Notification;
use App\Repositories\User\UserRepository;

class UserController extends Controller
{
    private $user;

    public function __construct(UserRepository $user){
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserResourceCollection($this->user->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        try{        
            $data = $this->user->create($request->all());
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('users.store',null,$e);
        }

        return new UserResource($data,array('type' => 'store','route' => 'users.store'));
    }

     /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try{ 
            $data = $this->user->show();
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('users.show');
        }
        return new UserResource($data,array('type' => 'show','route' => 'users.show'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request)
    {
        try{
            $data = $this->user->update($request->all());
        }catch(\Throwable|\Exception $e){
            return ResponseService::exception('users.update');
        }
        return new UserResource($data,array('type' => 'update','route' => 'users.update'));  
    }
}
