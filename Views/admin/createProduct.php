<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-10">

            <div class="card shadow-sm">
                <div class="card-header border-0">
                    <h5 class="mb-0">Cadastrar novo produto</h5>
                    <small class="text-muted">Produto com múltiplas imagens</small>
                </div>

                <div class="card-body">
                    <form action="/admin/products/store" method="POST" enctype="multipart/form-data">

                        <!-- Categoria -->
                        <div class="mb-3">
                            <label class="form-label">Categoria</label>
                            <select name="categoria_id" class="form-select" required>
                                <option value="">Selecione</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?= $categoria['id'] ?>">
                                        <?= htmlspecialchars($categoria['nome']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Nome / Código -->
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label">Nome do produto</label>
                                <input type="text" name="nome" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Código</label>
                                <input type="text" name="codigo" class="form-control" required>
                            </div>
                        </div>

                        <!-- Descrição -->
                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea name="descricao" rows="4" class="form-control"></textarea>
                        </div>

                        <!-- Preço / Estoque / Status -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Preço</label>
                                <input type="number" step="0.01" name="preco" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Quantidade em estoque</label>
                                <input type="number" name="quantidade" min="0" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>
                        </div>

                        <!-- Upload de imagens -->
                        <div class="mb-3">
                            <label class="form-label">Imagens do produto</label>
                            <input
                                type="file"
                                name="imagens[]"
                                class="form-control"
                                multiple
                                accept="image/*"
                                id="imagensInput" />

                            <small class="text-muted">
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