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
        header("Location: /admin/products/show");
        exit;
    }

    public function create()
    {
        $adminProduct = new AdminProduct();
        $categorias = $adminProduct->selectAllCategories();
        $_SESSION['categorias'] = $categorias;
        Helpers::layout("admin/createProduct", "Cadastrar Produto");
    }

    public function store()
    {
        $data = $_POST;
        $old = $_POST;
        $files = $_FILES['imagens'];
        $error = [];

        // tratamento de inputs obrigatorios vazio
        if (empty($data['categoria_id'])) {
            $error['categoria_id'] = "Escolha uma categoria.";
        }
        if (empty($data['nome'])) {
            $error['nome'] = "O campo nome é obrigatório.";
        }
        if (empty($data['codigo'])) {
            $error['codigo'] = "O campo código é obrigatório.";
        }
        if (empty($data['preco'])) {
            $error['preco'] = "O campo preço é obrigatório.";
        }
        if (empty($data['quantidade'])) {
            $error['quantidade'] = "O campo quantidade é obrigatório.";
        }

        if (!empty($error)) {
            $_SESSION['old'] = $old;
            $_SESSION['error'] = $error;
            header("Location: /admin/products/create");
            exit;
        }
        // ==================================================================

        $adminProduct = new AdminProduct();
        $res = $adminProduct->store($data, $files);

        if ($res !== true) {
            $_SESSION['old'] = $old;
            $_SESSION['fail_cad_product'] = $res;
            header("Location: /admin/products/create");
            exit;
        }

        $_SESSION['success_cad_product'] = "Produto cadastrado com sucesso !";
        header("Location: /admin/products/create");
        exit;
    }

    public function show()
    {
        Helpers::layout("admin/showProducts", "Estoque");
    }
}
