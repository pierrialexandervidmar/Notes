<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        $request->validate([
            'text_username' => 'required|email',
            'text_password' => 'required'
        ]);

        $username = $request->input('text_username');
        $password = $request->input('text_password');

        $user = User::where('username', $username)
            ->where('deleted_at', NULL)
            ->first();


        // VERIFICA SE O USUÁRIO EXISTE
        if (!$user)
        {
            return redirect()->back()->withInput()->with('loginError', 'Username ou password inválidos');
        }

        // VERIFICA SE A SENHA É CORRETA
        if (password_verify($password, $user->password))
        {
            $user->last_login = date('Y-m-d H:i:s');
            $user->save();
        }
        else
        {
            return redirect()->back()->withInput()->with('loginError', 'Senha Inválida');
        }

        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);

        return redirect('/');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
