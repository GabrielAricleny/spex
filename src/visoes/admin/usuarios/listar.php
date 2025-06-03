<h2>Lista de Usuários</h2>
<a href="?rota=crud_usuario&acao=criar">Novo Usuário</a>
<table>
    <tr>
        <th>ID</th><th>Nome</th><th>Email</th><th>Ações</th>
    </tr>
    <?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><?= $usuario->id ?></td>
        <td><?= $usuario->nome ?></td>
        <td><?= $usuario->email ?></td>
        <td>
            <a href="?rota=crud_usuario&acao=editar&id=<?= $usuario->id ?>">Editar</a>
            <a href="?rota=crud_usuario&acao=deletar&id=<?= $usuario->id ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<h2>Novo Usuário</h2>
<form method="post">
    Nome: <input type="text" name="nome"><br>
    Email: <input type="email" name="email"><br>
    Senha: <input type="password" name="senha"><br>
    <button type="submit">Salvar</button>
</form>