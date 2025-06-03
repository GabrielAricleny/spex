<h2>Editar Usuário</h2>
<form method="post">
    Nome: <input type="text" name="nome" value="<?= $usuario->nome ?>"><br>
    Email: <input type="email" name="email" value="<?= $usuario->email ?>"><br>
    Nova Senha: <input type="password" name="senha"><br>
    <button type="submit">Salvar</button>
</form>