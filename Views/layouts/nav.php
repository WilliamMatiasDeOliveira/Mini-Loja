<nav class="navbar navbar-expand-lg navbar-dark shadow-sm"
    style="background-color: var(--bg-card);">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand fw-bold" href="/">
            <span style="color: var(--primary);">Neo</span>Tech
        </a>

        <!-- TOGGLE MOBILE -->
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-3">

                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/products">Produtos</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/categories">Categorias</a>
                </li>

                <!-- CARRINHO -->
                <li class="nav-item">
                    <a class="nav-link position-relative" href="/cart">
                        Carrinho
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                            0
                        </span>
                    </a>
                </li>

                <!-- CTA -->
                <?php if (!isset($_SESSION['user'])): ?>
                    <li class="nav-item ms-lg-3">
                        <a href="/auth/login" class="btn btn-outline-light btn-sm">
                            Entrar
                        </a>
                    </li>
                <?php else: ?>
                    <div class="nav-item ms-auto justify-content-end d-flex flex-wrap col">
                        <div class="row col-10 text-end">
                            <span class="text-info">
                                <?= $_SESSION['user']['email'] ?>
                            </span>
                        </div>
                        <div class="d-flex me-2">
                                <a href="/admin/dashboard" class="btn btn-outline-light btn-sm">
                                    Dashboard
                                </a>
                                <a href="/auth/logout" class="btn btn-outline-danger btn-sm">
                                    Logout
                                </a>
                        </div>
                    </div>
                <?php endif; ?>

            </ul>
        </div>

    </div>
</nav>