<?php $paginaAtual = 'estudante'; ?>
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
    min-width: 1000px;
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
            <h2 class="title has-text-centered">Lista de Estudantes</h2>
            <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
                <a href="?rota=crud_estudante&acao=criar" class="button is-primary is-small">
                    <span class="icon"><i class="fas fa-plus"></i></span>
                    <span>Novo Estudante</span>
                </a>
            </div>
            <div class="tabela-rolagem">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data de Nascimento</th>
                            <th>Telefone</th>
                            <th>Área de Formação</th>
                            <th>Curso Pretendido</th>
                            <th>Criado em</th>
                            <th>Actualizado em</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($estudantes)): ?>
                            <?php foreach ($estudantes as $estudante): ?>
                                <tr>
                                    <td><?= htmlspecialchars($estudante->id_usuario ?? '') ?></td>
                                    <td><?= htmlspecialchars($estudante->data_nasc ?? '') ?></td>
                                    <td><?= htmlspecialchars($estudante->telefone ?? '') ?></td>
                                    <td>
                                        <?= htmlspecialchars($estudante->nome_area_formacao ?? $estudante->area_formacao ?? '') ?>
                                    </td>
                                    <td>
                                        <?= htmlspecialchars($estudante->nome_curso_pretendido ?? $estudante->curso_pretendido ?? '') ?>
                                    </td>
                                    <td><?= htmlspecialchars($estudante->criado_em ?? '') ?></td>
                                    <td><?= htmlspecialchars($estudante->actualizado_em ?? '') ?></td>
                                    <td>
                                        <a href="?rota=crud_estudante&acao=editar&id=<?= $estudante->id_usuario ?>" class="button is-warning is-small">
                                            <span class="icon"><i class="fas fa-edit"></i></span>
                                            <span>Editar</span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="?rota=crud_estudante&acao=eliminar&id=<?= $estudante->id_usuario ?>" class="button is-danger is-small" onclick="return confirm('Tem a certeza que pretende eliminar este estudante?')">
                                            <span class="icon"><i class="fas fa-trash"></i></span>
                                            <span>Eliminar</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="has-text-centered">Nenhum estudante encontrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>