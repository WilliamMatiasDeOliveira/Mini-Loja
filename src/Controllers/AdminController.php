<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Functions\Helpers;
use App\Models\Product;

class AdminController{

    public function dashboard(){
        $product = new Product();
        $countProducts = $product->countProduct();
        $lowStorege = $product->countLowStorege();

        $param = ["countProduct" => $countProducts, "lowStorege" => $lowStorege];

        $_SESSION['param'] = $param;
        
        Helpers::layout("admin/dashboard", "Dashboard");
    }
}