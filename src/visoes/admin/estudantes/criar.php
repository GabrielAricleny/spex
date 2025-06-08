<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<style>
body, html {
    background: #23272f !important;
}
.painel-admin-container {
    margin-left: 260px;
    padding-right: 0;
    padding-left: 0;
    margin-right: auto;
    margin-top: 0;
    box-sizing: border-box;
}

.painel-centralizado {
    background: transparent;
    border-radius: 8px;
    padding: 0;
    margin: 32px 0;
    width: 100%;
    /* max-width: 100%; */
}

.form-bg {
    background: #23272b;
    border-radius: 12px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.15);
    padding: 32px 56px;
    max-width: 900px;
    width: 100%;
    margin: 0 auto;
    box-sizing: border-box;
    transition: padding 0.2s;
}
.form-label, .label {
    color: #f8f9fa;
    font-weight: 600;
}
.input, .form-control, select.form-control {
    background: #23272b;
    color: #f8f9fa;
    border: 1px solid #444;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 16px;
    width: 100%;
}
.button {
    margin-right: 4px;
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

.section, .container {
    max-width: 100% !important;
    width: 100% !important;
}
</style>

<main>
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="form-bg">
                <h2 class="title has-text-centered has-text-link-light">Novo Estudante</h2>
                <form method="post">
                    <div class="field">
                        <label class="label">Nome Completo</label>
                        <div class="control">
                            <input class="input" type="text" name="nome_estudante" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Data de Nascimento</label>
                        <div class="control">
                            <input class="input" type="date" name="data_nasc" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Telefone</label>
                        <div class="control">
                            <input class="input" type="text" name="telefone" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control">
                            <input class="input" type="email" name="email" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Área de Formação</label>
                        <div class="control">
                            <input class="input" type="text" name="area_formacao" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Curso Pretendido</label>
                        <div class="control">
                            <input class="input" type="text" name="curso_pretendido" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Nome de Usuário</label>
                        <div class="control">
                            <input class="input" type="text" name="nome_usuario" required>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Senha</label>
                        <div class="control">
                            <input class="input" type="password" name="senha_estudante" required>
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
    </div>
</main>

<?php include __DIR__ . '/../../templates/rodape.php'; ?>