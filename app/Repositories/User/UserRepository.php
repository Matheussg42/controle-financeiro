<?php

namespace App\Repositories\User;

use App\User;
use DB;

class UserRepository
{

    /**
     * Get All Budgets
     * 
     * @return budgets
     */
    public function all(){
        return User::all();
    }

    /**
     * Create User
     *
     * @param  fields
     * @return user
     */
    public function create($fields)
    {
        return User::create($fields);
    }

    /**
     * Show User logged
     *
     * @return user
     */
    public function show()
    {
        $user = auth()
        ->user();
        if (!$user) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $user;
    }

    /**
     * Update User logged
     *
     * @param fields
     * @return user
     */
    public function update($fields)
    {
        $user = $this->show();
        $user->update($fields);
        return $user;
    }

    /**
     * Update Password User logged
     *
     * @param fields
     * @return user
     */
    public function updatePassword($password)
    {
        $user = $this->show();
        $fields = ['password' => \Hash::make($password)];
        $user->update($fields);
        return $user;
    }

    /**
     * Find User By Id
     *
     * @param  id
     * @return user
     */
    public function find($id)
    {
        $user = User::find($id);
        if (!$user) {
            throw new \Exception('Nada Encontrado', -404);
        }

        return $user;
    }

    /**
     * Destroy User
     *
     * @param  id
     * @return user
     */
    public function destroy($id)
    {
        $user = $this->find($id);
        $user->delete();
        return $user;
    }

    public function findBy($column, $value)
    {
        $user = User::where($column, $value)->first();
        return $user;
    }

    public function getUserName($id){
        $name = DB::table('users')->where('id', $id)->pluck('name')->first();
        if (!$name) {
            $name = $id;
        }
        return $name;
    }

    public function userLoginData($email){
        $result = DB::table('users')->where('email', $email)->first();
        return [
            'id' => $result->id,
            'name' => $result->name,
            'email' => $result->email
        ];
    }
}
