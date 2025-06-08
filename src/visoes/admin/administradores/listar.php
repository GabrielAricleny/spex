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
.tabela-bg {
    background: #23272b;
    border-radius: 12px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.15);
    padding: 32px 32px;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    transition: padding 0.2s;
    margin: 0 16px 0 0; /* afasta da margem direita */
    overflow-x: auto;
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
    .tabela-bg {
        padding: 32px 48px 32px 40px;
        max-width: 100%;
        margin-right: 24px; /* mais espaço à direita em desktop */
    }
    .table.is-striped.is-hoverable.is-fullwidth {
        width: 100%;
        min-width: 700px;
        font-size: 15px;
        table-layout: auto;
        margin-right: 0;
    }
}
@media (max-width: 1199px) {
    .painel-admin-container {
        margin-left: 0 !important;
        padding-left: 8px;
        padding-right: 8px;
        max-width: 100vw;
    }
    .tabela-bg {
        padding: 16px 8px;
        max-width: 100%;
        margin-right: 8px;
    }
    .table.is-striped.is-hoverable.is-fullwidth {
        min-width: 600px;
        width: 100%;
        font-size: 13px;
    }
}
.table.is-striped.is-hoverable.is-fullwidth {
    width: 100%;
    min-width: 700px;
    background: transparent;
    color: #f8f9fa;
    table-layout: auto;
    border-radius: 6px;
    overflow: hidden;
    margin-right: 0;
}
.table.is-striped.is-hoverable.is-fullwidth th,
.table.is-striped.is-hoverable.is-fullwidth td {
    color: #f8f9fa;
    background: #23272b;
    white-space: nowrap;
    padding-left: 10px;
    padding-right: 10px;
}
.table.is-striped.is-hoverable.is-fullwidth tr:nth-child(even) td {
    background: #2c3136;
}
h2 {
    color: #f8f9fa;
}
a.btn {
    color: #fff;
}
/* Corrige o rodapé para não sobrepor o sidebar */
footer, .footer, #footer {
    margin-left: 0 !important;
    padding-left: 0 !important;
    box-sizing: border-box;
    width: 100%;
    max-width: 100vw;
    z-index: 1;
    background: inherit;
}
@media (min-width: 1200px) {
    footer, .footer, #footer {
        margin-left: 260px !important;
        width: calc(100vw - 260px);
        max-width: calc(100vw - 260px);
    }
}
</style>

<main>
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="tabela-bg">
                <h2 class="title has-text-centered">Lista de Administradores</h2>
                <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
                    <a href="?rota=crud_administrador&acao=criar" class="button is-primary is-small">
                        <span class="icon"><i class="fas fa-plus"></i></span>
                        <span>Novo Administrador</span>
                    </a>
                </div>
                <div style="overflow-x:auto;">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th style="width: 80px;">ID do Usuário</th>
                                <th>Nome Completo</th>
                                <th>Nome de Utilizador</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>Criado em</th>
                                <th>Actualizado em</th>
                                <th style="width: 90px;">Editar</th>
                                <th style="width: 90px;">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($administradores as $admin): ?>
                                <tr>
                                    <td style="width: 80px;"><?= htmlspecialchars($admin->id_usuario) ?></td>
                                    <td><?= htmlspecialchars($admin->nome_completo ?? '') ?></td>
                                    <td><?= htmlspecialchars($admin->nome_usuario ?? '') ?></td>
                                    <td><?= htmlspecialchars($admin->email ?? '') ?></td>
                                    <td><?= htmlspecialchars($admin->telefone ?? '') ?></td>
                                    <td><?= htmlspecialchars($admin->criado_em ?? '') ?></td>
                                    <td><?= htmlspecialchars($admin->actualizado_em ?? '') ?></td>
                                    <td>
                                        <a href="?rota=crud_administrador&acao=editar&id=<?= $admin->id_usuario ?>" class="button is-warning is-small">
                                            <span class="icon"><i class="fas fa-edit"></i></span>
                                            <span>Editar</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="?rota=crud_administrador&acao=eliminar&id=<?= $admin->id_usuario ?>" class="button is-danger is-small" onclick="return confirm('Tem a certeza que pretende eliminar este administrador?')">
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
    </div>
</main>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>