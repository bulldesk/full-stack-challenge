<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthBasicController extends Controller
{

    public function login(Request $request)
    {   
        $credentials = $request->only('email', 'password');

        if (\Auth::attempt($credentials)) {           
            return ['status' => true, 'data'=>\Auth::user()];
        }else{
            return ['status' => false, 'messages'=>'Usuário não encontrado'];
        }
        
    }
}
