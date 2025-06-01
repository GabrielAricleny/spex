<?php
require_once __DIR__ . '/../templates/cabecalho.php';
?>

<section class="section">
    <div class="container">
        <h1 class="title has-text-centered">Cadastro de Utilizador</h1>

        <?php if (!empty($_SESSION['mensagem'])): ?>
            <div class="notification <?= $_SESSION['mensagem_tipo'] ?? 'is-info' ?>">
                <?= htmlspecialchars($_SESSION['mensagem']) ?>
            </div>
        <?php 
            unset($_SESSION['mensagem'], $_SESSION['mensagem_tipo']);
        endif; 
        ?>

        <form action="?rota=registar" method="POST" id="formCadastro">
            <div class="field">
                <label class="label">Nome Completo</label>
                <div class="control">
                    <input class="input" type="text" name="nome_estudante" required autofocus>
                </div>
            </div>

            <div class="field">
                <label class="label">Nome de Usuário</label>
                <div class="control">
                    <input class="input" type="text" name="nome_usuario" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Data de Nascimento</label>
                <div class="control">
                    <input class="input" type="date" name="data_nascimento" required max="<?= date('Y-m-d', strtotime('-10 years')) ?>">
                </div>
            </div>

            <div class="field">
                <label class="label">Telefone</label>
                <div class="control">
                    <input class="input" type="tel" name="telefone" pattern="\+?\d{9,15}" title="Número válido, com 9 a 15 dígitos" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Email</label>
                <div class="control">
                    <input class="input" type="email" name="email" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Área de Formação</label>
                <div class="control">
                    <input class="input" type="text" name="area_formacao" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Curso Pretendido</label>
                <div class="control">
                    <input class="input" type="text" name="curso_pretendido" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Senha</label>
                <div class="control">
                    <input class="input" type="password" name="senha_estudante" id="senha" minlength="6" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Confirmar Senha</label>
                <div class="control">
                    <input class="input" type="password" name="confirma_senha" id="confirma_senha" minlength="6" required>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button class="button is-primary is-fullwidth" type="submit">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
document.getElementById('formCadastro').addEventListener('submit', function(e) {
    const senha = document.getElementById('senha').value;
    const confirma = document.getElementById('confirma_senha').value;

    if (senha !== confirma) {
        e.preventDefault();
        alert('As senhas não coincidem!');
    }
});
</script>

<?php
require_once __DIR__ . '/../templates/rodape.php';
?>

