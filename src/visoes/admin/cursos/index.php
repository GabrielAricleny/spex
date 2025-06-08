<?php
// ...busca os cursos do banco...
$cursos = App\Modelos\Curso::todos();

include __DIR__ . '/../../templates/cabecalho.php';
include __DIR__ . '/../sidebar.php';
?>

<style>
body, html {
    background: #23272f !important;
}
.painel-centralizado {
    background: #23272b;
    border-radius: 12px;
    padding: 32px 32px;
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
.table.is-striped.is-hoverable.is-fullwidth, .table {
    width: 100%;
    min-width: 600px;
    background: transparent;
    border-radius: 6px;
    overflow: hidden;
    color: #f8f9fa;
    table-layout: auto;
    margin: 0;
}
.table.is-striped.is-hoverable.is-fullwidth th,
.table.is-striped.is-hoverable.is-fullwidth td,
.table th, .table td {
    color: #f8f9fa;
    background: #23272b;
    white-space: nowrap;
    padding-left: 10px;
    padding-right: 10px;
    border: none;
}
.table.is-striped.is-hoverable.is-fullwidth tr:nth-child(even) td,
.table tr:nth-child(even) td {
    background: #2c3136;
}
h2, .title.has-text-centered {
    color: #f8f9fa;
}
.button.is-primary, .btn-primary {
    background: #2563eb;
    border-color: #2563eb;
    color: #fff;
}
.button.is-warning, .btn-warning {
    background: #f59e42;
    border-color: #f59e42;
    color: #fff;
}
.button.is-danger, .btn-danger {
    background: #e53e3e;
    border-color: #e53e3e;
    color: #fff;
}
.button.is-primary:hover,
.button.is-warning:hover,
.button.is-danger:hover,
.btn-primary:hover,
.btn-warning:hover,
.btn-danger:hover {
    filter: brightness(0.95);
}
.btn, .button {
    border-radius: 4px;
    padding: 4px 12px;
    font-size: 14px;
    margin-right: 4px;
    text-decoration: none;
    display: inline-block;
}
</style>

<main style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <h2 class="title has-text-centered">Cursos</h2>
            <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
                <a href="?rota=crud_curso&acao=criar" class="button is-primary is-small">Novo Curso</a>
            </div>
            <div class="tabela-rolagem">
                <table class="table is-striped is-hoverable is-fullwidth">
                    <thead>
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Nome</th>
                            <th style="width: 90px;">Editar</th>
                            <th style="width: 90px;">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cursos as $curso): ?>
                            <tr>
                                <td><?= htmlspecialchars($curso['id_curso'] ?? '') ?></td>
                                <td><?= htmlspecialchars($curso['nome'] ?? '') ?></td>
                                <td>
                                    <a href="?rota=crud_curso&acao=editar&id=<?= $curso['id_curso'] ?? '' ?>" class="button is-warning is-small">Editar</a>
                                </td>
                                <td>
                                    <a href="?rota=crud_curso&acao=deletar&id=<?= $curso['id_curso'] ?? '' ?>" class="button is-danger is-small" onclick="return confirm('Tem certeza?')">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>
