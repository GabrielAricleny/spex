<h2>Lista de Cursos</h2>
<a href="?rota=crud_curso&acao=criar">Novo Curso</a>
<table>
    <tr>
        <th>ID</th><th>Nome</th><th>Ações</th>
    </tr>
    <?php foreach ($cursos as $curso): ?>
    <tr>
        <td><?= $curso->id ?></td>
        <td><?= $curso->nome ?></td>
        <td>
            <a href="?rota=crud_curso&acao=editar&id=<?= $curso->id ?>">Editar</a>
            <a href="?rota=crud_curso&acao=deletar&id=<?= $curso->id ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>