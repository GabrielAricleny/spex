<?php $paginaAtual = 'administrador'; ?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>

<div class="painel-centralizado">
    <h2>Administradores</h2>
    <a href="?rota=crud_administrador&acao=criar" class="btn btn-primary">Novo Administrador</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID Usuário</th>
                <th>Usuário</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($admins as $admin): ?>
                <tr>
                    <td><?= htmlspecialchars($admin->id_usuario) ?></td>
                    <td><?= htmlspecialchars($admin->nome_usuario ?? '') ?></td>
                    <td><?= htmlspecialchars($admin->email ?? '') ?></td>
                    <td><?= htmlspecialchars($admin->telefone ?? '') ?></td>
                    <td>
                        <a href="?rota=crud_administrador&acao=editar&id=<?= $admin->id_administrador ?>" class="btn btn-warning">Editar</a>
                    </td>
                    <td>
                        <a href="?rota=crud_administrador&acao=deletar&id=<?= $admin->id_administrador ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>