<?php
$paginaAtual = 'status_pergunta';
// Proteção: só admins podem acessar
include __DIR__ . '/../protecao_admin.php';
?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<style>
@media (min-width: 1024px) {
    .painel-admin-container { margin-left: 260px; max-width: 1400px; padding-right: 32px; padding-left: 32px; margin-right: auto; margin-top: 0; }
    .tabela-bg { padding: 32px 48px; }
}
@media (max-width: 1023px) {
    .painel-admin-container { margin-left: 0 !important; padding-left: 8px; padding-right: 8px; max-width: 100vw; }
    .tabela-bg { padding: 16px 4px; }
}
.tabela-bg {
    background: #23272b;
    border-radius: 12px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.15);
    padding: 32px 32px;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="tabela-bg">
                <h2 class="title has-text-centered has-text-link-light">Novo Status de Pergunta</h2>
                <form method="post" style="max-width: 400px; margin: 0 auto;">
                    <div class="field">
                        <label class="label has-text-light">Descrição</label>
                        <div class="control">
                            <input class="input" type="text" name="descricao_status" required autofocus>
                        </div>
                    </div>
                    <div class="field is-grouped is-grouped-right mt-5">
                        <div class="control">
                            <button type="submit" class="button is-success">
                                <span class="icon"><i class="fas fa-check"></i></span>
                                <span>Salvar</span>
                            </button>
                        </div>
                        <div class="control">
                            <a href="?rota=status_pergunta_listar" class="button is-light">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>