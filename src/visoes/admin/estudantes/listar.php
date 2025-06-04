<?php $paginaAtual = 'estudante'; ?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>

<div class="painel-centralizado">
    <h2>Estudantes</h2>
    <a href="?rota=crud_estudante&acao=criar" class="btn btn-primary">Novo Estudante</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID Usuário</th>
                <th>Nome de Usuário</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($estudantes as $estudante): ?>
                <tr>
                    <td><?= htmlspecialchars($estudante->id_usuario) ?></td>
                    <td><?= htmlspecialchars($estudante->nome_usuario ?? '') ?></td>
                    <td><?= htmlspecialchars($estudante->email ?? '') ?></td>
                    <td><?= htmlspecialchars($estudante->telefone ?? '') ?></td>
                    <td>
                        <a href="?rota=crud_estudante&acao=editar&id=<?= $estudante->id_estudante ?>" class="btn btn-warning">Editar</a>
                        <a href="?rota=crud_estudante&acao=deletar&id=<?= $estudante->id_estudante ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>

<h2>Editar Estudante</h2>
<form method="post">
    Nome: <input type="text" name="nome" value="<?= $estudante->nome ?>"><br>
    <button type="submit">Salvar</button>
</form>