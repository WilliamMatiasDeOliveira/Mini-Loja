<?php

declare(strict_types=1);

namespace App\Models;

use App\Functions\Connection;

class AdminCategory extends Connection
{

    public function store(array $data) 
    {
        $sql = "INSERT INTO categorias (nome, descricao, slug)
                values (:nome, :descricao, :slug)";
        $stmt = $this->pdo->prepare($sql);

        
        $stmt->execute([
            ":nome" => $data['nome'],
            ":descricao" => $data['descricao'],
            ":slug" => $data['slug']
        ]);

        return true;
    }
}
