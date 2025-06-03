<?php include __DIR__ . '/../_includes/header.php'; ?>

<h2>Eliminar Nível de Acesso</h2>
<p>Tem certeza que deseja eliminar o nível <strong><?= htmlspecialchars($nivel['nome_nivel']) ?></strong>?</p>

<form method="post">
    <button type="submit" class="btn btn-danger">Sim, eliminar</button>
    <a href="?rota=admin_nivel_acesso" class="btn btn-secondary">Cancelar</a>
</form>

<?php include __DIR__ . '/../_includes/footer.php'; ?>