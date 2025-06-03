<h2>Editar Lista de Perguntas do Exame do Sistema</h2>
<form method="post">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($listaPerguntasExameSistema->nome ?? '', ENT_QUOTES, 'UTF-8') ?>"><br>
    <button type="submit">Salvar</button>
</form>