<?php
if (isset($_SESSION['param'])) {
    $param = $_SESSION['param'];
    unset($_SESSION['param']);
}
?>

<!-- DASHBOARD ADMINISTRATIVO -->
<div class="container mt-5">

    <!-- TÍTULO -->
    <div class="d-flex justify-between align-center mb-4">
        <div>
            <h3>Dashboard</h3>
            <p class="text-secondary">Visão geral da loja</p>
        </div>
    </div>

    <!-- MÉTRICAS -->
    <div class="row g-4 mb-5">

        <div class="col-md-3">
            <div class="card">
                <h6 class="text-info">Total de Produtos</h6>
                <h3 class="mt-2 text-warning"><?= $param['countProduct'] ?? "" ?></h3>
                <p class="card-text">Produtos cadastrados</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <h6 class="text-info">Estoque Baixo</h6>
                <h3 class="mt-2 text-warning"><?= $param['lowStorege'] ?? "" ?></h3>
                <p class="card-text">Precisam de reposição</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <h6 class="text-info">Pedidos Hoje</h6>
                <h3 class="mt-2 text-warning">ajustar</h3>
                <p class="card-text">Novos pedidos</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <h6 class="text-info">Faturamento</h6>
                <h3 class="mt-2 text-success">R$ ajustar</h3>
                <p class="card-text">Últimas 24h</p>
            </div>
        </div>

    </div>

    <!-- AÇÕES RÁPIDAS -->
    <div class="row g-4 mb-5">

        <div class="col-md-4">
            <div class="card h-100">
                <h5 class="text-light">Produtos</h5>
                <p class="card-text">Gerencie os produtos da loja.</p>
                <div class="d-flex gap-2 mt-3">
                    <a href="/admin/products/index" class="btn btn-outline">Listar</a>
                    <a href="/admin/products/create" class="btn btn-primary">Cadastrar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <h5 class="text-light">Categorias</h5>
                <p class="card-text">Adicione, Remova ou Edite novas categorias.</p>
                <div class="d-flex gap-2 mt-3">
                    <a href="/admin/category/menage" class="btn btn-outline">Gerenciar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100">
                <h5 class="text-light">Adicionar ao estoque</h5>
                <p class="card-text">Gerencie a quantidade de produtos em estoque.</p>
                <div class="d-flex gap-2 mt-3">
                    <a href="/admin/products/add" class="btn btn-outline">Adicionar</a>
                </div>
            </div>
        </div>

    </div>

</div>