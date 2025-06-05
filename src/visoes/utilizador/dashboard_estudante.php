<?php
$paginaCss = 'dashboard';
require_once __DIR__ . '/../templates/cabecalho.php';

$estudante = $_SESSION['estudante'] ?? null;
if (!$estudante) {
    header('Location: ?rota=login_estudante');
    exit;
}
?>

<section class="section">
    <div class="container">
        <div class="columns">
            <!-- Sidebar -->
            <div class="column is-3">
                <aside class="menu">
                    <p class="menu-label">Menu</p>
                    <ul class="menu-list">
                        <li><a href="?rota=dashboard_estudante" class="is-active">Dashboard</a></li>
                        <li><a href="?rota=arena_exames">Arena de Exames</a></li>
                        <li><a href="?rota=meu_perfil">Meu Perfil</a></li>
                        <li><a href="?rota=meus_resultados">Meus Resultados</a></li>
                    </ul>
                </aside>
            </div>

            <!-- Conteúdo Principal -->
            <div class="column">
                <h1 class="title">
                    Bem-vindo, <?= htmlspecialchars($estudante['nome_completo'] ?? $estudante['nome_usuario'] ?? 'Estudante') ?>!
                </h1>
                
                <div class="tile is-ancestor mt-5">
                    <div class="tile is-parent">
                        <article class="tile is-child box has-background-primary-light">
                            <p class="title">Exames Disponíveis</p>
                            <p class="subtitle">5</p>
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child box has-background-info-light">
                            <p class="title">Última Nota</p>
                            <p class="subtitle">16.5</p>
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child box has-background-success-light">
                            <p class="title">Progresso</p>
                            <p class="subtitle">75%</p>
                        </article>
                    </div>
                </div>

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
                                    <tr>
                                        <td>Matemática 2023</td>
                                        <td>10/05/2023</td>
                                        <td>18</td>
                                        <td><a href="#" class="button is-small is-info">Ver Detalhes</a></td>
                                    </tr>
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