<?php
if(isset($_SESSION['old'])){
    $old = $_SESSION['old'];
    unset($_SESSION['old']);
}
if(isset($_SESSION['error'])){
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
if(isset($_SESSION['product_not_exist'])){
    $product_not_exist = $_SESSION['product_not_exist'];
    unset($_SESSION['product_not_exist']);
}
if(isset($_SESSION['success_stock'])){
   $success_stock = $_SESSION['success_stock'];
   unset($_SESSION['success_stock']);
}
?>




<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-lg p-4 text-light">
                <h4 class="mb-4">Atualizar Estoque</h4>

                <?php if(isset($product_not_exist)): ?>
                    <div class="alert alert-danger text-center">
                        <?= $product_not_exist ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($success_stock)): ?>
                    <div class="alert alert-success text-center">
                        <?= $success_stock ?>
                    </div>
                    <?php unset($_SESSION['success_stock']); ?>
                <?php endif; ?>

                <form action="/admin/products/add" method="post">

                    <div class="mb-3">
                        <label class="form-label">Código do Produto</label>
                        <input
                            type="text"
                            name="codigo"
                            class="form-control"
                            placeholder="Ex: PROD-001"
                            value="<?= $_SESSION['old']['codigo'] ?? '' ?>">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Quantidade a adicionar</label>
                        <input
                            type="number"
                            name="quantidade"
                            min="1"
                            class="form-control"
                            placeholder="Ex: 10"
                            value="<?= $_SESSION['old']['quantidade'] ?? '' ?>">
                    </div>

                    <?php unset($_SESSION['old']); ?>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="/admin/dashboard" class="btn btn-outline-light">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Atualizar Estoque
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
