<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>

<style>
.painel-centralizado {
    background: #23272b;
    border-radius: 8px;
    padding: 32px 24px;
    max-width: 1600px;
    margin: 32px 32px 32px 32px; /* 32px em todos os lados */
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
}
@media (max-width: 1200px) {
    .painel-centralizado {
        padding-left: 8px;
        padding-right: 8px;
        min-width: unset;
        margin: 8px;
    }
}
.table.is-striped.is-hoverable.is-fullwidth {
    min-width: 1300px;
}
.table.is-striped.is-hoverable {
    width: 100%;
    min-width: 1300px;
    background: #23272b;
    border-radius: 6px;
    overflow: hidden;
    color: #f8f9fa;
}
.table.is-striped.is-hoverable th,
.table.is-striped.is-hoverable td {
    color: #f8f9fa;
    background: #23272b;
}
.table.is-striped.is-hoverable tr:nth-child(even) td {
    background: #2c3136;
}
h2, .title.has-text-centered {
    color: #f8f9fa;
}
</style>

<main>
    <div class="painel-centralizado">
        <h2 class="title has-text-centered">Lista de Cursos</h2>
        <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
            <a href="?rota=crud_curso&acao=criar" class="button is-primary is-small">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span>Novo Curso</span>
            </a>
        </div>
        <table class="table is-striped is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Nome do Curso</th>
                    <th>Nível</th>
                    <th style="width: 90px;">Editar</th>
                    <th style="width: 90px;">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cursos as $curso): ?>
                    <tr>
                        <td style="width: 80px;"><?= htmlspecialchars($curso['id_curso'] ?? '') ?></td>
                        <td><?= htmlspecialchars($curso['nome_curso'] ?? '') ?></td>
                        <td>
                            <?php
                                if (!empty($curso['nivel_curso'])) {
                                    echo $curso['nivel_curso'] === 'medio' ? 'Ensino Médio' : 'Ensino Superior';
                                } else {
                                    echo '';
                                }
                            ?>
                        </td>
                        <td>
                            <a href="?rota=crud_curso&acao=editar&id=<?= $curso['id_curso'] ?>" class="button is-warning is-small">
                                <span class="icon"><i class="fas fa-edit"></i></span>
                                <span>Editar</span>
                            </a>
                        </td>
                        <td>
                            <a href="?rota=crud_curso&acao=eliminar&id=<?= $curso['id_curso'] ?>" class="button is-danger is-small" onclick="return confirm('Tem a certeza que pretende eliminar este curso?')">
                                <span class="icon"><i class="fas fa-trash"></i></span>
                                <span>Eliminar</span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include __DIR__ . '/../../templates/rodape.php'; ?>