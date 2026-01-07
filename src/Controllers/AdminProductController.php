<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Functions\Helpers;
use App\Models\AdminProduct;

class AdminProductController
{

    public function index()
    {
        $Adminproduct = new AdminProduct();
        $products = $Adminproduct->index();
        $_SESSION['products'] = $products;
        header("Location: /admin/products/show-products");
        exit;
    }

    public function create(){
        Helpers::layout("admin/createProduct", "Cadastrar Produto");
    }

    public function showProducts()
    {
        Helpers::layout("admin/showProducts", "Estoque");
    }
}
