<?php

if (isset($_SESSION['categorias'])) {
    $categorias = $_SESSION['categorias'];
    unset($_SESSION['categorias']);
}
if (isset($_SESSION['old'])) {
    $old = $_SESSION['old'];
    unset($_SESSION['old']);
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
if(isset($_SESSION['fail_cad_product'])){
    $fail_cad_product = $_SESSION['fail_cad_product'];
    unset($_SESSION['fail_cad_product']);
}

?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">

            <div class="card shadow-sm">

            <?php if(isset($fail_cad_product)): ?>
                <div class="alert alert-danger text-center">
                    <?= $fail_cad_product ?>
                </div>
            <?php endif; ?>
           

                <div class="card-header border-0">
                    <h5 class="mb-0 text-light">Cadastrar novo produto</h5>
                    <small class="text-secondary">Produto com múltiplas imagens</small>
                </div>

                <div class="card-body">
                    <form action="/admin/products/store" method="POST" enctype="multipart/form-data">

                        <!-- Categoria -->
                        <div class="mb-3">
                            <label class="form-label text-light">Categoria</label>
                            <select name="categoria_id" class="form-select">
                                <option value="">Selecione</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['id'] ?>">
                                        <?= $categoria['nome'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($error['categoria_id'])): ?>
                                <div class="text-danger">
                                    <?= $error['categoria_id'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Nome / Código -->
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label text-light">Nome do produto</label>
                                <input type="text" name="nome" class="form-control" value="<?= $old['nome'] ?? '' ?>">
                                <?php if (isset($error['nome'])): ?>
                                    <div class="text-danger">
                                        <?= $error['nome'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light">Código</label>
                                <input type="text" name="codigo" class="form-control" value="<?= $old['codigo'] ?? '' ?>">
                                <?php if (isset($error['codigo'])): ?>
                                    <div class="text-danger">
                                        <?= $error['codigo'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="mb-3">
                            <label class="form-label text-light">Descrição</label>
                            <textarea name="descricao" rows="4" class="form-control"></textarea>
                        </div>

                        <!-- Preço / Estoque / Status -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light">Preço</label>
                                <input type="number" step="0.01" name="preco" class="form-control" value="<?= $old['preco'] ?? '' ?>">
                                <?php if (isset($error['preco'])): ?>
                                    <div class="text-danger">
                                        <?= $error['preco'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light">Quantidade</label>
                                <input type="number" name="quantidade" min="1" class="form-control" value="<?= $old['quantidade'] ?? '' ?>">
                                <?php if (isset($error['quantidade'])): ?>
                                    <div class="text-danger">
                                        <?= $error['quantidade'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light">Status</label>
                                <select name="status" class="form-select">
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>
                        </div>

                        <!-- Upload de imagens -->
                        <div class="mb-3">
                            <label class="form-label text-light">Imagens do produto</label>
                            <input
                                type="file"
                                name="imagens[]"
                                class="form-control"
                                multiple
                                accept="image/*"
                                id="imagensInput" />

                            <small class="text-secondary">
                                A primeira imagem será definida como principal
                            </small>
                        </div>

                        <!-- Preview -->
                        <div class="row g-3 mt-2" id="preview-container"></div>

                        <!-- Ações -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="/admin/products" class="btn btn-outline-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Salvar produto
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>