<?php
$paginaAtual = 'exame_sistema';
include __DIR__ . '/../protecao_admin.php';
?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<style>
.tabela-bg {
    background: #23272b;
    border-radius: 14px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.18);
    padding: 36px 36px;
    margin-top: 24px;
    margin-bottom: 24px;
}
input {
    background: #23272b;
    color: #f8f9fa;
    border: 1px solid #444;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 16px;
    width: 100%;
}
.button.is-success {
    background: #00b894;
    color: #fff;
    border: none;
    font-weight: 600;
}
.button.is-success:hover {
    background: #00916e;
}
.button.is-light {
    background: #444;
    color: #fff;
    border: none;
}
.button.is-light:hover {
    background: #23272b;
}
.painel-admin-container {
    margin-left: 260px;
    max-width: 1400px;
    padding-right: 32px;
    padding-left: 32px;
    margin-right: auto;
    margin-top: 0;
}
@media (max-width: 1023px) {
    .painel-admin-container {
        margin-left: 0 !important;
        padding-left: 8px;
        padding-right: 8px;
        max-width: 100vw;
    }
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="tabela-bg">
                <h2 class="title is-4 has-text-centered has-text-link-light" style="margin-bottom: 2rem;">
                    <span class="icon-text">
                        <span class="icon"><i class="fas fa-edit"></i></span>
                        <span>Editar Exame do Sistema</span>
                    </span>
                </h2>
                <form method="post" style="max-width: 400px; margin: 0 auto;">
                    <div class="field">
                        <label class="label has-text-light">Duração (hh:mm:ss)</label>
                        <div class="control">
                            <input type="time" name="duracao" class="input" required value="<?= htmlspecialchars($exame['duracao']) ?>">
                        </div>
                    </div>
                    <div class="field is-grouped is-grouped-right mt-5" style="display:flex; gap:8px; justify-content:flex-end;">
                        <button type="submit" class="button is-success">
                            <span class="icon"><i class="fas fa-check"></i></span>
                            <span>Salvar</span>
                        </button>
                        <a href="?rota=exame_sistema_listar" class="button is-light">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>