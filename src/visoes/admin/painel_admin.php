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

<div class="columns is-gapless" style="min-height: 100vh; background-color: #181a1b;">
    <!-- Menu lateral -->
    <aside class="column is-3" style="background-color: #23272b; box-shadow: 2px 0 8px rgba(0,0,0,0.15);">
        <div class="p-5">
            <h2 class="title is-5 has-text-white mb-4">Tabelas da Base de Dados:</h2>
            <ul>
                <?php foreach ($resumos as $tabela => $dados): ?>
                    <li class="mb-3">
                        <a href="?rota=crud_<?= $tabela ?>" class="has-text-white is-size-6 sidebar-link">
                            <i class="fas fa-angle-right"></i> <?= $dados['titulo'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </aside>

    <!-- Conteúdo principal -->
    <main class="column p-6" style="background-color: #181a1b; padding-bottom: 3rem; border-bottom: none; box-shadow: none;">
        <h1 class="title has-text-white mb-5 has-text-centered">Painel de Administração</h1>
        <div class="columns is-multiline" style="margin-left: 0.5rem; margin-right: 0.5rem; padding-bottom: 2.5rem; border-bottom: none; box-shadow: none;">
            <?php foreach ($resumos as $tabela => $dados): ?>
                <div class="column is-one-quarter is-flex" style="padding-left: 0.75rem; padding-right: 0.75rem; display: flex;">
                    <div class="card is-flex is-flex-direction-column" style="background-color: #23272b; color: #fff; width: 100%; min-height: 200px; flex: 1 1 auto; display: flex;">
                        <div class="card-content has-text-centered" style="flex: 1 1 auto;">
                            <p class="title is-4 has-text-white"><?= $dados['total'] ?></p>
                            <p class="subtitle is-6 has-text-grey-light"><?= $dados['titulo'] ?></p>
                        </div>
                        <footer class="card-footer" style="margin-top: auto; background-color: #23272b;">
                            <a href="?rota=crud_<?= $tabela ?>" class="card-footer-item gerir-link" style="color: #6cb2eb;">Gerir</a>
                        </footer>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php require_once __DIR__ . '/../templates/rodape.php'; ?>
