<h2 class="title is-3">Criar Conta de Estudante</h2>

<?php if (!empty($erro)): ?>
    <div class="notification is-danger"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<?php if (!empty($sucesso)): ?>
    <div class="notification is-success">
        Conta criada com sucesso! <a href="?rota=login_estudante">Clique aqui para entrar</a>
    </div>
<?php else: ?>
<form method="post" class="box" style="max-width: 500px; margin: 0 auto;">
    <div class="field">
        <label class="label">Nome completo</label>
        <div class="control">
            <input class="input" type="text" name="nome_estudante" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Data de nascimento</label>
        <div class="control">
            <input class="input" type="date" name="data_nasc" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Telefone</label>
        <div class="control">
            <input class="input" type="text" name="telefone" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Email</label>
        <div class="control">
            <input class="input" type="email" name="email" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Área de formação</label>
        <div class="control">
            <input class="input" type="text" name="area_formacao" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Curso pretendido</label>
        <div class="control">
            <input class="input" type="text" name="curso_pretendido" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Nome de usuário</label>
        <div class="control">
            <input class="input" type="text" name="nome_usuario" required>
        </div>
    </div>
    <div class="field">
        <label class="label">Senha</label>
        <div class="control">
            <input class="input" type="password" name="senha_estudante" required>
        </div>
    </div>
    <div class="field is-grouped is-grouped-centered">
        <div class="control">
            <button class="button is-success" type="submit">Criar Conta</button>
        </div>
    </div>
</form>
<?php endif; ?>