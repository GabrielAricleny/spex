<?php
$paginaAtual = 'disciplina_curso';
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
.painel-admin-container {
    margin-left: 260px; /* largura do sidebar */
    max-width: 1400px;
    padding-right: 32px;
    padding-left: 32px;
    margin-right: auto;
    margin-top: 0;
}
@media (max-width: 1023px) {
    .painel-admin-container {
        margin-left: 0 !important;
        padding-left: 8px;
        padding-right: 8px;
        max-width: 100vw;
    }
}
.tabela-bg {
    background: #23272b;
    border-radius: 14px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.18);
    padding: 36px 36px;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    margin-top: 24px;
    margin-bottom: 24px;
}
.table-container {
    width: 100%;
    overflow-x: auto;
}
.table.is-striped.is-hoverable.is-fullwidth {
    min-width: 700px;
    width: 100%;
    background: transparent;
    color: #f8f9fa;
    table-layout: auto;
    border-radius: 8px;
    overflow: hidden;
}
.table thead {
    background: #23272b;
}
.table th {
    color: #00bfff;
    font-weight: 700;
    background: #23272b;
    border-bottom: 2px solid #00bfff;
    text-align: center;
}
.table td {
    color: #f8f9fa;
    background: #23272b;
    text-align: center;
    vertical-align: middle;
}
.table tr:nth-child(even) td {
    background: #23283a;
}
.table tr:hover td {
    background: #1e2230;
}
.button.is-primary.is-small {
    background: #00bfff;
    border: none;
    color: #fff;
    font-weight: 600;
    transition: background 0.2s;
}
.button.is-primary.is-small:hover {
    background: #0099cc;
}
.button.is-warning.is-small {
    background: #ffb300;
    color: #23272b;
    border: none;
}
.button.is-warning.is-small:hover {
    background: #ff9800;
    color: #fff;
}
.button.is-danger.is-small {
    background: #ff4d4f;
    color: #fff;
    border: none;
}
.button.is-danger.is-small:hover {
    background: #d32f2f;
}
@media (max-width: 900px) {
    .tabela-bg {
        padding: 16px 4px;
    }
    .table.is-striped.is-hoverable.is-fullwidth {
        font-size: 13px;
        min-width: 500px;
    }
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="tabela-bg">
                <h2 class="title is-4 has-text-centered has-text-link-light" style="margin-bottom: 2rem;">
                    <span class="icon-text">
                        <span class="icon"><i class="fas fa-link"></i></span>
                        <span>Disciplinas por Curso</span>
                    </span>
                </h2>
                <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
                    <a href="?rota=disciplina_curso_criar" class="button is-primary is-small">
                        <span class="icon"><i class="fas fa-plus"></i></span>
                        <span>Nova Relação</span>
                    </a>
                </div>
                <div class="table-container">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th>Disciplina</th>
                                <th>Criada em</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($disciplinasCursos)): ?>
                                <?php foreach ($disciplinasCursos as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['nome_curso']) ?></td>
                                        <td><?= htmlspecialchars($item['nome_disciplina']) ?></td>
                                        <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($item['criado_em']))) ?></td>
                                        <td>
                                            <a href="?rota=disciplina_curso_editar&id_disciplina=<?= $item['id_disciplina'] ?>&id_curso=<?= $item['id_curso'] ?>" class="button is-warning is-small" title="Editar">
                                                <span class="icon"><i class="fas fa-edit"></i></span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="?rota=disciplina_curso_excluir&id_disciplina=<?= $item['id_disciplina'] ?>&id_curso=<?= $item['id_curso'] ?>" class="button is-danger is-small" title="Eliminar" onclick="return confirm('Tem a certeza que pretende eliminar esta relação?')">
                                                <span class="icon"><i class="fas fa-trash"></i></span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="has-text-centered">Nenhuma relação encontrada.</td>
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