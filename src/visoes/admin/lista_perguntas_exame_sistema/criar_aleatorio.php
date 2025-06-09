<?php
$paginaAtual = 'lista_perguntas_exame_sistema';
include __DIR__ . '/../protecao_admin.php';
?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<style>
.tabela-bg {
    background: #23272b;
    border-radius: 14px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.18);
    padding: 36px 36px;
    margin-top: 24px;
    margin-bottom: 24px;
}
input, select {
    background: #23272b;
    color: #f8f9fa;
    border: 1px solid #444;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 16px;
    width: 100%;
}
.button.is-success {
    background: #00b894;
    color: #fff;
    border: none;
    font-weight: 600;
}
.button.is-success:hover {
    background: #00916e;
}
.button.is-light {
    background: #444;
    color: #fff;
    border: none;
}
.button.is-light:hover {
    background: #23272b;
}
.painel-admin-container {
    margin-left: 260px;
    max-width: 1400px;
    padding-right: 32px;
    padding-left: 32px;
    margin-right: auto;
    margin-top: 0;
}
@media (max-width: 1023px) {
    .painel-admin-container {
        margin-left: 0 !important;
        padding-left: 8px;
        padding-right: 8px;
        max-width: 100vw;
    }
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh;">
    <div class="painel-admin-container">
        <div class="tabela-bg">
            <h2 class="title is-4 has-text-centered has-text-link-light" style="margin-bottom: 2rem;">
                <span class="icon-text">
                    <span class="icon"><i class="fas fa-random"></i></span>
                    <span>Adicionar Perguntas Aleatórias ao Exame</span>
                </span>
            </h2>
            <form method="post" style="max-width: 400px; margin: 0 auto;">
                <div class="field">
                    <label class="label has-text-light">Exame</label>
                    <div class="control">
                        <select name="id_exame_sistema" class="input" required>
                            <option value="">Selecione...</option>
                            <?php foreach ($exames as $exame): ?>
                                <option value="<?= $exame['id_exame'] ?>">Exame #<?= $exame['id_exame'] ?> (<?= htmlspecialchars($exame['duracao']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-light">Curso</label>
                    <div class="control">
                        <select name="curso" class="input">
                            <option value="">Todos</option>
                            <?php foreach ($cursos as $curso): ?>
                                <?php if (isset($curso['nivel_curso']) && $curso['nivel_curso'] === 'superior'): ?>
                                    <option value="<?= $curso['id_curso'] ?>">
                                        <?= htmlspecialchars($curso['nome_curso']) ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-light">Disciplina</label>
                    <div class="control">
                        <select name="disciplina" class="input">
                            <option value="">Todas</option>
                            <?php foreach ($disciplinas as $disciplina): ?>
                                <option value="<?= $disciplina['id_disciplina'] ?>"><?= htmlspecialchars($disciplina['nome_disciplina']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-light">Tema</label>
                    <div class="control">
                        <select name="tema" class="input">
                            <option value="">Todos</option>
                            <?php foreach ($temas as $tema): ?>
                                <option value="<?= $tema['id_tema'] ?>"><?= htmlspecialchars($tema['nome_tema']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-light">Status</label>
                    <div class="control">
                        <select name="status" class="input">
                            <option value="">Todos</option>
                            <?php foreach ($status as $item): ?>
                                <option value="<?= $item['id_status'] ?>">
                                    <?= htmlspecialchars($item['descricao_status']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label class="label has-text-light">Quantidade de perguntas aleatórias</label>
                    <div class="control">
                        <input type="number" name="qtd_perguntas" min="1" class="input" required>
                    </div>
                </div>
                <div class="field is-grouped is-grouped-right mt-5" style="display:flex; gap:8px; justify-content:flex-end;">
                    <div class="control">
                        <button type="submit" class="button is-success">
                            <span class="icon"><i class="fas fa-check"></i></span>
                            <span>Adicionar</span>
                        </button>
                    </div>
                    <div class="control">
                        <a href="?rota=lista_perguntas_exame_sistema_listar" class="button is-light">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>