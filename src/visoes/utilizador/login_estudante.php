<?php
$paginaCss = 'main';
require_once __DIR__ . '/../templates/cabecalho.php';
?>

<section class="hero is-fullheight-with-navbar has-background-dark">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-5-tablet is-4-desktop">
                    <div class="box" style="box-shadow: 0 8px 32px 0 rgba(31,38,135,0.15); border-radius: 16px;">
                        <h1 class="title has-text-centered mb-5">Login do Estudante</h1>
                        
                        <?php if (!empty($_SESSION['erro_login'])): ?>
                            <div class="notification is-danger is-light">
                                <?= htmlspecialchars($_SESSION['erro_login']) ?>
                                <?php unset($_SESSION['erro_login']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($_SESSION['sucesso_login'])): ?>
                            <div class="notification is-success is-light">
                                <?= htmlspecialchars($_SESSION['sucesso_login']) ?>
                                <?php unset($_SESSION['sucesso_login']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($_SESSION['aviso_login'])): ?>
                            <div class="notification is-warning is-light">
                                <?= htmlspecialchars($_SESSION['aviso_login']) ?>
                                <?php unset($_SESSION['aviso_login']); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="?rota=autenticar_estudante" autocomplete="off">
                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="email" name="email" required autofocus>
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

                            <div class="field mt-5">
                                <button class="button is-primary is-fullwidth is-medium">Entrar</button>
                            </div>
                        </form>

                        <div class="has-text-centered mt-4">
                            <a href="?rota=cadastro_estudante" class="has-text-grey">Criar nova conta</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../templates/rodape.php'; ?>