<?php
$paginaAtual = 'usuario';
// Proteção: só admins podem acessar
include __DIR__ . '/../protecao_admin.php';
?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<style>
body, html {
    background: #23272f !important;
}
.painel-centralizado {
    background: #23272b;
    border-radius: 12px;
    padding: 32px 24px;
    max-width: 1200px;
    margin: 32px auto;
    box-shadow: 0 2px 16px rgba(0,0,0,0.15);
    box-sizing: border-box;
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
        padding: 32px 48px;
        margin: 32px 24px 32px 24px;
        max-width: calc(100vw - 300px);
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
        margin: 8px;
        max-width: 100vw;
    }
}
.tabela-rolagem {
    width: 100%;
    overflow-x: auto;
}
.table.is-striped.is-hoverable.is-fullwidth {
    width: 100%;
    min-width: 700px;
    background: transparent;
    border-radius: 6px;
    overflow: hidden;
    color: #f8f9fa;
    table-layout: auto;
    margin: 0;
}
.table.is-striped.is-hoverable.is-fullwidth th,
.table.is-striped.is-hoverable.is-fullwidth td {
    color: #f8f9fa;
    background: #23272b;
    white-space: nowrap;
    padding-left: 10px;
    padding-right: 10px;
    border: none;
}
.table.is-striped.is-hoverable.is-fullwidth tr:nth-child(even) td {
    background: #2c3136;
}
h2, .title.has-text-centered {
    color: #f8f9fa;
}
.button.is-primary {
    background: #2563eb;
    border-color: #2563eb;
    color: #fff;
}
.button.is-warning {
    background: #f59e42;
    border-color: #f59e42;
    color: #fff;
}
.button.is-danger {
    background: #e53e3e;
    border-color: #e53e3e;
    color: #fff;
}
.button.is-primary:hover,
.button.is-warning:hover,
.button.is-danger:hover {
    filter: brightness(0.95);
}
</style>

<main style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <h2 class="title has-text-centered">Lista de Usuários</h2>
            <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
                <a href="?rota=crud_usuario&acao=criar" class="button is-primary is-small">
                    <span class="icon"><i class="fas fa-plus"></i></span>
                    <span>Novo Usuário</span>
                </a>
            </div>
            <div class="tabela-rolagem">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Nome Completo</th>
                            <th>Nome de Utilizador</th>
                            <th>Email</th>
                            <th>Nível de Acesso</th>
                            <th>Data de Criação</th>
                            <th>Data de Atualização</th>
                            <th style="width: 90px;">Editar</th>
                            <th style="width: 90px;">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td><?= htmlspecialchars($usuario->id_usuario ?? '') ?></td>
                                    <td><?= htmlspecialchars($usuario->nome_completo ?? '') ?></td>
                                    <td><?= htmlspecialchars($usuario->nome_usuario ?? '') ?></td>
                                    <td><?= htmlspecialchars($usuario->email ?? '') ?></td>
                                    <td><?= htmlspecialchars($usuario->id_nivel_acesso ?? '') ?></td>
                                    <td><?= htmlspecialchars($usuario->criado_em ?? '') ?></td>
                                    <td><?= htmlspecialchars($usuario->actualizado_em ?? '') ?></td>
                                    <td>
                                        <a href="?rota=crud_usuario&acao=editar&id=<?= $usuario->id_usuario ?>" class="button is-warning is-small">
                                            <span class="icon"><i class="fas fa-edit"></i></span>
                                            <span>Editar</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="?rota=crud_usuario&acao=eliminar&id=<?= $usuario->id_usuario ?>" class="button is-danger is-small" onclick="return confirm('Tem a certeza que pretende eliminar este utilizador?')">
                                            <span class="icon"><i class="fas fa-trash"></i></span>
                                            <span>Eliminar</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="has-text-centered">Nenhum usuário encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>