<?php
$paginaCss = ['inicio'];
$paginaJs  = [];

require_once __DIR__ . '/../templates/cabecalho.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$erroLogin = $_SESSION['erro_login'] ?? '';
unset($_SESSION['erro_login']);
?>

<section class="section is-fullheight-with-navbar has-background-dark">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-5">
                <div class="box">
                    <h1 class="title has-text-centered">Área do Administrador</h1>
                    <p class="subtitle has-text-centered">Acesso restrito</p>

                    <?php if ($erroLogin): ?>
                        <div class="notification is-danger">
                            <?= htmlspecialchars($erroLogin) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="?rota=autenticar_admin">
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" type="email" name="email" placeholder="admin@exemplo.com" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Senha</label>
                            <div class="control has-icons-left">
                                <input class="input" type="password" name="senha" placeholder="••••••••" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <button class="button is-fullwidth is-primary" type="submit">Entrar</button>
                        </div>
                    </form>

                    <p class="has-text-centered mt-4">
                        <a href="?rota=inicio" class="has-text-grey-dark">← Voltar ao início</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../templates/rodape.php'; ?>

