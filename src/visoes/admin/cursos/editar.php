<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<style>
body, html {
    background: #23272f !important;
}
.painel-centralizado {
    background: transparent;
    border-radius: 8px;
    padding: 0;
    margin: 32px 0;
    width: 100%;
    max-width: 100%;
}
.form-bg {
    background: #23272b;
    border-radius: 12px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.15);
    padding: 32px 32px;
    width: 100%;
    max-width: 800px; /* aumentada para 800px */
    margin: 0 auto;
    box-sizing: border-box;
    transition: padding 0.2s;
}
.label, .title {
    color: #f8f9fa;
}
.input, .select select {
    background: #23272b;
    color: #f8f9fa;
    border: 1px solid #444;
    border-radius: 4px;
}
.button.is-primary {
    background: #2563eb;
    border-color: #2563eb;
    color: #fff;
}
.button.is-text {
    background: transparent;
    color: #a0aec0;
    border: none;
}
@media (min-width: 1024px) {
    .painel-admin-container {
        margin-left: 260px;
        max-width: 1200px;
        padding-right: 32px;
        padding-left: 32px;
        margin-right: auto;
        margin-top: 0;
    }
    .form-bg {
        padding: 32px 56px;
        max-width: 800px; /* aumentada para 800px */
    }
}
@media (max-width: 1023px) {
    .painel-admin-container {
        margin-left: 0 !important;
        padding-left: 8px;
        padding-right: 8px;
        max-width: 100vw;
    }
    .form-bg {
        padding: 16px 4px;
        margin: 8px 0;
        max-width: 100%;
    }
}
</style>

<main style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="form-bg">
                <h2 class="title has-text-centered">Editar Curso</h2>
                <form method="post">
                    <div class="field">
                        <label class="label">Nome do Curso</label>
                        <div class="control">
                            <input class="input" type="text" name="nome_curso" required value="<?= htmlspecialchars($curso->nome_curso ?? '') ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Nível</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="nivel" required>
                                    <option value="">Selecione o nível</option>
                                    <option value="medio" <?= (isset($curso->nivel) && $curso->nivel === 'medio') ? 'selected' : '' ?>>Ensino Médio</option>
                                    <option value="superior" <?= (isset($curso->nivel) && $curso->nivel === 'superior') ? 'selected' : '' ?>>Ensino Superior</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <button class="button is-primary is-fullwidth" type="submit">Salvar</button>
                    </div>
                </form>
                <p class="has-text-centered mt-4">
                    <a href="?rota=crud_curso" class="button is-text">← Voltar</a>
                </p>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../../templates/rodape.php'; ?>