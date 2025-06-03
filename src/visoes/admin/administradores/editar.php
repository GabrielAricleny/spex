<h2>Editar Administrador</h2>
<form method="post">
    Nome: <input type="text" name="nome" value="<?= $administrador->nome ?>"><br>
    Email: <input type="email" name="email" value="<?= $administrador->email ?>"><br>
    Nova Senha: <input type="password" name="senha"><br>
    <button type="submit">Salvar</button>
</form>