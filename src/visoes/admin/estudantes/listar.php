<?php $paginaAtual = 'estudante'; ?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>

<style>
.painel-centralizado {
    background: #23272b;
    border-radius: 8px;
    padding: 32px 24px;
    max-width: 1600px;
    margin: 32px 32px 32px 32px;
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
h2, .title.has-text-centered {
    color: #f8f9fa;
}
</style>

<main>
    <div class="painel-centralizado">
        <h2 class="title has-text-centered">Lista de Estudantes</h2>
        <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
            <a href="?rota=crud_estudante&acao=criar" class="button is-primary is-small">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span>Novo Estudante</span>
            </a>
        </div>
        <table class="table is-striped is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Nome Completo</th>
                    <th>Nome de Utilizador</th>
                    <th>Email</th>
                    <th>Data de Nascimento</th>
                    <th>Telefone</th>
                    <th>Área de Formação</th>
                    <th>Curso Pretendido</th>
                    <th style="width: 90px;">Editar</th>
                    <th style="width: 90px;">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($estudantes as $estudante): ?>
                    <tr>
                        <td><?= htmlspecialchars($estudante->id_usuario ?? '') ?></td>
                        <td><?= htmlspecialchars($estudante->nome_completo ?? '') ?></td>
                        <td><?= htmlspecialchars($estudante->nome_usuario ?? '') ?></td>
                        <td><?= htmlspecialchars($estudante->email ?? '') ?></td>
                        <td><?= htmlspecialchars($estudante->data_nasc ?? '') ?></td>
                        <td><?= htmlspecialchars($estudante->telefone ?? '') ?></td>
                        <td><?= htmlspecialchars($estudante->area_formacao ?? '') ?></td>
                        <td><?= htmlspecialchars($estudante->curso_pretendido ?? '') ?></td>
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
            </tbody>
        </table>
    </div>
</main>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>