<?php
declare(strict_types=1);

namespace App\Models;

use App\Functions\Connection;
use PDO;

class Auth extends Connection{

    public function __construct()
    {
        parent::__construct();
    }

    public function login(array $data)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $data['email']);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($data['senha'], $user['senha'])){
            return $user;
        }

        return null;
        


    }
}