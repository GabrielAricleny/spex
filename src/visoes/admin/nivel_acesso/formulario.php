<?php $paginaAtual = 'nivel_acesso'; ?>
<?php require __DIR__ . '/../../templates/cabecalho.php'; ?>
<section class="section">
    <div class="container">
        <h1 class="title"><?= isset($nivel) ? 'Editar' : 'Novo' ?> Nível de Acesso</h1>

        <?php if (!empty($erro)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="field">
                <label class="label" for="descricao">Descrição</label>
                <div class="control">
                    <input class="input" type="text" name="descricao" id="descricao" 
                           value="<?= htmlspecialchars($nivel['descricao'] ?? '') ?>" required>
                </div>
            </div>
            <div class="field is-grouped mt-3">
                <div class="control">
                    <button class="button is-success" type="submit">Salvar</button>
                </div>
                <div class="control">
                    <a class="button is-light" href="?rota=crud_nivel_acesso">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</section>
<?php require __DIR__ . '/../../templates/rodape.php'; ?>
