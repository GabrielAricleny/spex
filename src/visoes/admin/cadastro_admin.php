<?php
require_once __DIR__ . '/../templates/cabecalho.php';

session_start();

// Verifica se o utilizador está autenticado como admin
if (!isset($_SESSION['id_admin'])) {
    header('Location: ?rota=login_admin');
    exit;
}

$erro = $_SESSION['erro_cadastro'] ?? '';
unset($_SESSION['erro_cadastro']);
?>

<section class="section">
    <div class="container">
        <h1 class="title">Cadastro de Administrador</h1>

        <?php if ($erro): ?>
            <div class="notification is-danger">
                <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <form action="?rota=registar_admin" method="POST">
            <div class="field">
                <label class="label">Nome Completo</label>
                <div class="control">
                    <input class="input" type="text" name="nome_admin" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="email" name="email_admin" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Senha</label>
                <div class="control">
                    <input class="input" type="password" name="senha_admin" required minlength="6">
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button class="button is-primary" type="submit">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/rodape.php';
?>

