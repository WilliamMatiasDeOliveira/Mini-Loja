<?php
$old = $_SESSION['old'] ?? null;
$error = $_SESSION['error'] ?? null;

unset($_SESSION['old'], $_SESSION['error']);
?>


<!-- LOGIN ADMINISTRATIVO -->

<div class="container" style="min-height: 100vh; display:flex; align-items:center; justify-content:center;">

    <div class="card" style="max-width:420px; width:100%;">

    <!-- email ou senha incorretos -->
        <?php if (isset($error['login_fail'])): ?>
            <div class="alert alert-danger text-center">
                <?= $error['login_fail'] ?>
            </div>
        <?php endif; ?>

        <div class="text-center mb-4">
            <h3 class="text-light">Bem-vindo !</h3>
            <p class="card-text">Informe seu e-mail e senha para continuar</p>
        </div>

        <form method="post" action="/auth/login">

            <div class="mb-3">
                <label class="form-label text-light">E-mail</label>
                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="admin@loja.com"
                    value="<?= $old['email'] ?? "" ?>">
                <?php if (isset($error['email'])): ?>
                    <div class="text-danger">
                        <?= $error['email'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-4">
                <label class="form-label text-light">Senha</label>
                <input
                    type="password"
                    name="senha"
                    class="form-control">
                <?php if (isset($error['senha'])): ?>
                    <div class="text-danger">
                        <?= $error['senha'] ?>
                    </div>
                <?php endif; ?>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Login
            </button>

        </form>

        <div class="text-center mt-4">
            <small class="text-secondary">Acesso restrito • Sistema seguro</small>
        </div>

    </div>

</div>