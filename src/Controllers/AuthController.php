<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Functions\Helpers;
use App\Models\Auth;

class AuthController
{

    public function loginForm()
    {
        Helpers::layout("auth/login", "Login");
    }

    public function login()
    {
        $data = $_POST;
        $old = $_POST;
        $error = [];

        if (empty($data['email'])) {
            $error['email'] = "O campo E-mail é obrigatório.";
        }
        if (empty($data['senha'])) {
            $error['senha'] = "O campo senha é obrigatório.";
        }

        if (!empty($error)) {
            $_SESSION['old'] = $old;
            $_SESSION['error'] = $error;
            header("Location: /admin");
            exit;
        }

        $auth = new Auth();
        $res = $auth->login($data);

        // verifica se existe este usuario 
        if (!$res) {
            $_SESSION['old'] = $old;
            $_SESSION['error'] = ["login_fail" => "E-mail ou Senha incorretos !"];
            header("Location: /admin");
            exit;
        }

        // verifica o tipo de usuario
        if ($res['tipo'] === 'admin') {
            $_SESSION['user'] = $res;
            header("Location: /admin/dashboard");
            exit;
        } else {
            $_SESSION['user'] = $res;
            header("Location: /");
            exit;
        }
    }

    public function logout(){
        unset($_SESSION['user']);
        header("Location: /");
        exit;
    }
}
