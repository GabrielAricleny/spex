<?php
$paginaCss = ['inicio'];
$paginaJs  = [];

require_once __DIR__ . '/../templates/cabecalho.php';
require_once __DIR__ . '/../../config/conexao_basedados.php'; // Inclui a função obterConexaoPDO

// --- INÍCIO: Função para contar registros ---
function obterTotal($tabela) {
    try {
        $pdo = obterConexao(); // <-- aqui!
        $stmt = $pdo->query("SELECT COUNT(*) FROM `$tabela`");
        return $stmt ? $stmt->fetchColumn() : 0;
    } catch (Exception $e) {
        return 0;
    }
}
// --- FIM: Função para contar registros ---

$resumos = [
    'nivel_acesso' => [
        'titulo' => 'Níveis de Acesso',
        'total' => obterTotal('nivel_acesso')
    ],
    'usuario' => [
        'titulo' => 'Usuários',
        'total' => obterTotal('usuario')
    ],
    'administrador' => [
        'titulo' => 'Administradores',
        'total' => obterTotal('administrador')
    ],
    'curso' => [
        'titulo' => 'Cursos',
        'total' => obterTotal('curso')
    ],
    'exame_sistema' => [
        'titulo' => 'Exames do Sistema',
        'total' => obterTotal('exame_sistema')
    ],
    'exame_sistema_realizado' => [
        'titulo' => 'Exames do Sistema Realizados',
        'total' => obterTotal('exame_sistema_realizado')
    ],
    'historico_aluno_exame_sistema' => [
        'titulo' => 'Histórico de Aluno em Exames do Sistema',
        'total' => obterTotal('historico_aluno_exame_sistema')
    ],
    'estudante' => [
        'titulo' => 'Estudantes',
        'total' => obterTotal('estudante')
    ],
    'universidade' => [
        'titulo' => 'Universidades',
        'total' => obterTotal('universidade')
    ],
    'exame_universidade' => [
        'titulo' => 'Exames de Universidade',
        'total' => obterTotal('exame_universidade')
    ],
    'disciplina' => [
        'titulo' => 'Disciplinas',
        'total' => obterTotal('disciplina')
    ],
    'disciplina_curso' => [
        'titulo' => 'Disciplinas por Curso',
        'total' => obterTotal('disciplina_curso')
    ],
    'tema' => [
        'titulo' => 'Temas',
        'total' => obterTotal('tema')
    ],
    'status_pergunta' => [
        'titulo' => 'Status das Perguntas',
        'total' => obterTotal('status_pergunta')
    ],
    'pergunta_cadastrada' => [
        'titulo' => 'Perguntas Cadastradas',
        'total' => obterTotal('pergunta_cadastrada')
    ],
    'lista_perguntas_exame_universidade' => [
        'titulo' => 'Perguntas em Exames de Universidade',
        'total' => obterTotal('lista_perguntas_exame_universidade')
    ],
    'lista_perguntas_exame_sistema' => [
        'titulo' => 'Perguntas em Exames do Sistema',
        'total' => obterTotal('lista_perguntas_exame_sistema')
    ],
    'pergunta_acertada_exame_sistema' => [
        'titulo' => 'Perguntas Acertadas em Exames do Sistema',
        'total' => obterTotal('pergunta_acertada_exame_sistema')
    ],
];
?>

<style>
body, html {
    background: #23272f !important;
}
.section {
    background: transparent !important;
}
.box {
    background: #2d323c !important;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    border: none;
}
.card {
    background: #23272f !important;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.10);
    border: none;
}
.card-content {
    color: #fff;
}
.title, .subtitle, .panel-heading, .panel-block {
    color: #fff !important;
}
.panel {
    background: #23272f !important;
    border: none;
}
.panel-block {
    border: none !important;
}
.panel-block:hover, .panel-block:focus {
    background: #2d323c !important;
}
.card-footer, .card-footer-item {
    background: #23272f !important;
    color: #6cb2eb !important;
}
.card-footer-item:hover, .card-footer-item:focus {
    background: #2d323c !important;
    color: #fff !important;
    text-decoration: underline;
}

/* Efeito hover igual ao rodapé para links do sidebar */
.sidebar-link {
    transition: color 0.2s, background 0.2s;
}
.sidebar-link:hover,
.sidebar-link:focus {
    color: #6cb2eb !important;
    background: rgba(255,255,255,0.04);
    text-decoration: underline;
}

/* Efeito hover igual ao cabeçalho para links "Gerir" dos cards */
.card-footer-item.gerir-link {
    transition: color 0.2s, background 0.2s;
}
.card-footer-item.gerir-link:hover,
.card-footer-item.gerir-link:focus {
    color: #6cb2eb !important;
    background: rgba(255,255,255,0.04);
    text-decoration: underline;
}
</style>

<section class="section" style="background: #f5f6fa; min-height: 100vh;">
    <div class="container">
        <div class="columns">
            <!-- Sidebar -->
            <aside class="column is-3">
                <nav class="panel is-link">
                    <p class="panel-heading">
                        Tabelas do Sistema
                    </p>
                    <?php foreach ($resumos as $tabela => $dados): ?>
                        <a href="?rota=crud_<?= $tabela ?>" class="panel-block">
                            <span class="panel-icon">
                                <i class="fas fa-database"></i>
                            </span>
                            <?= $dados['titulo'] ?>
                        </a>
                    <?php endforeach; ?>
                </nav>
            </aside>
            <!-- Main Content -->
            <div class="column is-9">
                <div class="box" style="border-radius: 10px;">
                    <h1 class="title is-3 has-text-link has-text-centered mb-5">Painel de Administração</h1>
                    <div class="columns is-multiline">
                        <?php foreach ($resumos as $tabela => $dados): ?>
                            <div class="column is-one-third">
                                <div class="card" style="border-radius: 8px;">
                                    <div class="card-content has-text-centered">
                                        <p class="title is-2 has-text-link"><?= $dados['total'] ?></p>
                                        <p class="subtitle is-6"><?= $dados['titulo'] ?></p>
                                    </div>
                                    <footer class="card-footer">
                                        <a href="?rota=crud_<?= $tabela ?>" class="card-footer-item has-text-link">Gerir</a>
                                    </footer>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../templates/rodape.php'; ?>
