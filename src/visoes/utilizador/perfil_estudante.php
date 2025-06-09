<?php
//if (session_status() === PHP_SESSION_NONE) {
//    session_start();
//}
$paginaCss = 'perfil';
require_once __DIR__ . '/../templates/cabecalho.php';
?>

<section class="section">
    <div class="container">
        <h1 class="title">Meu Perfil</h1>
        <?php if (!empty($_GET['sucesso'])): ?>
            <div class="notification is-success">Perfil atualizado com sucesso!</div>
        <?php endif; ?>
        <form method="post" style="max-width: 600px;">
            <div class="field">
                <label class="label">Nome completo</label>
                <div class="control">
                    <input class="input" type="text" name="nome_completo" value="<?= htmlspecialchars($dados['nome_completo']) ?>" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="email" name="email" value="<?= htmlspecialchars($dados['email']) ?>" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Data de nascimento</label>
                <div class="control">
                    <input class="input" type="date" name="data_nasc" value="<?= htmlspecialchars($dados['data_nasc']) ?>" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Telefone</label>
                <div class="control">
                    <input class="input" type="text" name="telefone" value="<?= htmlspecialchars($dados['telefone']) ?>" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Área de formação</label>
                <div class="control">
                    <select name="area_formacao" class="input" required>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?= $curso['id_curso'] ?>" <?= $curso['id_curso'] == $dados['area_formacao'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($curso['nome_curso']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="field">
                <label class="label">Curso pretendido</label>
                <div class="control">
                    <select name="curso_pretendido" class="input" required>
                        <?php foreach ($cursos as $curso): ?>
                            <option value="<?= $curso['id_curso'] ?>" <?= $curso['id_curso'] == $dados['curso_pretendido'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($curso['nome_curso']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-success">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php require_once __DIR__ . '/../templates/rodape.php'; ?>