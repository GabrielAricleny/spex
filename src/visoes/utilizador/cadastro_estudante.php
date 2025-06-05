<?php
$paginaJs = ['particulas'];
require_once __DIR__ . '/../templates/cabecalho.php';
?>

<section class="hero is-fullheight-with-navbar" style="background: #181a1b; position:relative;">
    <div class="particulas"></div>
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-5">
                    <div class="box">
                        <h1 class="title has-text-centered">Criar Conta</h1>
                        <p class="subtitle has-text-centered">Preencha os dados para se cadastrar</p>

                        <?php if (!empty($erro)): ?>
                            <div class="notification is-danger"><?= htmlspecialchars($erro) ?></div>
                        <?php endif; ?>
                        <?php if (!empty($sucesso)): ?>
                            <div class="notification is-success">Conta criada com sucesso!</div>
                        <?php else: ?>
                        <form method="post">
                            <div class="field">
                                <label class="label">Nome completo</label>
                                <div class="control">
                                    <input class="input" type="text" name="nome_completo" required>
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
                                <div class="control has-icons-left">
                                    <input class="input" type="email" name="email" required>
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Área de formação [Ensino Médio]</label>
                                <div class="control">
                                    <div class="select is-fullwidth">
                                        <select name="area_formacao" required>
                                            <option value="">Selecione a área/curso</option>
                                            <?php foreach ($cursos_medio as $curso): ?>
                                                <option value="<?= htmlspecialchars($curso['id_curso']) ?>">
                                                    <?= htmlspecialchars($curso['nome_curso']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Curso pretendido [Ensino Superior]</label>
                                <div class="control">
                                <div class="select is-fullwidth">
                                        <select name="curso_pretendido" required>
                                            <option value="">Selecione o curso</option>
                                            <?php foreach ($cursos_superior as $curso): ?>
                                                <option value="<?= htmlspecialchars($curso['id_curso']) ?>">
                                                    <?= htmlspecialchars($curso['nome_curso']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
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
                                <div class="control has-icons-left">
                                    <input class="input" type="password" name="senha_estudante" required>
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <button class="button is-fullwidth is-primary" type="submit">Criar Conta</button>
                            </div>
                        </form>
                        <?php endif; ?>

                        <p class="has-text-centered mt-4">
                            <a href="?rota=inicio" class="has-text-grey-dark">← Voltar ao início</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../templates/rodape.php'; ?>