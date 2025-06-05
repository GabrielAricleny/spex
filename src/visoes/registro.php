<?php include __DIR__ . '/templates/cabecalho.php'; ?>

<main>
    <div class="painel-centralizado">
        <h2>Criar Conta</h2>
        <form method="post">
            <div class="field">
                <label class="label">Nome</label>
                <div class="control">
                    <input class="input" type="text" name="nome" required>
                </div>
            </div>
            <div class="field">
                <label class="label">E-mail</label>
                <div class="control">
                    <input class="input" type="email" name="email" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Senha</label>
                <div class="control">
                    <input class="input" type="password" name="senha" required>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Criar Conta</button>
        </form>
    </div>
</main>

<?php include __DIR__ . '/templates/rodape.php'; ?>