<?php
if(isset($_SESSION['old'])){
    $old = $_SESSION['old'];
    unset($_SESSION['old']);
}
if(isset($_SESSION['error'])){
    $error =  $_SESSION['error'];
    unset($_SESSION['error']);
}
if(isset($_SESSION['create_success'])){
    $create_success = $_SESSION['create_success'];
    unset($_SESSION['create_success']);
}
?>


<div class="d-flex justify-content-center">
    <div class="card-admin col-10 mt-3">

    <?php if(isset($error['create_fail'])): ?>
        <div class="alert alert-danger text-center">
            <?= $error['create_fail'] ?>
        </div>
    <?php endif; ?>
    <?php if(isset($create_success)): ?>
        <div class="alert alert-success text-center">
            <?= $create_success ?>
        </div>
    <?php endif; ?>


        <form action="/admin/category/store" method="POST">
            <div class="form-group">
                <label for="nome">Nome da Categoria</label>
                <input
                    type="text"
                    name="nome"
                    id="nome"
                    class="form-control"
                    placeholder="Ex: Smartphones, Notebooks"
                    value="<?= $old['nome'] ?? '' ?>">
                    <?php if(isset($error['nome'])): ?>
                        <div class="text-danger">
                            <?= $error['nome'] ?>
                        </div>
                    <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea
                    name="descricao"
                    id="descricao"
                    class="form-control"
                    rows="4"
                    placeholder="Descrição opcional da categoria"></textarea>
            </div>

            <div class="form-actions mt-4">
                <a href="/admin/category/menage" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Salvar Categoria</button>
            </div>
        </form>
    </div>
</div>