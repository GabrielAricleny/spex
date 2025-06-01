<?php
require_once __DIR__ . '/../templates/cabecalho.php';
?>

<section class="section">
    <div class="container">
        <h1 class="title has-text-centered">Login de Utilizador</h1>

        <?php if (!empty($_SESSION['mensagem'])): ?>
            <div class="notification <?= $_SESSION['mensagem_tipo'] ?? 'is-danger' ?>">
                <?= htmlspecialchars($_SESSION['mensagem']) ?>
            </div>
        <?php 
            unset($_SESSION['mensagem'], $_SESSION['mensagem_tipo']);
        endif; 
        ?>

        <form action="?rota=autenticar" method="POST" id="formLogin">
            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="email" name="email_estudante" required autofocus>
                </div>
            </div>

            <div class="field">
                <label class="label">Senha</label>
                <div class="control">
                    <input class="input" type="password" name="senha_estudante" required minlength="6">
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button class="button is-primary is-fullwidth" type="submit">Entrar</button>
                </div>
            </div>
        </form>

        <p class="has-text-centered mt-4">
            Não tem conta? <a href="?rota=registro">Registre-se aqui</a>
        </p>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/rodape.php';
?>

