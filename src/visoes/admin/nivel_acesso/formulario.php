<?php $paginaAtual = 'nivel_acesso'; ?>
<?php require __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<style>
body, html {
    background: #23272f !important;
}
.section {
    background: transparent !important;
}
.painel-centralizado {
    background: #23272b;
    border-radius: 8px;
    padding: 32px 0;
    margin: 32px 0;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
    width: 100%;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.label, .title {
    color: #f8f9fa !important;
}
.input {
    background: #23272b !important;
    color: #f8f9fa !important;
    border: 1px solid #444 !important;
    border-radius: 4px;
    width: 100%;
}
.alert-danger {
    background: #ffdddd;
    color: #a94442;
    border: 1px solid #a94442;
    border-radius: 4px;
    padding: 10px;
    margin-bottom: 16px;
}
.form-wrapper {
    width: 100%;
    max-width: 600px;
}
@media (min-width: 1024px) {
    .painel-admin-container {
        margin-left: 260px;
        max-width: 1400px;
        padding-right: 32px;
        padding-left: 32px;
        margin-right: auto;
        margin-top: 0;
    }
    .painel-centralizado {
        padding: 32px 0;
    }
}
@media (max-width: 1023px) {
    .painel-admin-container {
        margin-left: 0 !important;
        padding-left: 8px;
        padding-right: 8px;
        max-width: 100vw;
    }
    .painel-centralizado {
        padding: 16px 4px;
        margin: 8px 0;
        max-width: 100%;
    }
    .form-wrapper {
        max-width: 100%;
    }
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="form-wrapper">
                <h1 class="title has-text-centered has-text-link-light">
                    <?= isset($nivel) ? 'Editar' : 'Novo' ?> Nível de Acesso
                </h1>

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
                    <div class="field is-grouped mt-3" style="justify-content: flex-end;">
                        <div class="control">
                            <button class="button is-success" type="submit">Salvar</button>
                        </div>
                        <div class="control">
                            <a class="button is-light" href="?rota=crud_nivel_acesso">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require __DIR__ . '/../../templates/rodape.php'; ?>
