<?php if (!isset($resumos)) {
    require_once __DIR__ . '/../../config/conexao_basedados.php';
    function obterTotal($tabela) {
        try {
            $pdo = obterConexao();
            $stmt = $pdo->query("SELECT COUNT(*) FROM `$tabela`");
            return $stmt ? $stmt->fetchColumn() : 0;
        } catch (Exception $e) {
            return 0;
        }
    }
    $resumos = [
        'nivel_acesso' => ['titulo' => 'Níveis de Acesso', 'total' => obterTotal('nivel_acesso')],
        'usuario' => ['titulo' => 'Usuários', 'total' => obterTotal('usuario')],
        'administrador' => ['titulo' => 'Administradores', 'total' => obterTotal('administrador')],
        'estudante' => ['titulo' => 'Estudantes', 'total' => obterTotal('estudante')],
        'curso' => ['titulo' => 'Cursos', 'total' => obterTotal('curso')],
        'exame_sistema' => ['titulo' => 'Exames do Sistema', 'total' => obterTotal('exame_sistema')],
        'exame_universidade' => ['titulo' => 'Exames de Universidade', 'total' => obterTotal('exame_universidade')],
        'universidade' => ['titulo' => 'Universidades', 'total' => obterTotal('universidade')],
        'disciplina' => ['titulo' => 'Disciplinas', 'total' => obterTotal('disciplina')],
        'disciplina_curso' => ['titulo' => 'Disciplinas por Curso', 'total' => obterTotal('disciplina_curso')],
        'tema' => ['titulo' => 'Temas', 'total' => obterTotal('tema')],
        'status_pergunta' => ['titulo' => 'Status das Perguntas', 'total' => obterTotal('status_pergunta')],
        'pergunta' => ['titulo' => 'Perguntas', 'total' => obterTotal('pergunta')],
        'lista_perguntas_exame_universidade' => ['titulo' => 'Perguntas em Exames de Universidade', 'total' => obterTotal('lista_perguntas_exame_universidade')],
        'lista_perguntas_exame_sistema' => ['titulo' => 'Perguntas em Exames do Sistema', 'total' => obterTotal('lista_perguntas_exame_sistema')],
        'historico_aluno' => ['titulo' => 'Histórico de Aluno', 'total' => obterTotal('historico_aluno')],
        'exame_sistema_realizado' => ['titulo' => 'Exames do Sistema Realizados', 'total' => obterTotal('exame_sistema_realizado')],
        'exame_universidade_realizado' => ['titulo' => 'Exames de Universidade Realizados', 'total' => obterTotal('exame_universidade_realizado')],
        'resultado_exame' => ['titulo' => 'Resultados de Exames', 'total' => obterTotal('resultado_exame')],
        'pergunta_acertada_exame_sistema' => ['titulo' => 'Perguntas Acertadas em Exames do Sistema', 'total' => obterTotal('pergunta_acertada_exame_sistema')],
    ];
} ?>
<style>
.sidebar-fixo {
    position: fixed;
    top: 100px; /* Aumente este valor para descer mais o sidebar */
    left: 0.5rem;
    height: calc(100vh - 80px); /* Ajuste igual ao top */
    width: 260px;
    z-index: 100;
    background: #23272f !important;
    border-right: 1px solid #23272b;
    overflow-y: auto;
    margin: 0;
    padding-top: 0;
    scrollbar-width: thin;
}
.sidebar-fixo .panel {
    background: transparent !important;
    border: none;
    margin-bottom: 0;
}
.sidebar-fixo .voltar-admin {
    background: #23272f !important;
    color: #6cb2eb !important;
    font-weight: bold;
    border-top: 1px solid #2d323c;
    border-radius: 0 0 8px 8px;
    letter-spacing: 0.5px;
    transition: color 0.2s, background 0.2s;
}
.sidebar-fixo .voltar-admin:hover,
.sidebar-fixo .voltar-admin:focus {
    color: #fff !important;
    background: #3273dc !important;
    text-decoration: none;
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
body, html {
    min-height: 100vh;
}
</style>
<div class="sidebar-fixo" id="sidebar">
    <nav class="panel is-dark is-fullwidth mb-4">
        <p class="panel-heading is-hidden-mobile">
            Tabelas do Sistema
        </p>
        <?php
        // Rotas específicas para cada tabela, igual ao painel_admin.php
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
        foreach ($resumos as $tabela => $dados): 
            $rota = $rotas[$tabela] ?? 'crud_' . $tabela;
        ?>
            <a href="?rota=<?= $rota ?>" class="panel-block">
                <span class="panel-icon">
                    <i class="fas fa-database"></i>
                </span>
                <?= $dados['titulo'] ?>
            </a>
        <?php endforeach; ?>
        <a href="?rota=painel_admin" class="panel-block voltar-admin" style="border-top:1px solid #444;">
            <span class="panel-icon">
                <i class="fas fa-arrow-left"></i>
            </span>
            Voltar ao Painel Admin
        </a>
    </nav>
</div></a>