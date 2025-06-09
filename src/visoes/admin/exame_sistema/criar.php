<?php
$paginaAtual = 'exame_sistema';
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
input, select, .select select {
    background: #23272b;
    color: #f8f9fa;
    border: 1px solid #444;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 12px;
    width: 100%;
}
.select.is-multiple {
    width: 100%;
}
.select.is-multiple select {
    min-height: 90px;
}
.label {
    color: #b2becd;
    font-weight: 600;
    margin-bottom: 4px;
}
.field + .field {
    margin-top: 52px;
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
    max-width: 700px;
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
    .tabela-bg {
        padding: 16px 8px;
    }
}
.help {
    color: #b2becd;
    font-size: 0.95em;
    margin-bottom: 6px;
}
.checkbox-row {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 0;
    white-space: nowrap;
}
.checkbox-row input[type="number"] {
    min-width: 170px;
    max-width: 210px;
    width: 210px;
    margin-bottom: 0;
}
.checkbox-row span {
    white-space: nowrap;
}
@media (max-width: 600px) {
    .checkbox-row {
        flex-wrap: wrap;
        white-space: normal;
        gap: 8px;
    }
    .checkbox-row input[type="number"] {
        width: 100%;
        min-width: 0;
        max-width: 100%;
    }
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh;">
    <div class="painel-admin-container">
        <div class="tabela-bg">
            <h2 class="title is-4 has-text-centered has-text-link-light" style="margin-bottom: 2rem;">
                <span class="icon-text">
                    <span class="icon"><i class="fas fa-file-alt"></i></span>
                    <span>Novo Exame do Sistema</span>
                </span>
            </h2>
            <form method="post" style="max-width: 520px; margin: 0 auto;">
                <div class="field">
                    <label class="label">Duração</label>
                    <input type="time" name="duracao" class="input" value="01:00:00" required>
                    <p class="help">Informe a duração total do exame (horas:minutos:segundos).</p>
                </div>
                <div class="field">
                    <label class="label">Cursos</label>
                    <div class="select is-multiple is-fullwidth">
                        <select name="cursos[]" multiple id="select-cursos">
                            <?php foreach ($cursos as $curso): ?>
                                <option value="<?= $curso['id_curso'] ?>"><?= htmlspecialchars($curso['nome_curso']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <p class="help">
                        Selecione um ou mais cursos para os quais o exame será válido.<br>
                        <strong>Dica:</strong> Segure <kbd>Ctrl</kbd> (Windows) ou <kbd>Cmd</kbd> (Mac) para selecionar múltiplos cursos.
                    </p>
                    <p class="help checkbox-row">
                        <input type="checkbox" name="cursos_aleatorio" value="1" id="check-cursos-aleatorio" style="margin-bottom:0;">
                        <span>Selecionar cursos aleatoriamente</span>
                        <input type="number" name="qtd_cursos_aleatorios" min="0" placeholder="Qtd aleatória" id="input-cursos-qtd" disabled>
                    </p>
                    <p class="help">
                        Marque para o sistema escolher cursos aleatórios. Informe a quantidade desejada.
                    </p>
                </div>
                <div class="field">
                    <label class="label">Disciplinas</label>
                    <div class="select is-multiple is-fullwidth">
                        <select name="disciplinas[]" multiple id="select-disciplinas">
                            <?php foreach ($disciplinas as $disciplina): ?>
                                <option value="<?= $disciplina['id_disciplina'] ?>"><?= htmlspecialchars($disciplina['nome_disciplina']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <p class="help">
                        Selecione uma ou mais disciplinas para o exame.<br>
                        <strong>Dica:</strong> Segure <kbd>Ctrl</kbd> (Windows) ou <kbd>Cmd</kbd> (Mac) para múltipla seleção.
                    </p>
                    <p class="help checkbox-row">
                        <input type="checkbox" name="disciplinas_aleatorio" value="1" id="check-disciplinas-aleatorio" style="margin-bottom:0;">
                        <span>Selecionar disciplinas aleatoriamente</span>
                        <input type="number" name="qtd_disciplinas_aleatorias" min="0" placeholder="Qtd aleatória" id="input-disciplinas-qtd" disabled>
                    </p>
                    <p class="help">
                        Marque para o sistema escolher disciplinas aleatórias. Informe a quantidade desejada.
                    </p>
                </div>
                <div class="field">
                    <label class="label">Temas</label>
                    <div class="select is-multiple is-fullwidth">
                        <select name="temas[]" multiple id="select-temas">
                            <?php foreach ($temas as $tema): ?>
                                <option value="<?= $tema['id_tema'] ?>"><?= htmlspecialchars($tema['nome_tema']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <p class="help">
                        Selecione um ou mais temas para o exame.<br>
                        <strong>Dica:</strong> Segure <kbd>Ctrl</kbd> (Windows) ou <kbd>Cmd</kbd> (Mac) para múltipla seleção.
                    </p>
                    <p class="help checkbox-row">
                        <input type="checkbox" name="temas_aleatorio" value="1" id="check-temas-aleatorio" style="margin-bottom:0;">
                        <span>Selecionar temas aleatoriamente</span>
                        <input type="number" name="qtd_temas_aleatorias" min="0" placeholder="Qtd aleatória" id="input-temas-qtd" disabled>
                    </p>
                    <p class="help">
                        Marque para o sistema escolher temas aleatórios. Informe a quantidade desejada.
                    </p>
                </div>
                <div class="field">
                    <label class="label">Perguntas aleatórias</label>
                    <input type="number" name="qtd_perguntas_aleatorias" min="0" placeholder="Quantidade de perguntas aleatórias">
                    <p class="help">
                        Informe quantas perguntas aleatórias deseja incluir no exame. O sistema selecionará automaticamente.
                    </p>
                </div>
                <div class="field is-grouped is-grouped-right mt-5" style="display:flex; gap:8px; justify-content:flex-end;">
                    <button type="submit" class="button is-success">
                        <span class="icon"><i class="fas fa-check"></i></span>
                        <span>Criar Exame</span>
                    </button>
                    <a href="?rota=exame_sistema_listar" class="button is-light">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function toggleSelectAndInput(checkboxId, selectId, inputId) {
        const checkbox = document.getElementById(checkboxId);
        const select = document.getElementById(selectId);
        const input = document.getElementById(inputId);
        function update() {
            if (checkbox.checked) {
                select.disabled = true;
                input.disabled = false;
            } else {
                select.disabled = false;
                input.disabled = true;
                input.value = '';
            }
        }
        checkbox.addEventListener('change', update);
        update();
    }
    toggleSelectAndInput('check-cursos-aleatorio', 'select-cursos', 'input-cursos-qtd');
    toggleSelectAndInput('check-disciplinas-aleatorio', 'select-disciplinas', 'input-disciplinas-qtd');
    toggleSelectAndInput('check-temas-aleatorio', 'select-temas', 'input-temas-qtd');
});
</script>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>