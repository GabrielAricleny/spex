<?php
// ...busca os cursos do banco...
$cursos = App\Modelos\Curso::todos();

include __DIR__ . '/../../templates/cabecalho.php';
?>

<main>
    <div class="painel-centralizado">
        <h2>Cursos</h2>
        <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
            <a href="?rota=crud_curso&acao=criar" class="btn btn-primary">Novo Curso</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th colspan="2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursos as $curso): ?>
                    <tr>
                        <td><?= htmlspecialchars($curso['id_curso'] ?? '') ?></td>
                        <td><?= htmlspecialchars($curso['nome'] ?? '') ?></td>
                        <td class="acoes-tabela">
                            <a href="?rota=crud_curso&acao=editar&id=<?= $curso['id_curso'] ?? '' ?>" class="btn btn-warning">Editar</a>
                            <a href="?rota=crud_curso&acao=deletar&id=<?= $curso['id_curso'] ?? '' ?>" class="btn btn-danger" onclick="return confirm('Tem certeza?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>
 