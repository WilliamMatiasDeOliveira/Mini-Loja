<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;

class ProductController{

    public function countProduct(){
        $product = new Product();
        $count = $product->countProduct();
        
    }
}