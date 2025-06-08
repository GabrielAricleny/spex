<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<style>
body, html {
    background: #23272f !important;
}
.painel-centralizado {
    background: #23272b;
    border-radius: 12px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.15);
    padding: 32px 32px;
    max-width: 1000px; /* aumentada para 1000px */
    margin: 32px auto;
    box-sizing: border-box;
}
.label, .title {
    color: #f8f9fa;
}
.input {
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
@media (min-width: 1200px) {
    .painel-admin-container {
        margin-left: 260px;
        max-width: 1200px;
        padding-right: 32px;
        padding-left: 32px;
        margin-right: auto;
        margin-top: 0;
    }
    .painel-centralizado {
        padding: 32px 56px;
        max-width: 1000px; /* aumentada para 1000px */
    }
}
@media (max-width: 1199px) {
    .painel-admin-container {
        margin-left: 0 !important;
        padding-left: 8px;
        padding-right: 8px;
        max-width: 100vw;
    }
    .painel-centralizado {
        padding: 16px 4px;
        margin: 8px 0;
        max-width: 100vw;
    }
}
</style>

<main style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <h2 class="title has-text-centered">Editar Estudante</h2>
            <form method="post">
                <div class="field">
                    <label class="label">Nome Completo</label>
                    <div class="control">
                        <input class="input" type="text" name="nome_completo" required value="<?= htmlspecialchars($estudante->nome_completo ?? '') ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Data de Nascimento</label>
                    <div class="control">
                        <input class="input" type="date" name="data_nasc" required value="<?= htmlspecialchars($estudante->data_nasc ?? '') ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Telefone</label>
                    <div class="control">
                        <input class="input" type="text" name="telefone" required value="<?= htmlspecialchars($estudante->telefone ?? '') ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control">
                        <input class="input" type="email" name="email" required value="<?= htmlspecialchars($estudante->email ?? '') ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Área de Formação</label>
                    <div class="control">
                        <input class="input" type="text" name="area_formacao" required value="<?= htmlspecialchars($estudante->area_formacao ?? '') ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Curso Pretendido</label>
                    <div class="control">
                        <input class="input" type="text" name="curso_pretendido" required value="<?= htmlspecialchars($estudante->curso_pretendido ?? '') ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Nome de Usuário</label>
                    <div class="control">
                        <input class="input" type="text" name="nome_usuario" required value="<?= htmlspecialchars($estudante->nome_usuario ?? '') ?>">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Senha (preencha para alterar)</label>
                    <div class="control">
                        <input class="input" type="password" name="senha_estudante">
                    </div>
                </div>
                <div class="field">
                    <button class="button is-primary is-fullwidth" type="submit">Salvar</button>
                </div>
            </form>
            <p class="has-text-centered mt-4">
                <a href="?rota=crud_estudante" class="button is-text">← Voltar</a>
            </p>
        </div>
    </div>
</main>

<?php include __DIR__ . '/../../templates/rodape.php'; ?>