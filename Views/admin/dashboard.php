


<!-- DASHBOARD ADMINISTRATIVO -->
<div class="container mt-5">

<!-- TÍTULO -->
<div class="d-flex justify-between align-center mb-4">
    <div>
        <h3>Dashboard</h3>
        <p class="text-muted">Visão geral da loja</p>
    </div>
</div>

<!-- MÉTRICAS -->
<div class="row g-4 mb-5">

    <div class="col-md-3">
        <div class="card">
            <h6>Total de Produtos</h6>
            <h3 class="mt-2">120</h3>
            <p class="card-text">Produtos cadastrados</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <h6>Estoque Baixo</h6>
            <h3 class="mt-2 text-warning">8</h3>
            <p class="card-text">Precisam de reposição</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <h6>Pedidos Hoje</h6>
            <h3 class="mt-2">15</h3>
            <p class="card-text">Novos pedidos</p>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <h6>Faturamento</h6>
            <h3 class="mt-2 text-success">R$ 4.250</h3>
            <p class="card-text">Últimas 24h</p>
        </div>
    </div>

</div>

<!-- AÇÕES RÁPIDAS -->
<div class="row g-4 mb-5">

    <div class="col-md-4">
        <div class="card h-100">
            <h5>Produtos</h5>
            <p class="card-text">Gerencie os produtos da loja</p>
            <div class="d-flex gap-2 mt-3">
                <a href="/admin/products" class="btn btn-outline">Listar</a>
                <a href="/admin/products/create" class="btn btn-primary">Cadastrar</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <h5>Categorias</h5>
            <p class="card-text">Organize os produtos</p>
            <div class="d-flex gap-2 mt-3">
                <a href="/admin/categories" class="btn btn-outline">Gerenciar</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <h5>Pedidos</h5>
            <p class="card-text">Acompanhe as vendas</p>
            <div class="d-flex gap-2 mt-3">
                <a href="#" class="btn btn-outline">Ver pedidos</a>
            </div>
        </div>
    </div>

</div>

<!-- TABELA RESUMO -->
<div class="card">
    <h5 class="mb-3">Últimos Produtos Cadastrados</h5>

    <table class="table">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Estoque</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Notebook Gamer</td>
                <td>Informática</td>
                <td>R$ 6.499,00</td>
                <td>12</td>
            </tr>
            <tr>
                <td>Smartphone Pro</td>
                <td>Celulares</td>
                <td>R$ 2.199,00</td>
                <td>30</td>
            </tr>
            <tr>
                <td>Headset Gamer</td>
                <td>Acessórios</td>
                <td>R$ 399,00</td>
                <td>5</td>
            </tr>
        </tbody>
    </table>
</div>


</div>
