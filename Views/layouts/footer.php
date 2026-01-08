<footer class="mt-5" style="background-color: var(--bg-card);">
    <div class="container py-5">

        <div class="row g-4">

            <!-- SOBRE -->
            <div class="col-md-4">
                <h5 class="fw-bold">
                    <span style="color: var(--primary);">Neo</span>Tech
                </h5>
                <p class="text-muted small">
                    Sua loja de eletrônicos com tecnologia de ponta,
                    segurança e os melhores preços do mercado.
                </p>
            </div>

            <!-- LINKS -->
            <div class="col-md-2">
                <h6 class="fw-bold">Loja</h6>
                <ul class="list-unstyled small">
                    <li><a href="/products" class="text-muted text-decoration-none">Produtos</a></li>
                    <li><a href="/categories" class="text-muted text-decoration-none">Categorias</a></li>
                    <li><a href="/offers" class="text-muted text-decoration-none">Ofertas</a></li>
                </ul>
            </div>

            <!-- SUPORTE -->
            <div class="col-md-3">
                <h6 class="fw-bold">Suporte</h6>
                <ul class="list-unstyled small">
                    <li class="text-muted">contato@neotech.com</li>
                    <li class="text-muted">WhatsApp: (11) 99999-9999</li>
                </ul>
            </div>

            <!-- PAGAMENTOS -->
            <div class="col-md-3">
                <h6 class="fw-bold">Pagamento</h6>
                <p class="text-muted small">
                    Pix • Cartão • Boleto<br>
                    Ambiente 100% seguro
                </p>
            </div>

        </div>

        <hr style="border-color: #333;">

        <div class="text-center text-muted small">
            © <?= date('Y') ?> NeoTech • Todos os direitos reservados
        </div>

    </div>
</footer>

<!-- link bootstrap js -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

 <!-- link js adminlte -->
  <script src="/adminlte/js/adminlte.js"></script>


 <!-- link js aplication -->
  <script src="/public/assets/js/functions.js"></script>

</body>

</html>