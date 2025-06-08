<?php
$paginaAtual = 'usuario';
// Proteção: só admins podem acessar
include __DIR__ . '/../protecao_admin.php';
?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<style>
body, html {
    background: #23272f !important;
}
.section {
    background: transparent !important;
}
.painel-centralizado {
    background: transparent;
    border-radius: 8px;
    padding: 0;
    margin: 32px 0;
    width: 100%;
    max-width: 100%;
}
.form-bg {
    background: #23272b;
    border-radius: 12px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.15);
    padding: 32px 32px;
    width: 100%;
    max-width: 700px;
    margin: 0 auto;
    box-sizing: border-box;
    transition: padding 0.2s;
}
.form-label {
    color: #f8f9fa;
    font-weight: 600;
}
.form-control, select.form-control {
    background: #23272b;
    color: #f8f9fa;
    border: 1px solid #444;
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 16px;
    width: 100%;
}
.btn, .button {
    margin-right: 4px;
}
@media (min-width: 1024px) {
    .painel-admin-container {
        margin-left: 260px;
        max-width: 1400px;
        padding-right: 32px;
        padding-left: 32px;
        margin-right: auto;
        margin-top: 0;
    }
    .form-bg {
        padding: 32px 56px;
        max-width: 800px;
    }
}
@media (max-width: 1023px) {
    .painel-admin-container {
        margin-left: 0 !important;
        padding-left: 8px;
        padding-right: 8px;
        max-width: 100vw;
    }
    .form-bg {
        padding: 16px 4px;
        margin: 8px 0;
        max-width: 100%;
    }
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="form-bg">
                <h2 class="title has-text-centered has-text-link-light">Novo Usuário</h2>
                <?php if (!empty($erro)): ?>
                    <div class="notification is-danger"><?= htmlspecialchars($erro) ?></div>
                <?php endif; ?>
                <form method="post">
                    <label class="form-label">Nome de Usuário</label>
                    <input type="text" name="nome_usuario" class="form-control" required>

                    <label class="form-label">Nome Completo</label>
                    <input type="text" name="nome_completo" class="form-control" required>

                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>

                    <label class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" required>

                    <label class="form-label">Nível de Acesso</label>
                    <select name="id_nivel_acesso" class="form-control" required>
                        <option value="">Selecione...</option>
                        <option value="1">Administrador</option>
                        <option value="2">Estudante</option>
                        <!-- Adicione mais opções conforme necessário -->
                    </select>

                    <!-- Campos extras para estudante -->
                    <div id="campos-estudante" style="display:none;">
                        <label class="form-label">Data de Nascimento</label>
                        <input type="date" name="data_nasc" class="form-control">

                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control">

                        <label class="form-label">Área de Formação</label>
                        <select name="area_formacao" class="form-control">
                            <option value="">Selecione...</option>
                            <?php foreach ($cursos as $curso): ?>
                                <option value="<?= htmlspecialchars($curso['id_curso']) ?>">
                                    <?= htmlspecialchars($curso['nome_curso']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <label class="form-label">Curso Pretendido</label>
                        <select name="curso_pretendido" class="form-control">
                            <option value="">Selecione...</option>
                            <?php foreach ($cursos as $curso): ?>
                                <option value="<?= htmlspecialchars($curso['id_curso']) ?>">
                                    <?= htmlspecialchars($curso['nome_curso']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div style="display:flex; gap:8px; justify-content:flex-end;">
                        <button type="submit" class="button is-success">Salvar</button>
                        <a href="?rota=crud_usuario" class="button is-light">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.querySelector('select[name="id_nivel_acesso"]').addEventListener('change', function() {
    var camposEstudante = document.getElementById('campos-estudante');
    if (this.value == '2') {
        camposEstudante.style.display = '';
        // Torna os campos obrigatórios
        camposEstudante.querySelectorAll('input').forEach(function(input) {
            input.required = true;
        });
    } else {
        camposEstudante.style.display = 'none';
        camposEstudante.querySelectorAll('input').forEach(function(input) {
            input.required = false;
            input.value = '';
        });
    }
});
</script>

<?php include __DIR__ . '/../../templates/rodape.php'; ?>