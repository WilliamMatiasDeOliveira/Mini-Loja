<?php
declare(strict_types=1);

namespace App\Models;

use App\Functions\Connection;

class Product extends Connection{

    public function countProduct(){
        $sql = "SELECT * FROM produtos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        $count = $stmt->rowCount();
        return $count;
    }

    public function countLowStorege(){
        $sql = "SELECT * FROM estoque WHERE quantidade < 5 and quantidade > 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        return $count;
    }
}