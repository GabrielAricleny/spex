<h2>Editar Tema</h2>
<form method="post">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($tema->nome ?? '', ENT_QUOTES, 'UTF-8') ?>"><br>
    <button type="submit">Salvar</button>
</form>