<?php $paginaAtual = 'nivel_acesso'; ?>
<?php
include __DIR__ . '/../../templates/cabecalho.php';
?>

<style>
body {
    background-color: #23272b;
    color: #f8f9fa;
}
.painel-centralizado {
    max-width: 800px;
    margin: 40px auto;
    background: #343a40;
    padding: 32px 24px;
    border-radius: 12px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.2);
}
.table {
    background: #23272b;
    color: #f8f9fa;
}
.table th, .table td {
    border-color: #444;
    color: #fff !important; /* <-- Adicione esta linha aqui */
}
a.btn {
    margin-right: 4px;
}
</style>

<div class="painel-centralizado">
    <h2>Níveis de Acesso</h2>
    <a href="?rota=crud_nivel_acesso&acao=criar" class="btn btn-primary">Novo Nível de Acesso</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($niveis as $nivel): ?>
                <tr>
                    <td><?= htmlspecialchars($nivel['id_nivel']) ?></td>
                    <td><?= htmlspecialchars($nivel['descricao'] ?? '') ?></td>
                    <td>
                        <a href="?rota=crud_nivel_acesso&acao=editar&id=<?= $nivel['id_nivel'] ?>" class="btn btn-warning">Editar</a>
                        <a href="?rota=crud_nivel_acesso&acao=eliminar&id=<?= $nivel['id_nivel'] ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/../../templates/rodape.php'; ?>
