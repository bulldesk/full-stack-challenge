<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd(Hash::make($request->password));
       
        // dd($request->password);
        $result = $this->userValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return response()->json($user, 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $result = $this->userValidate($request);
        if ($result) {
            return response()->json($result, 400);
        } else {
            $user->update($request->all());
            return response()->json($user, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    private function userValidate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ], [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'Ja existe um usuario cadastrado com esse :attribute ',
            'max' => 'O nome da empresa deve conter um maximo de 255 caracteres',
            'min' => 'O nome da empresa deve conter um maximo de 8 caracteres',
        ], [
            'name'      => 'Nome do usuario',
            'email'      => 'E-mail do usuario',
            'password'      => 'Senha do usuario',
        ]);


        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return false;
        }
    }
}
