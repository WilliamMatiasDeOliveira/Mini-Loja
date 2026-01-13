<?php
if (isset($_SESSION['produto'])) {
    $produto = $_SESSION['produto'];
    unset($_SESSION['produto']);
}
if (isset($_SESSION['categorias'])) {
    $categorias = $_SESSION['categorias'];
    unset($_SESSION['categorias']);
}
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}

/*

Array
(
    [id] => 15
    [categoria_id] => 3
    [nome] => atualizado
    [descricao] => teste de descrição
    [preco] => 14.50
    [codigo] => 8
    [STATUS] => ativo
    [created_at] => 2026-01-13 09:32:14
    [estoque] => Array
        (
            [produto_id] => 15
            [quantidade] => 4
            [updated_at] => 2026-01-13 09:32:14
        )

    [imgs] => Array
        (
            [0] => Array
                (
                    [id] => 12
                    [produto_id] => 15
                    [imagem] => prod_69663b4e5a2867.76305929.jpg
                    [principal] => 1
                )

            [1] => Array
                (
                    [id] => 13
                    [produto_id] => 15
                    [imagem] => prod_69663b4e5b0828.41077180.jpg
                    [principal] => 0
                )

        )

    [categoria] => Array
        (
            [id] => 3
            [nome] => eletro domestico
            [descricao] => descrição do eletro domestico
            [slug] => eletro-domestico
            [created_at] => 2026-01-09 15:15:10
        )

)


*/
?>


<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">

            <div class="card shadow-sm">
                <div class="card-header border-0">
                    <h5 class="mb-0 text-light">Atualizar produto</h5>
                </div>

                <div class="card-body">
                    <form action="/admin/products/update"
                        method="POST"
                        enctype="multipart/form-data">

                        <!-- ID -->
                        <input type="hidden" name="id" value="<?= $produto['id'] ?>">

                        <!-- Categoria -->
                        <div class="mb-3">
                            <label class="form-label text-light">Categoria</label>
                            <select name="categoria" class="form-select">
                                <?php foreach ($categorias as $categoria): ?>
                                    <option
                                        value="<?= $categoria['id'] ?>"
                                        <?= $categoria['id'] == $produto['categoria']['id'] ? 'selected' : '' ?>>
                                        <?= ucwords($categoria['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Nome / Código -->
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label text-light">Nome do produto</label>
                                <input type="text"
                                    name="nome"
                                    class="form-control"
                                    value="<?= htmlspecialchars($produto['nome']) ?>">
                                <?php if (isset($error['nome'])): ?>
                                    <div class="text-danger">
                                        <?= $error['nome'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light">Código</label>
                                <input type="text"
                                    name="codigo"
                                    class="form-control"
                                    value="<?= htmlspecialchars($produto['codigo']) ?>">
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
                            <textarea name="descricao"
                                rows="4"
                                class="form-control"><?= htmlspecialchars($produto['descricao']) ?></textarea>
                        </div>

                        <!-- Preço / Quantidade / Status -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light">Preço</label>
                                <input type="number"
                                    step="0.01"
                                    name="preco"
                                    class="form-control"
                                    value="<?= $produto['preco'] ?>">
                                <?php if (isset($error['preco'])): ?>
                                    <div class="text-danger">
                                        <?= $error['preco'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light">Quantidade</label>
                                <input type="number"
                                    name="quantidade"
                                    min="0"
                                    class="form-control"
                                    value="<?= $produto['estoque']['quantidade'] ?>">
                                <?php if (isset($error['quantidade'])): ?>
                                    <div class="text-danger">
                                        <?= $error['quantidade'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label text-light">Status</label>
                                <select name="status" class="form-select">
                                    <option value="ativo"
                                        <?= $produto['STATUS'] === 'ativo' ? 'selected' : '' ?>>
                                        Ativo
                                    </option>
                                    <option value="inativo"
                                        <?= $produto['STATUS'] === 'inativo' ? 'selected' : '' ?>>
                                        Inativo
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Imagens atuais -->
                        <?php if (!empty($produto['imgs'])): ?>
                            <div class="mb-3">
                                <label class="form-label text-light">Imagens atuais</label>
                                <div class="row g-3">
                                    <?php foreach ($produto['imgs'] as $img): ?>
                                        <div class="col-md-3 text-center">
                                            <img src="/public/assets/images/uploads/<?= $img['imagem'] ?>"
                                                class="img-fluid rounded mb-2">

                                            <?php if ($img['principal'] == 1): ?>
                                                <span class="badge bg-primary">Principal</span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Preview -->
                        <div class="row g-3 mt-2" id="preview-container"></div>

                        <!-- Upload de novas imagens -->
                        <div class="mb-3">
                            <label class="form-label text-light">Adicionar novas imagens</label>
                            <input type="file"
                                name="imagens[]"
                                class="form-control"
                                multiple
                                accept="image/*"
                                id="imagensInput">

                            <small class="text-secondary">
                                Se nenhuma imagem for enviada, as imagens atuais serão mantidas
                            </small>
                        </div>

                        <!-- Ações -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="/admin/products" class="btn btn-outline-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn btn-warning">
                                Atualizar produto
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>