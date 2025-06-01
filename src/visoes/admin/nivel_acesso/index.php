<?php require __DIR__ . '/../../templates/cabecalho.php'; ?>
<section class="section">
    <div class="container">
        <h1 class="title">Níveis de Acesso</h1>
        <a href="index.php?rota=admin_nivel_acesso_criar" class="button is-primary">Novo Nível</a>
        <table class="table is-striped is-fullwidth mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($niveis as $nivel): ?>
                    <tr>
                        <td><?= htmlspecialchars($nivel['id_nivel']) ?></td>
                        <td><?= htmlspecialchars($nivel['descricao']) ?></td>
                        <td>
                            <a href="index.php?rota=admin_nivel_acesso_editar&id=<?= $nivel['id_nivel'] ?>" class="button is-small is-info">Editar</a>
                            <a href="index.php?rota=admin_nivel_acesso_eliminar&id=<?= $nivel['id_nivel'] ?>" class="button is-small is-danger" onclick="return confirm('Eliminar este nível?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</section>
<?php require __DIR__ . '/../../templates/rodape.php'; ?>
