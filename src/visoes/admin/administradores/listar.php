<h2>Lista de Administradores</h2>
<a href="?rota=crud_administrador&acao=criar">Novo Administrador</a>
<table>
    <tr>
        <th>ID</th><th>Nome</th><th>Email</th><th>Ações</th>
    </tr>
    <?php foreach ($administradores as $administrador): ?>
    <tr>
        <td><?= $administrador->id ?></td>
        <td><?= $administrador->nome ?></td>
        <td><?= $administrador->email ?></td>
        <td>
            <a href="?rota=crud_administrador&acao=editar&id=<?= $administrador->id ?>">Editar</a>
            <a href="?rota=crud_administrador&acao=deletar&id=<?= $administrador->id ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>