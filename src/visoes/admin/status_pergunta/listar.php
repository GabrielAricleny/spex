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
.table-container {
    width: 100%;
    overflow-x: auto;
}
.table.is-striped.is-hoverable.is-fullwidth {
    min-width: 600px;
    width: 100%;
    background: #23272b;
    color: #fff;
    table-layout: auto;
}
.table th,
.table td {
    white-space: nowrap;
    padding: 0.75em 1.5em;
    vertical-align: middle;
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="tabela-bg">
                <h2 class="title has-text-centered has-text-link-light">Status das Perguntas</h2>
                <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
                    <a href="?rota=status_pergunta_criar" class="button is-primary is-small">
                        <span class="icon"><i class="fas fa-plus"></i></span>
                        <span>Novo Status</span>
                    </a>
                </div>
                <div class="table-container">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th style="min-width: 60px;">ID</th>
                                <th style="min-width: 220px;">Descrição</th>
                                <th style="min-width: 90px;">Editar</th>
                                <th style="min-width: 100px;">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($statusPerguntas)): ?>
                                <?php foreach ($statusPerguntas as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['id_status']) ?></td>
                                        <td><?= htmlspecialchars($item['descricao_status']) ?></td>
                                        <td>
                                            <a href="?rota=status_pergunta_editar&id=<?= $item['id_status'] ?>" class="button is-warning is-small">
                                                <span class="icon"><i class="fas fa-edit"></i></span>
                                                <span>Editar</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="?rota=status_pergunta_excluir&id=<?= $item['id_status'] ?>" class="button is-danger is-small" onclick="return confirm('Tem a certeza que pretende eliminar este status?')">
                                                <span class="icon"><i class="fas fa-trash"></i></span>
                                                <span>Eliminar</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="has-text-centered">Nenhum status cadastrado.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>