<?php $paginaAtual = 'usuario'; ?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>

<div class="painel-centralizado">
    <h2>Usuários</h2>
    <a href="?rota=crud_usuario&acao=criar" class="btn btn-primary">Novo Usuário</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome de Usuário</th>
                <th>Email</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario->id_usuario) ?></td>
                    <td><?= htmlspecialchars($usuario->nome_usuario) ?></td>
                    <td><?= htmlspecialchars($usuario->email) ?></td>
                    <td>
                        <a href="?rota=crud_usuario&acao=editar&id=<?= $usuario->id_usuario ?>" class="btn btn-warning">Editar</a>
                    </td>
                    <td>
                        <a href="?rota=crud_usuario&acao=deletar&id=<?= $usuario->id_usuario ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>