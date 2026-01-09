<?php
if (isset($_SESSION['products'])) {
    $products = $_SESSION['products'];
}
?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Controle de Estoque</h4>

        <a href="/admin/products/create" class="btn btn-primary">
            Novo Produto
        </a>
    </div>

    <div class="card shadow-lg">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-dark table-hover align-middle mb-0">
                    <thead class="text-secondary">
                        <tr>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Código</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (isset($products) && empty($products)): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    Nenhum produto encontrado
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <?php
                                $estoque = (int) ($product['estoque'] ?? 0);
                                $estoqueClass = $estoque <= 5 ? 'text-danger fw-bold' : 'text-success';
                                ?>
                                <tr>
                                    <td>
                                        <div class="fw-semibold"><?= htmlspecialchars($product['produto']) ?></div>
                                    </td>

                                    <td><?= htmlspecialchars($product['categoria']) ?></td>

                                    <td><?= htmlspecialchars($product['codigo']) ?></td>

                                    <td>R$ <?= number_format($product['preco'], 2, ',', '.') ?></td>

                                    <td class="<?= $estoqueClass ?>">
                                        <?= $estoque ?>
                                    </td>

                                    <td>
                                        <?php if ($product['status'] === 'ativo'): ?>
                                            <span class="badge bg-success">Ativo</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Inativo</span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="text-end">
                                        <a href="/admin/products/edit?id=<?= $product['id'] ?>"
                                            class="btn btn-sm btn-outline-warning">
                                            Editar
                                        </a>

                                        <button
                                            class="btn btn-sm btn-outline-danger"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-id="<?= $p['id'] ?>">
                                            Excluir
                                        </button>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light border-0 rounded-4">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Confirmar exclusão</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <p class="mb-0">
                    Tem certeza que deseja excluir este produto?<br>
                    <small class="text-muted">Essa ação não poderá ser desfeita.</small>
                </p>
            </div>

            <div class="modal-footer border-0 justify-content-center gap-2">
                <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">
                    Cancelar
                </button>

                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">
                    Excluir
                </a>
            </div>

        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {

        const deleteModal = document.getElementById('deleteModal');
        const confirmBtn = document.getElementById('confirmDeleteBtn');

        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const productId = button.getAttribute('data-id');

            confirmBtn.href = '/admin/products/delete?id=' + productId;
        });

    });
</script>