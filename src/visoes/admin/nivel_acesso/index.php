<?php
$paginaAtual = 'nivel_acesso';
// Proteção: só admins podem acessar
include __DIR__ . '/../protecao_admin.php';
?>
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
    .table.is-striped.is-hoverable.is-fullwidth {
        min-width: 900px;
        width: 100%;
        font-size: 15px;
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
        padding: 16px 0;
        margin: 8px 0;
    }
    .table.is-striped.is-hoverable.is-fullwidth {
        min-width: 400px;
        width: 100%;
        font-size: 13px;
    }
}
.table.is-striped.is-hoverable.is-fullwidth {
    width: 100%;
    min-width: 900px;
    background: #23272b;
    color: #fff;
    table-layout: auto;
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <h2 class="title has-text-centered has-text-link-light">Lista de Níveis de Acesso</h2>
            <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
                <a href="?rota=crud_nivel_acesso&acao=criar" class="button is-primary is-small">
                    <span class="icon"><i class="fas fa-plus"></i></span>
                    <span>Novo Nível de Acesso</span>
                </a>
            </div>
            <div style="overflow-x:auto;">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th style="width: 90px;">Editar</th>
                            <th style="width: 90px;">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($niveis as $nivel): ?>
                            <tr>
                                <td><?= htmlspecialchars($nivel['id_nivel']) ?></td>
                                <td><?= htmlspecialchars($nivel['descricao'] ?? '') ?></td>
                                <td>
                                    <a href="?rota=crud_nivel_acesso&acao=editar&id=<?= $nivel['id_nivel'] ?>" class="button is-warning is-small">
                                        <span class="icon"><i class="fas fa-edit"></i></span>
                                        <span>Editar</span>
                                    </a>
                                </td>
                                <td>
                                    <a href="?rota=crud_nivel_acesso&acao=eliminar&id=<?= $nivel['id_nivel'] ?>" class="button is-danger is-small" onclick="return confirm('Tem a certeza que pretende eliminar este nível de acesso?')">
                                        <span class="icon"><i class="fas fa-trash"></i></span>
                                        <span>Eliminar</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>
