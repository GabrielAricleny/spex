<?php
$paginaCss = ['inicio'];
$paginaJs  = [];

// Proteção: só admins podem acessar
include __DIR__ . '/protecao_admin.php';

require_once __DIR__ . '/../templates/cabecalho.php';
require_once __DIR__ . '/../../config/conexao_basedados.php';

// --- INÍCIO: Função para contar registros ---
function obterTotal($tabela) {
    try {
        $pdo = obterConexao();
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
    'estudante' => [
        'titulo' => 'Estudantes',
        'total' => obterTotal('estudante')
    ],
    'curso' => [
        'titulo' => 'Cursos',
        'total' => obterTotal('curso')
    ],
    'exame_sistema' => [
        'titulo' => 'Exames do Sistema',
        'total' => obterTotal('exame_sistema')
    ],
    'exame_universidade' => [
        'titulo' => 'Exames de Universidade',
        'total' => obterTotal('exame_universidade')
    ],
    'universidade' => [
        'titulo' => 'Universidades',
        'total' => obterTotal('universidade')
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
    'pergunta' => [
        'titulo' => 'Perguntas',
        'total' => obterTotal('pergunta')
    ],
    'lista_perguntas_exame_universidade' => [
        'titulo' => 'Perguntas em Exames de Universidade',
        'total' => obterTotal('lista_perguntas_exame_universidade')
    ],
    'lista_perguntas_exame_sistema' => [
        'titulo' => 'Perguntas em Exames do Sistema',
        'total' => obterTotal('lista_perguntas_exame_sistema')
    ],
    'historico_aluno' => [
        'titulo' => 'Histórico de Aluno',
        'total' => obterTotal('historico_aluno')
    ],
    'exame_sistema_realizado' => [
        'titulo' => 'Exames do Sistema Realizados',
        'total' => obterTotal('exame_sistema_realizado')
    ],
    'exame_universidade_realizado' => [
        'titulo' => 'Exames de Universidade Realizados',
        'total' => obterTotal('exame_universidade_realizado')
    ],
    'resultado_exame' => [
        'titulo' => 'Resultados de Exames',
        'total' => obterTotal('resultado_exame')
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
    min-height: 180px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
.card-content {
    color: #fff;
    flex: 1 1 auto;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.card-footer {
    margin-top: auto;
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
.sidebar-link {
    transition: color 0.2s, background 0.2s;
}
.sidebar-link:hover,
.sidebar-link:focus {
    color: #6cb2eb !important;
    background: rgba(255,255,255,0.04);
    text-decoration: underline;
}
.card-footer-item.gerir-link {
    transition: color 0.2s, background 0.2s;
    background: #23272f !important;
    color: #6cb2eb !important;
    font-weight: bold;
    border-radius: 0 0 8px 8px;
    border-top: 1px solid #2d323c;
    letter-spacing: 0.5px;
}
.card-footer-item.gerir-link:hover,
.card-footer-item.gerir-link:focus {
    color: #fff !important;
    background: #3273dc !important;
    text-decoration: none;
    box-shadow: 0 2px 8px rgba(50,115,220,0.10);
}
.sidebar-fixo {
    position: fixed;
    top: 64px;
    left: 0;
    height: calc(100vh - 64px);
    width: 260px;
    z-index: 100;
    background: #23272f !important;
    border-right: 1px solid #23272b;
    overflow-y: auto;
    margin: 0;
    padding-top: 0;
    scrollbar-width: thin;
}
@media (max-width: 1023px) {
    .sidebar-fixo {
        position: static;
        width: 100%;
        height: auto;
        border-right: none;
        border-bottom: 1px solid #23272b;
        max-height: 300px;
        top: 0;
    }
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
}
@media (max-width: 1023px) {
    .painel-admin-container {
        margin-left: 0 !important;
        padding-left: 8px;
        padding-right: 8px;
        max-width: 100vw;
    }
}
</style>

<?php include __DIR__ . '/sidebar.php'; ?>

<section class="section" style="background: #f5f6fa; min-height: 100vh;">
    <div class="painel-admin-container">
        <div class="box" style="border-radius: 10px;">
            <h1 class="title is-3 has-text-link has-text-centered mb-5">Painel de Administração</h1>
            <div class="columns is-multiline">
                <?php
                // Rotas RESTful atualizadas para cada card
                $rotas = [
                    'nivel_acesso' => 'crud_nivel_acesso',
                    'usuario' => 'crud_usuario',
                    'administrador' => 'crud_administrador',
                    'estudante' => 'crud_estudante',
                    'curso' => 'crud_curso',
                    'exame_sistema' => 'exame_sistema_listar',
                    'exame_universidade' => 'exame_universidade_listar',
                    'universidade' => 'universidades_listar',
                    'disciplina' => 'disciplina_listar',
                    'disciplina_curso' => 'disciplina_curso_listar',
                    'tema' => 'tema_listar',
                    'status_pergunta' => 'status_pergunta_listar',
                    'pergunta' => 'pergunta_listar',
                    'lista_perguntas_exame_universidade' => 'lista_perguntas_exame_universidade_listar',
                    'lista_perguntas_exame_sistema' => 'lista_perguntas_exame_sistema_listar',
                    'historico_aluno' => 'historico_aluno_listar',
                    'exame_sistema_realizado' => 'exame_sistema_realizado_listar',
                    'exame_universidade_realizado' => 'exame_universidade_realizado_listar',
                    'resultado_exame' => 'resultado_exame_listar',
                    'pergunta_acertada_exame_sistema' => 'pergunta_acertada_exame_sistema_listar',
                ];
                foreach ($resumos as $tabela => $dados): ?>
                    <div class="column is-one-third">
                        <div class="card" style="border-radius: 8px;">
                            <div class="card-content has-text-centered">
                                <p class="title is-2 has-text-link"><?= $dados['total'] ?></p>
                                <p class="subtitle is-6"><?= $dados['titulo'] ?></p>
                            </div>
                            <footer class="card-footer">
                                <a href="?rota=<?= $rotas[$tabela] ?? ('crud_' . $tabela) ?>" class="card-footer-item gerir-link">Gerir</a>
                            </footer>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../templates/rodape.php'; ?>
