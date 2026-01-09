<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Functions\Helpers;
use App\Models\AdminCategory;

class AdminCategoryControllers
{

    public function menage()
    {
        Helpers::layout("admin/menageCategory", "Gerenciar Categoria");
    }

    public function create()
    {
        Helpers::layout("admin/createCategory", "Criar Categotia");
    }

    public function store()
    {
        $data = $_POST;
        $old = $_POST;
        $error = [];

        if (empty($data['nome'])) {
            $error['nome'] = "O nome da categoria é obrigatório";
        }

        if (!empty($error)) {
            $_SESSION['old'] = $old;
            $_SESSION['error'] = $error;
            header("Location: /admin/category/create");
            exit;
        }

        // tratamento do slug
        $slug = strtolower(trim(str_replace(" ", "-", $data['nome'])));
        $data['slug'] = $slug;

        // tratamento do nome
        $nome = strtolower(htmlspecialchars(trim($data['nome'])));
        $data['nome'] = $nome;

        $adminCategory = new AdminCategory();
        $res = $adminCategory->store($data);

        if (!$res) {
            $error['create_fail'] = "Erro ao cadastrar Categoria";
            $_SESSION['old'] = $old;
            $_SESSION['error'] = $error;
            header("Location: /admin/category/create");
            exit;
        }

        $_SESSION['create_success'] = "Categoria cadastrada com sucesso !";
        header("Location: /admin/category/create");
        exit;
    }

    public function update() {}

    public function delete() {}
}
