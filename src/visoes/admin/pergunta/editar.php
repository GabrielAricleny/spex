<h2>Editar Pergunta Cadastrada</h2>
<form method="post">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($perguntaCadastrada->nome ?? '', ENT_QUOTES, 'UTF-8') ?>"><br>
    <button type="submit">Salvar</button>
</form>