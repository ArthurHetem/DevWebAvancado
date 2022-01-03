<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';

        if($request->get('erro') == 1)
        {
            $erro = 'Usuário ou senha inválidos';
        }else if($request->get('erro') == 2)
        {
            $erro = 'Você precisa estar logado para acessar esta página';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request){
        $regras = [
            'usuario' => 'required|email',
            'senha' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório.',
            'email' => 'O campo :attribute deve ser um e-mail válido.'
        ];

        $request->validate($regras, $feedback);

        $email =  $request->input('usuario');
        $password = $request->input('senha');

        $user = new User();

        $usuario = $user->where('email', $email)->where('password', $password)->get()->first();

        if(isset($usuario->name)){
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            return redirect()->route('app.home');
        }else{
            return redirect()->route('site.login', ['erro' => 1]);
        }
    }

    public function sair() {
        session_destroy();
        return redirect()->route('site.index');
    }
}
