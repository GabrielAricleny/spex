<?php $paginaAtual = 'administrador'; ?>
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
    max-width: 600px;
    margin: 0 auto;
    box-sizing: border-box;
    transition: padding 0.2s;
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
.btn, .button {
    margin-right: 4px;
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
        max-width: 600px;
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

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="form-bg">
                <h2 class="title has-text-centered has-text-link-light">Editar Administrador</h2>
                <form method="post">
                    <label class="form-label">Usuário</label>
                    <input type="text" class="form-control" value="<?= htmlspecialchars($admin->nome_usuario ?? '') ?>" readonly>

                    <label class="form-label">Nome Completo</label>
                    <input type="text" name="nome_completo" class="form-control" value="<?= htmlspecialchars($admin->nome_completo ?? '') ?>">

                    <label class="form-label">Telefone</label>
                    <input type="text" name="telefone" class="form-control" value="<?= htmlspecialchars($admin->telefone ?? '') ?>">

                    <div style="display:flex; gap:8px; justify-content:flex-end;">
                        <button type="submit" class="button is-success">Salvar</button>
                        <a href="?rota=crud_administrador" class="button is-light">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../../templates/rodape.php'; ?>