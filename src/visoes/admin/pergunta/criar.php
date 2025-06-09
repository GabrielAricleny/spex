<?php
$paginaAtual = 'pergunta';
// Proteção: só admins podem acessar
include __DIR__ . '/../protecao_admin.php';
include __DIR__ . '/../../templates/cabecalho.php';
include __DIR__ . '/../sidebar.php'; 
?>

<style>
.painel-admin-container {
    margin-left: 250px;
    transition: margin-left 0.3s;
}
@media (max-width: 1024px) {
    .painel-admin-container {
        margin-left: 0 !important;
    }
}
.tabela-bg {
    background: #2d323c;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.form-label {
    color: #bfc9da;
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="tabela-bg">
                <h2 class="title has-text-centered has-text-link-light mb-5">Nova Pergunta</h2>
                <form method="post" style="max-width: 600px; margin: 0 auto;">
                    <div class="field">
                        <label class="label form-label">Enunciado</label>
                        <div class="control">
                            <textarea class="textarea" name="enunciado" required style="background:#23272f; color:#fff; border:none;"></textarea>
                        </div>
                    </div>
                    <div class="columns is-multiline">
                        <div class="column is-half">
                            <div class="field">
                                <label class="label form-label">Curso</label>
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="curso" required>
                                            <option value="">Selecione...</option>
                                            <?php foreach ($cursos as $curso): ?>
                                                <?php if (
                                                    isset($curso['nivel_curso']) && strtolower($curso['nivel_curso']) === 'superior'
                                                    || isset($curso['nivel_curso']) && strtolower($curso['nivel_curso']) === 'superior'
                                                ): ?>
                                                    <option value="<?= $curso['id_curso'] ?>"><?= htmlspecialchars($curso['nome_curso']) ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-half">
                            <div class="field">
                                <label class="label form-label">Disciplina</label>
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="disciplina" required>
                                            <option value="">Selecione...</option>
                                            <?php foreach ($disciplinas as $disciplina): ?>
                                                <option value="<?= $disciplina['id_disciplina'] ?>"><?= htmlspecialchars($disciplina['nome_disciplina']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-half">
                            <div class="field">
                                <label class="label form-label">Tema</label>
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="tema" required>
                                            <option value="">Selecione...</option>
                                            <?php foreach ($temas as $tema): ?>
                                                <option value="<?= $tema['id_tema'] ?>"><?= htmlspecialchars($tema['nome_tema']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="column is-half">
                            <div class="field">
                                <label class="label form-label">Status</label>
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="status" required>
                                            <option value="">Selecione...</option>
                                            <?php foreach ($status as $s): ?>
                                                <option value="<?= $s['id_status'] ?>"><?= htmlspecialchars($s['descricao_status']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label form-label">Resposta</label>
                        <div class="control">
                            <input class="input" type="text" name="resposta" required style="background:#23272f; color:#fff; border:none;">
                        </div>
                    </div>
                    <div class="field is-grouped is-grouped-right mt-5">
                        <div class="control">
                            <button type="submit" class="button is-success">
                                <span class="icon"><i class="fas fa-check"></i></span>
                                <span>Salvar</span>
                            </button>
                        </div>
                        <div class="control">
                            <a href="?rota=pergunta_listar" class="button is-light">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>