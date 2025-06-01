<?php
require_once __DIR__ . '/../templates/cabecalho.php';

session_start();

if (!isset($_SESSION['id_estudante'])) {
    header('Location: ?rota=login');
    exit;
}
?>

<section class="section">
    <div class="container">
        <h1 class="title">Painel do Utilizador</h1>
        <p>Bem-vindo, <strong><?= htmlspecialchars($_SESSION['nome_estudante']) ?></strong>!</p>

        <nav class="menu mt-4">
            <ul class="menu-list">
                <li><a href="?rota=perfil">Perfil</a></li>
                <li><a href="?rota=sair">Sair</a></li>
            </ul>
        </nav>

        <div class="content mt-5">
            <h2 class="subtitle">Informações importantes</h2>
            <p>Aqui você pode acessar seu histórico de exames, resultados e outros recursos.</p>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/../templates/rodape.php';
?>

