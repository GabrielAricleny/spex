<?php $paginaAtual = 'universidade'; ?>
<?php include __DIR__ . '/../../templates/cabecalho.php'; ?>
<?php include __DIR__ . '/../sidebar.php'; ?>

<style>
@media (min-width: 1024px) {
    .painel-admin-container { margin-left: 260px; max-width: 1400px; padding-right: 32px; padding-left: 32px; margin-right: auto; margin-top: 0; }
    .tabela-bg { padding: 32px 48px; }
}
@media (max-width: 1023px) {
    .painel-admin-container { margin-left: 0 !important; padding-left: 8px; padding-right: 8px; max-width: 100vw; }
    .tabela-bg { padding: 16px 4px; }
}
.tabela-bg {
    background: #23272b;
    border-radius: 12px;
    box-shadow: 0 2px 16px rgba(0,0,0,0.15);
    padding: 32px 32px;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
}
</style>

<section class="section" style="background: #23272f; min-height: 100vh; padding-top: 2rem;">
    <div class="painel-admin-container">
        <div class="painel-centralizado">
            <div class="tabela-bg">
                <h2 class="title has-text-centered has-text-link-light">Lista de Universidades</h2>
                <div style="width:100%; display:flex; justify-content:flex-end; margin-bottom:24px;">
                    <a href="?rota=universidades_criar" class="button is-primary is-small">
                        <span class="icon"><i class="fas fa-plus"></i></span>
                        <span>Nova Universidade</span>
                    </a>
                </div>
                <div>
                    <table class="table is-striped is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Abreviado</th>
                                <th>Criada em</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($universidades)): ?>
                                <?php foreach ($universidades as $universidade): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($universidade['id_universidade']) ?></td>
                                        <td><?= htmlspecialchars($universidade['nome_universidade']) ?></td>
                                        <td><?= htmlspecialchars($universidade['nome_abreviado']) ?></td>
                                        <td><?= htmlspecialchars($universidade['criada_em']) ?></td>
                                        <td>
                                            <a href="?rota=universidades_editar&id=<?= $universidade['id_universidade'] ?>" class="button is-warning is-small">
                                                <span class="icon"><i class="fas fa-edit"></i></span>
                                                <span>Editar</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="?rota=universidades_excluir&id=<?= $universidade['id_universidade'] ?>" class="button is-danger is-small" onclick="return confirm('Tem a certeza que pretende eliminar esta universidade?')">
                                                <span class="icon"><i class="fas fa-trash"></i></span>
                                                <span>Eliminar</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="has-text-centered">Nenhuma universidade encontrada.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include __DIR__ . '/../../templates/rodape.php'; ?>