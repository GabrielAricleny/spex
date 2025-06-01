<?php
$paginaCss = ['inicio'];
$paginaJs  = [];

require_once __DIR__ . '/../templates/cabecalho.php';
?>

<div class="columns is-gapless">
    <!-- Menu lateral -->
    <aside class="column is-2 has-background-dark p-4">
        <h2 class="title is-5 has-text-white">Administração</h2>
        <ul>
            <?php foreach ($resumos as $tabela => $dados): ?>
                <li class="mb-2">
                    <a href="?rota=crud_<?= $tabela ?>" class="has-text-white">
                        <i class="fas fa-angle-right"></i> <?= $dados['titulo'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
            <li class="mt-4">
                <a href="?rota=sair_admin" class="has-text-danger">
                    <i class="fas fa-sign-out-alt"></i> Terminar Sessão
                </a>
            </li>
        </ul>
    </aside>

    <!-- Conteúdo principal -->
    <main class="column p-5">
        <h1 class="title">Painel de Administração</h1>
        <div class="columns is-multiline">
            <?php foreach ($resumos as $tabela => $dados): ?>
                <div class="column is-one-quarter">
                    <div class="card">
                        <div class="card-content has-text-centered">
                            <p class="title is-4"><?= $dados['total'] ?></p>
                            <p class="subtitle is-6"><?= $dados['titulo'] ?></p>
                        </div>
                        <footer class="card-footer">
                            <a href="?rota=crud_<?= $tabela ?>" class="card-footer-item">Gerir</a>
                        </footer>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../templates/rodape.php'; ?>
