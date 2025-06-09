<?php
$paginaAtual = 'lista_perguntas_exame_sistema';
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
.table {
    background: #23272b;
    color: #f8f9fa;
}
.table th, .table td {
    color: #f8f9fa;
}
.button.is-primary {
    background: #00b894;
    color: #fff;
    border: none;
    font-weight: 600;
}
.button.is-primary:hover {
    background: #00916e;
}
.button.is-link {
    background: #0984e3;
    color: #fff;
    border: none;
}
.button.is-link:hover {
    background: #0652dd;
}
.button.is-warning {
    background: #fdcb6e;
    color: #23272b;
    border: none;
}
.button.is-warning:hover {
    background: #e1b12c;
}
.button.is-danger {
    background: #d63031;
    color: #fff;
    border: none;
}
.button.is-danger:hover {
    background: #b71c1c;
}
.painel-admin-container {
    margin-left: 260px;
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
</style>

<section class="section" style="background: #23272f; min-height: 100vh;">
    <div class="painel-admin-container">
        <div class="tabela-bg">
            <h2 class="title is-4 has-text-centered has-text-link-light">Perguntas em Exames do Sistema</h2>
            <div style="width:100%; display:flex; justify-content:flex-end; gap:8px; margin-bottom:24px;">
                <a href="?rota=lista_perguntas_exame_sistema_criar" class="button is-primary is-small">
                    <span class="icon"><i class="fas fa-plus"></i></span>
                    <span>Adicionar Pergunta ao Exame</span>
                </a>
                <a href="?rota=lista_perguntas_exame_sistema_criar_aleatorio" class="button is-link is-small">
                    <span class="icon"><i class="fas fa-random"></i></span>
                    <span>Adicionar Perguntas Aleatórias</span>
                </a>
            </div>
            <table class="table is-striped is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>Exame</th>
                        <th>Pergunta</th>
                        <th>Editar</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listas as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['id_exame_sistema']) ?> (<?= htmlspecialchars($item['duracao']) ?>)</td>
                            <td><?= htmlspecialchars($item['enunciado']) ?></td>
                            <td>
                                <a href="?rota=lista_perguntas_exame_sistema_editar&id_exame=<?= $item['id_exame_sistema'] ?>&id_pergunta=<?= $item['id_pergunta'] ?>" class="button is-warning is-small">
                                    <span class="icon"><i class="fas fa-edit"></i></span>
                                </a>
                            </td>
                            <td>
                                <a href="?rota=lista_perguntas_exame_sistema_excluir&id_exame=<?= $item['id_exame_sistema'] ?>&id_pergunta=<?= $item['id_pergunta'] ?>" class="button is-danger is-small" onclick="return confirm('Remover esta pergunta do exame?')">
                                    <span class="icon"><i class="fas fa-trash"></i></span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>