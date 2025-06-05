<?php $paginaAtual = 'nivel_acesso'; ?>
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
</style>

<main>
    <div class="painel-centralizado">
        <h2 class="title has-text-centered">Lista de Níveis de Acesso</h2>
        <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
            <a href="?rota=crud_nivel_acesso&acao=criar" class="button is-primary is-small">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span>Novo Nível de Acesso</span>
            </a>
        </div>
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
</main>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>
