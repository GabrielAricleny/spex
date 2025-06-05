<?php $paginaAtual = 'administrador'; ?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>

<style>
.painel-centralizado {
    max-width: 800px;
    margin: 40px auto;
    background: #343a40;
    padding: 32px 24px;
    border-radius: 12px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.2);
}
.form-label {
    color: #f8f9fa;
}
.form-control {
    background: #23272b;
    color: #f8f9fa;
    border: 1px solid #444;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 12px;
    width: 100%;
}
.btn {
    margin-right: 4px;
}
</style>

<div class="painel-centralizado">
    <h2>Editar Administrador</h2>
    <form method="post">
        <label class="form-label">Usuário</label>
        <input type="text" class="form-control" value="<?= htmlspecialchars($admin->nome_usuario ?? '') ?>" readonly>

        <label class="form-label">Nome Completo</label>
        <input type="text" name="nome_completo" class="form-control" value="<?= htmlspecialchars($admin->nome_completo ?? '') ?>">

        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($admin->telefone ?? '') ?>">

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="?rota=crud_administrador" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include __DIR__ . '/../../templates/rodape.php'; ?>