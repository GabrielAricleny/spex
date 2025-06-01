<?php require_once __DIR__ . '/cabecalho.php'; ?>

<main class="section">
  <div class="container has-text-centered">
    <h1 class="title is-1 has-text-danger">404 - Página Não Encontrada</h1><br>
    <p class="subtitle is-4">A página que você está tentando acessar não existe.</p>
    
    <?php session_destroy(); ?>
    
    <a href="?rota=inicio" class="button is-dark mt-4">Voltar para a página inicial</a>
  </div>
</main>

<?php require_once __DIR__ . '/rodape.php'; ?>

