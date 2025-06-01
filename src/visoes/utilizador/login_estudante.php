<?php
$paginaCss = 'login';
require_once __DIR__ . '/../templates/cabecalho.php';
?>

<section class="section is-fullheight-with-navbar has-background-dark">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-5-tablet is-4-desktop">
                <div class="box">
                    <h1 class="title has-text-centered">Login do Estudante</h1>
                    
                    <?php if (!empty($_SESSION['erro_login'])): ?>
                        <div class="notification is-danger">
                            <?= htmlspecialchars($_SESSION['erro_login']) ?>
                            <?php unset($_SESSION['erro_login']) ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="?rota=autenticar_estudante">
                        <div class="field">
                            <label class="label">Email</label>
                            <div class="control has-icons-left">
                                <input class="input" type="email" name="email_estudante" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-envelope"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Senha</label>
                            <div class="control has-icons-left">
                                <input class="input" type="password" name="senha_estudante" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                            </div>
                        </div>

                        <div class="field">
                            <button class="button is-primary is-fullwidth">Entrar</button>
                        </div>
                    </form>

                    <div class="has-text-centered mt-4">
                        <a href="?rota=cadastro_estudante" class="has-text-grey">Criar nova conta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../templates/rodape.php'; ?>