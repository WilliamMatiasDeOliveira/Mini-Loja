<?php
declare(strict_types=1);

namespace App\Models;

use App\Functions\Connection;
use PDO;

class AdminProduct extends Connection{

    public function index(){
        $sql = "SELECT
            p.id,
            p.nome AS produto,
            p.descricao,
            p.preco,
            p.codigo,
            p.status,
            c.nome AS categoria,
            e.quantidade AS estoque
        FROM produtos p
        INNER JOIN categorias c ON c.id = p.categoria_id
        LEFT JOIN estoque e ON e.produto_id = p.id
        ORDER BY c.nome DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

     public function countProduct()
    {
        $sql = "SELECT * FROM produtos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $count = $stmt->rowCount();
        return $count;
    }

    public function countLowStorege()
    {
        $sql = "SELECT * FROM estoque WHERE quantidade < 5 and quantidade > 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }
}