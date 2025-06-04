<?php $paginaAtual = 'nivel_acesso'; ?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>

<div class="painel-centralizado">
    <h2>Níveis de Acesso</h2>
    <a href="?rota=crud_nivel_acesso&acao=criar" class="btn btn-primary">Novo Nível</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($niveis as $nivel): ?>
                <tr>
                    <td><?= htmlspecialchars($nivel['id_nivel'] ?? '') ?></td>
                    <td><?= htmlspecialchars($nivel['descricao'] ?? '') ?></td>
                    <td>
                        <a href="?rota=crud_nivel_acesso&acao=editar&id=<?= $nivel['id_nivel'] ?? '' ?>" class="btn btn-warning">Editar</a>
                    </td>
                    <td>
                        <a href="?rota=crud_nivel_acesso&acao=deletar&id=<?= $nivel['id_nivel'] ?? '' ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>
