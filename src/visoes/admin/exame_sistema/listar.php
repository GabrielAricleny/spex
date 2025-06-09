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
.table th {
    color: #00bfff;
    background: #23272b;
    border-bottom: 2px solid #00bfff;
    text-align: center;
}
.table td {
    color: #f8f9fa;
    background: #23272b;
    text-align: center;
}
.table tr:nth-child(even) td {
    background: #23283a;
}
.table tr:hover td {
    background: #1e2230;
}
.button.is-warning.is-small {
    background: #ffb300;
    color: #23272b;
    border: none;
}
.button.is-danger.is-small {
    background: #ff4d4f;
    color: #fff;
    border: none;
}
.painel-admin-container {
    margin-left: 260px;
    /* Remova width/max-width! */
    padding-right: 16px;
    padding-left: 16px;
    margin-right: 0;
    margin-top: 0;
    box-sizing: border-box;
    overflow-x: auto;
    max-width: 1400px; /* ou outro valor desejado */
}
@media (max-width: 1023px) {
    .painel-admin-container {
        margin-left: 0 !important;
        width: 100vw;
        padding-left: 8px;
        padding-right: 8px;
    }
}
</style>

<section class="section painel-admin-container" style="background: #23272f; min-height: 100vh;">
    <div class="painel-centralizado">
        <div class="tabela-bg">
            <h2 class="title is-4 has-text-centered has-text-link-light" style="margin-bottom: 2rem;">
                <span class="icon-text">
                    <span class="icon"><i class="fas fa-file-alt"></i></span>
                    <span>Exames do Sistema</span>
                </span>
            </h2>
            <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
                <a href="?rota=exame_sistema_criar" class="button is-primary is-small">
                    <span class="icon"><i class="fas fa-plus"></i></span>
                    <span>Novo Exame</span>
                </a>
            </div>
            <div class="table-container">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Duração</th>
                            <th>Criado em</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($exames)): ?>
                            <?php foreach ($exames as $exame): ?>
                                <tr>
                                    <td><?= htmlspecialchars($exame['id_exame']) ?></td>
                                    <td><?= htmlspecialchars($exame['duracao']) ?></td>
                                    <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($exame['criado_em']))) ?></td>
                                    <td>
                                        <a href="?rota=exame_sistema_editar&id=<?= $exame['id_exame'] ?>" class="button is-warning is-small" title="Editar">
                                            <span class="icon"><i class="fas fa-edit"></i></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="?rota=exame_sistema_excluir&id=<?= $exame['id_exame'] ?>" class="button is-danger is-small" title="Eliminar" onclick="return confirm('Tem a certeza que pretende eliminar este exame?')">
                                            <span class="icon"><i class="fas fa-trash"></i></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="has-text-centered">Nenhum exame encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>