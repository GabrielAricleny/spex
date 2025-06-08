<?php $paginaAtual = 'nivel_acesso'; ?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
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
}
.form-label {
    color: #f8f9fa;
    font-weight: 600;
}
.form-control {
    background: #23272b;
    color: #f8f9fa;
    border: 1px solid #444;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 16px;
    width: 100%;
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
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado" style="max-width:600px; margin:auto;">
            <h2 class="title has-text-centered has-text-link-light">Editar Nível de Acesso</h2>
            <form method="post">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($nivelAcesso->nome ?? '') ?>" required>
                <div style="display:flex; gap:8px; justify-content:flex-end;">
                    <button type="submit" class="button is-success">Salvar</button>
                    <a href="?rota=crud_nivel_acesso" class="button is-light">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>