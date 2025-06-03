<h2>Editar Pergunta Acertada em Exame do Sistema</h2>
<form method="post">
    Nome: <input type="text" name="nome" value="<?= htmlspecialchars($perguntaAcertadaExameSistema->nome ?? '', ENT_QUOTES, 'UTF-8') ?>"><br>
    <button type="submit">Salvar</button>
</form>