<?php $paginaAtual = 'pergunta'; ?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<style>
.painel-admin-container {
    margin-left: 250px;
    transition: margin-left 0.3s;
    display: flex;
    justify-content: center;
}
@media (max-width: 1024px) {
    .painel-admin-container {
        margin-left: 0 !important;
    }
}
.painel-centralizado {
    width: 100%;
    max-width: 1200px;
    padding: 2rem 0;
    display: flex;
    justify-content: center;
}
.tabela-bg {
    background: #2d323c;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
}
.table-container {
    width: 100%;
    overflow-x: auto;
}
.table {
    min-width: 1200px;
    width: 100%;
    table-layout: auto;
}
.table th,
.table td {
    white-space: nowrap;
    padding: 0.75em 1.5em;
    vertical-align: middle;
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="tabela-bg">
                <h2 class="title has-text-centered has-text-link-light mb-5">Perguntas</h2>
                <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
                    <a href="?rota=pergunta_criar" class="button is-primary is-small">
                        <span class="icon"><i class="fas fa-plus"></i></span>
                        <span>Nova Pergunta</span>
                    </a>
                </div>
                <div class="table-container">
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th style="min-width: 60px;">ID</th>
                                <th style="min-width: 220px;">Enunciado</th>
                                <th style="min-width: 160px;">Curso</th>
                                <th style="min-width: 160px;">Resposta</th>
                                <th style="min-width: 160px;">Disciplina</th>
                                <th style="min-width: 160px;">Tema</th>
                                <th style="min-width: 120px;">Status</th>
                                <th style="min-width: 120px;">Criada em</th>
                                <th style="min-width: 90px;">Editar</th>
                                <th style="min-width: 100px;">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($perguntas)): ?>
                                <?php
                                $conexao = require __DIR__ . '/../../../config/conexao_basedados.php';
                                $cursosArr = [];
                                foreach (\App\Modelos\Curso::todos() as $c) {
                                    $cursosArr[$c['id_curso']] = $c['nome_curso'];
                                }
                                $disciplinasArr = [];
                                foreach ((new \App\Modelos\ModeloDisciplina($conexao))->listar() as $d) {
                                    $disciplinasArr[$d['id_disciplina']] = $d['nome_disciplina'];
                                }
                                $temasArr = [];
                                foreach ((new \App\Modelos\ModeloTema($conexao))->listar() as $t) {
                                    $temasArr[$t['id_tema']] = $t['nome_tema'];
                                }
                                $statusArr = [];
                                foreach ((new \App\Modelos\ModeloStatusPergunta($conexao))->listar() as $s) {
                                    $statusArr[$s['id_status']] = $s['descricao_status'];
                                }
                                ?>
                                <?php foreach ($perguntas as $pergunta): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($pergunta['id_pergunta']) ?></td>
                                        <td><?= htmlspecialchars($pergunta['enunciado']) ?></td>
                                        <td><?= htmlspecialchars($cursosArr[$pergunta['curso']] ?? $pergunta['curso']) ?></td>
                                        <td><?= htmlspecialchars($pergunta['resposta']) ?></td>
                                        <td><?= htmlspecialchars($disciplinasArr[$pergunta['disciplina']] ?? $pergunta['disciplina']) ?></td>
                                        <td><?= htmlspecialchars($temasArr[$pergunta['tema']] ?? $pergunta['tema']) ?></td>
                                        <td><?= htmlspecialchars($statusArr[$pergunta['status']] ?? $pergunta['status']) ?></td>
                                        <td><?= htmlspecialchars($pergunta['criada_em']) ?></td>
                                        <td>
                                            <a href="?rota=pergunta_editar&id=<?= $pergunta['id_pergunta'] ?>" class="button is-warning is-small">
                                                <span class="icon"><i class="fas fa-edit"></i></span>
                                                <span>Editar</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="?rota=pergunta_excluir&id=<?= $pergunta['id_pergunta'] ?>" class="button is-danger is-small" onclick="return confirm('Tem certeza?')">
                                                <span class="icon"><i class="fas fa-trash"></i></span>
                                                <span>Eliminar</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10" class="has-text-centered has-text-light">Nenhuma pergunta cadastrada.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>