<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>
<section class="section" style="background: #23272f; min-height: 100vh;">
    <div class="painel-admin-container">
        <div class="tabela-bg">
            <h2 class="title is-4 has-text-centered has-text-link-light">Novo Exame do Sistema (Personalizado)</h2>
            <form method="post">
                <div class="field">
                    <label class="label has-text-light">Duração</label>
                    <input type="time" name="duracao" class="input" value="01:00:00" required>
                </div>
                <div class="field">
                    <label class="label has-text-light">Cursos</label>
                    <select name="cursos[]" class="input" multiple>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?= $curso['id_curso'] ?>"><?= htmlspecialchars($curso['nome_curso']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label><input type="checkbox" name="cursos_aleatorio" value="1"> Selecionar aleatoriamente</label>
                </div>
                <div class="field">
                    <label class="label has-text-light">Disciplinas</label>
                    <select name="disciplinas[]" class="input" multiple>
                        <?php foreach ($disciplinas as $disciplina): ?>
                            <option value="<?= $disciplina['id_disciplina'] ?>"><?= htmlspecialchars($disciplina['nome_disciplina']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label><input type="checkbox" name="disciplinas_aleatorio" value="1"> Selecionar aleatoriamente</label>
                    <input type="number" name="qtd_disciplinas_aleatorias" min="0" placeholder="Qtd aleatória">
                </div>
                <div class="field">
                    <label class="label has-text-light">Temas</label>
                    <select name="temas[]" class="input" multiple>
                        <?php foreach ($temas as $tema): ?>
                            <option value="<?= $tema['id_tema'] ?>"><?= htmlspecialchars($tema['nome_tema']) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label><input type="checkbox" name="temas_aleatorio" value="1"> Selecionar aleatoriamente</label>
                    <input type="number" name="qtd_temas_aleatorios" min="0" placeholder="Qtd aleatória">
                </div>
                <div class="field">
                    <label class="label has-text-light">Perguntas aleatórias</label>
                    <input type="number" name="qtd_perguntas_aleatorias" min="0" placeholder="Qtd aleatória">
                </div>
                <div class="field is-grouped is-grouped-right mt-5">
                    <button type="submit" class="button is-success">Criar Exame</button>
                </div>
            </form>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>