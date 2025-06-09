<?php
//if (session_status() === PHP_SESSION_NONE) {
//    session_start();
//}

$paginaCss = 'dashboard';
require_once __DIR__ . '/../templates/cabecalho.php';

// Supondo que o controlador já passou estes dados:
$estudante = $_SESSION['utilizador'] ?? null;
$totalExames = $totalExames ?? 0;
$ultimaNota = $ultimaNota ?? '-';
$progresso = $progresso ?? 0;
$historico = $historico ?? [];
?>

<section class="section">
    <div class="container">
        <div class="columns">
            <!-- Sidebar -->
            <div class="column is-3">
                <aside class="menu">
                    <p class="menu-label">Menu</p>
                    <ul class="menu-list">
                        <li><a href="?rota=dashboard_estudante"<?= (isset($_GET['rota']) && $_GET['rota'] === 'dashboard_estudante') ? ' class="is-active"' : '' ?>>Dashboard</a></li>
                        <li><a href="?rota=arena_exames"<?= (isset($_GET['rota']) && $_GET['rota'] === 'arena_exames') ? ' class="is-active"' : '' ?>>Arena de Exames</a></li>
                        <li><a href="?rota=meu_perfil"<?= (isset($_GET['rota']) && $_GET['rota'] === 'meu_perfil') ? ' class="is-active"' : '' ?>>Meu Perfil</a></li>
                        <li><a href="?rota=meus_resultados"<?= (isset($_GET['rota']) && $_GET['rota'] === 'meus_resultados') ? ' class="is-active"' : '' ?>>Meus Resultados</a></li>
                        <li><a href="?rota=inicio">Início</a></li>
                        <li><a href="?rota=sair_estudante">Sair</a></li>
                    </ul>
                </aside>
            </div>

            <!-- Conteúdo Principal -->
            <div class="column">
                <h1 class="title">
                    Bem-vindo, <?= htmlspecialchars($estudante['nome_completo'] ?? $estudante['nome_usuario'] ?? 'Estudante') ?>!
                </h1>

                <!-- Blocos de informação -->
                <div class="tile is-ancestor mt-5">
                    <div class="tile is-parent">
                        <article class="tile is-child box bloco-exames">
                            <p class="title">Exames Disponíveis</p>
                            <p class="subtitle"><?= $totalExames ?></p>
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child box bloco-nota">
                            <p class="title">Última Nota</p>
                            <p class="subtitle"><?= $ultimaNota !== null ? $ultimaNota : '-' ?></p>
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child box bloco-progresso">
                            <p class="title">Progresso</p>
                            <p class="subtitle"><?= $progresso ?>%</p>
                        </article>
                    </div>
                </div>

                <!-- Tabela de últimos exames -->
                <div class="card mt-5">
                    <header class="card-header">
                        <p class="card-header-title">Últimos Exames Realizados</p>
                    </header>
                    <div class="card-content">
                        <div class="content">
                            <table class="table is-fullwidth">
                                <thead>
                                    <tr>
                                        <th>Exame</th>
                                        <th>Data</th>
                                        <th>Nota</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($historico)): ?>
                                        <?php foreach ($historico as $exame): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($exame['nome_exame'] ?? 'Exame') ?></td>
                                                <td><?= date('d/m/Y', strtotime($exame['data_realizacao'])) ?></td>
                                                <td><?= $exame['nota_obtida'] ?></td>
                                                <td>
                                                    <a href="?rota=detalhes_exame&id=<?= $exame['id_exame_realizado'] ?>" class="button is-small is-info">Ver Detalhes</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="has-text-centered">Nenhum exame realizado ainda.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../templates/rodape.php'; ?>
