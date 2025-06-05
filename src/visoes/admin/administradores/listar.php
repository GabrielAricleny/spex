<?php $paginaAtual = 'administrador'; ?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>

<style>
.painel-centralizado {
    background: #23272b;
    border-radius: 8px;
    padding: 32px 24px;
    max-width: 1600px;
    margin: 32px 32px 32px 32px; /* 32px em todos os lados */
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
}
@media (max-width: 1200px) {
    .painel-centralizado {
        padding-left: 8px;
        padding-right: 8px;
        min-width: unset;
        margin: 8px;
    }
}
.table.is-striped.is-hoverable.is-fullwidth {
    min-width: 1300px;
}
.table.is-striped.is-hoverable {
    width: 100%;
    min-width: 1300px;
    background: #23272b;
    border-radius: 6px;
    overflow: hidden;
    color: #f8f9fa;
}
.table.is-striped.is-hoverable th,
.table.is-striped.is-hoverable td {
    color: #f8f9fa;
    background: #23272b;
}
.table.is-striped.is-hoverable tr:nth-child(even) td {
    background: #2c3136;
}
h2 {
    color: #f8f9fa;
}
a.btn {
    color: #fff;
}
</style>

<main>
    <div class="painel-centralizado">
        <h2 class="title has-text-centered">Lista de Administradores</h2>
        <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
            <a href="?rota=crud_administrador&acao=criar" class="button is-primary is-small">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span>Novo Administrador</span>
            </a>
        </div>
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
</main>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>