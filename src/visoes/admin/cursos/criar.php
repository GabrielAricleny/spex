<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>

<main>
    <div class="painel-centralizado">
        <h2 class="title has-text-centered">Novo Curso</h2>
        <form method="post">
            <div class="field">
                <label class="label">Nome do Curso</label>
                <div class="control">
                    <input class="input" type="text" name="nome_curso" required value="<?= htmlspecialchars($curso->nome_curso ?? '') ?>">
                </div>
            </div>
            <div class="field">
                <label class="label">Nível</label>
                <div class="control">
                    <div class="select is-fullwidth">
                        <select name="nivel" required>
                            <option value="">Selecione o nível</option>
                            <option value="medio" <?= (isset($curso['nivel']) && $curso['nivel'] === 'medio') ? 'selected' : '' ?>>Ensino Médio</option>
                            <option value="superior" <?= (isset($curso['nivel']) && $curso['nivel'] === 'superior') ? 'selected' : '' ?>>Ensino Superior</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="field">
                <button class="button is-primary is-fullwidth" type="submit">Salvar</button>
            </div>
        </form>
        <p class="has-text-centered mt-4">
            <a href="?rota=crud_curso" class="button is-text">← Voltar</a>
        </p>
    </div>
</main>

<?php include __DIR__ . '/../../templates/rodape.php'; ?>