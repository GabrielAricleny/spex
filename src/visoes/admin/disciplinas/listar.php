<?php $paginaAtual = 'disciplina'; ?>
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
    transition: padding 0.2s;
    box-sizing: border-box;
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
    .tabela-bg {
        padding: 32px 48px;
    }
    .table.is-striped.is-hoverable.is-fullwidth {
        width: 100%;
        font-size: 15px;
        table-layout: auto;
        min-width: 0;
    }
}
@media (max-width: 1023px) {
    .painel-admin-container {
        margin-left: 0 !important;
        padding-left: 8px;
        padding-right: 8px;
        max-width: 100vw;
    }
    .tabela-bg {
        padding: 16px 4px;
    }
    .table.is-striped.is-hoverable.is-fullwidth {
        min-width: 600px;
        width: 100%;
        font-size: 13px;
    }
}
.table.is-striped.is-hoverable.is-fullwidth {
    width: 100%;
    background: transparent;
    color: #fff;
    table-layout: auto;
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="tabela-bg">
                <h2 class="title has-text-centered has-text-link-light">Lista de Disciplinas</h2>
                <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
                    <a href="?rota=disciplinas_criar" class="button is-primary is-small">
                        <span class="icon"><i class="fas fa-plus"></i></span>
                        <span>Nova Disciplina</span>
                    </a>
                </div>
                <div>
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Criada em</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($disciplinas)): ?>
                                <?php foreach ($disciplinas as $disciplina): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($disciplina['id_disciplina']) ?></td>
                                        <td><?= htmlspecialchars($disciplina['nome_disciplina']) ?></td>
                                        <td><?= htmlspecialchars($disciplina['criada_em'] ?? '') ?></td>
                                        <td>
                                            <a href="?rota=disciplinas_editar&id=<?= $disciplina['id_disciplina'] ?>" class="button is-warning is-small">
                                                <span class="icon"><i class="fas fa-edit"></i></span>
                                                <span>Editar</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="?rota=disciplinas_excluir&id=<?= $disciplina['id_disciplina'] ?>" class="button is-danger is-small" onclick="return confirm('Tem a certeza que pretende eliminar esta disciplina?')">
                                                <span class="icon"><i class="fas fa-trash"></i></span>
                                                <span>Eliminar</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="has-text-centered">Nenhuma disciplina encontrada.</td>
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