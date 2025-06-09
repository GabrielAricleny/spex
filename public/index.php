<?php
declare(strict_types=1);

// HABILITANDO OUTPUT DE ERROS
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', '/tmp/php_errors.log');

// Configurações de sessão
ini_set('session.cookie_path', '/');

// Inicia sessão se ainda não estiver iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Carregadores e autoload
require_once __DIR__ . '/../src/config/carregador_ambiente.php';
require_once __DIR__ . '/../src/config/autoload.php';

use App\config\Roteador;
use App\controladores\ControladorInicio;
use App\controladores\admin\ControladorLoginAdmin;
use App\controladores\admin\ControladorPainelAdmin;
use App\controladores\admin\ControladorNivelAcesso;
use App\controladores\admin\ControladorUsuario;
use App\controladores\admin\ControladorAdministrador;
use App\controladores\admin\ControladorCurso;
use App\controladores\admin\ControladorExameSistema;
use App\controladores\admin\ControladorExameSistemaRealizado;
use App\controladores\admin\ControladorHistoricoAlunoExameSistema;
use App\controladores\admin\ControladorEstudante;
use App\controladores\admin\ControladorUniversidade;
use App\controladores\admin\ControladorExameUniversidade;
use App\controladores\admin\ControladorDisciplina;
use App\controladores\admin\ControladorDisciplinaCurso;
use App\controladores\admin\ControladorTema;
use App\controladores\admin\ControladorStatusPergunta;
use App\controladores\admin\ControladorListaPerguntasExameUniversidade;
use App\controladores\admin\ControladorListaPerguntasExameSistema;
use App\controladores\admin\ControladorPerguntaAcertadaExameSistema;
use App\controladores\admin\ControladorPergunta;
use App\controladores\utilizador\ControladorLoginEstudante;
use App\controladores\utilizador\ControladorEstudante as ControladorEstudanteUser;
use App\controladores\utilizador\ControladorExames;

// Instancia o roteador
$roteador = new Roteador();

// Página inicial pública
$roteador->adicionar(['GET'], 'inicio', fn() => (new ControladorInicio())->index());

// ==================== ADMINISTRADOR ====================
$roteador->adicionar(['GET'], 'login_admin', fn() => (new ControladorLoginAdmin())->mostrarFormulario());
$roteador->adicionar(['POST'], 'autenticar_admin', fn() => (new ControladorLoginAdmin())->processarLogin());
$roteador->adicionar(['GET'], 'sair_admin', fn() => (new ControladorLoginAdmin())->terminarSessao(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'painel_admin', fn() => (new ControladorPainelAdmin())->painel(), ['autenticadoAdmin']);

// ==================================================
// CRUDs principais do painel admin
// ==================================================
// ==================== USUARIOS ====================
$roteador->adicionar(['GET', 'POST'], 'crud_usuario', fn() => (new ControladorUsuario())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_administrador', fn() => (new ControladorAdministrador())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_estudante', fn() => (new ControladorEstudante())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_curso', fn() => (new ControladorCurso())->crud(), ['autenticadoAdmin']);

// ==================== NIVEIS DE ACESSO ====================
$roteador->adicionar(['GET'], 'nivel_acesso_index', fn() => (new ControladorNivelAcesso())->index());
$roteador->adicionar(['GET', 'POST'], 'nivel_acesso_criar', fn() => (new ControladorNivelAcesso())->criar());
$roteador->adicionar(['GET', 'POST'], 'nivel_acesso_editar', fn() => (new ControladorNivelAcesso())->editar($_GET['id'] ?? null));
$roteador->adicionar(['GET'], 'nivel_acesso_eliminar', fn() => (new ControladorNivelAcesso())->eliminar(isset($_GET['id']) ? (int)$_GET['id'] : null));

// ==================== DISCIPLINAS ====================
$roteador->adicionar(['GET'], 'disciplinas_listar', fn() => (new ControladorDisciplina())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'disciplinas_criar', fn() => (new ControladorDisciplina())->criar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'disciplinas_editar', fn() => (new ControladorDisciplina())->editar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'disciplinas_excluir', fn() => (new ControladorDisciplina())->excluir(), ['autenticadoAdmin']);

// ==================== UNIVERSIDADES ====================
$roteador->adicionar(['GET'], 'universidades_listar', fn() => (new ControladorUniversidade())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'universidades_criar', fn() => (new ControladorUniversidade())->criar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'universidades_editar', fn() => (new ControladorUniversidade())->editar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'universidades_excluir', fn() => (new ControladorUniversidade())->excluir(), ['autenticadoAdmin']);

// ==================== STATUS PERGUNTA ====================
$roteador->adicionar(['GET'], 'status_pergunta_listar', fn() => (new ControladorStatusPergunta())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'status_pergunta_criar', fn() => (new ControladorStatusPergunta())->criar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'status_pergunta_editar', fn() => (new ControladorStatusPergunta())->editar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'status_pergunta_excluir', fn() => (new ControladorStatusPergunta())->excluir(), ['autenticadoAdmin']);

// ==================== ESTUDANTE ====================
$roteador->adicionar(['GET'], 'login_estudante', fn() => (new ControladorLoginEstudante())->mostrarFormulario());
$roteador->adicionar(['POST'], 'autenticar_estudante', fn() => (new ControladorLoginEstudante())->processarLogin());
$roteador->adicionar(['GET'], 'sair_estudante', fn() => (new ControladorLoginEstudante())->terminarSessao(), ['autenticadoEstudante']);
$roteador->adicionar(['GET'], 'dashboard_estudante', fn() => (new ControladorEstudanteUser())->dashboard(), ['autenticadoEstudante']);
$roteador->adicionar(['GET', 'POST'], 'cadastro_estudante', fn() => (new ControladorEstudanteUser())->cadastro());
$roteador->adicionar(['GET', 'POST'], 'registro', fn() => (new ControladorEstudanteUser())->cadastro());

// === PERFIL DO ESTUDANTE ===
$roteador->adicionar(['GET', 'POST'], 'meu_perfil', fn() => (new \App\controladores\utilizador\ControladorPerfilEstudante())->editar(), ['autenticadoEstudante']);

// ==================== TEMA ====================
$roteador->adicionar(['GET'], 'tema_listar', fn() => (new ControladorTema())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'tema_criar', fn() => (new ControladorTema())->criar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'tema_editar', fn() => (new ControladorTema())->editar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'tema_excluir', fn() => (new ControladorTema())->excluir(), ['autenticadoAdmin']);

// ==================== PERGUNTA ====================
$roteador->adicionar(['GET'], 'pergunta_listar', fn() => (new ControladorPergunta())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'pergunta_criar', fn() => (new ControladorPergunta())->criar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'pergunta_editar', fn() => (new ControladorPergunta())->editar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'pergunta_excluir', fn() => (new ControladorPergunta())->excluir(), ['autenticadoAdmin']);

// ==================== DISCIPLINA_CURSO ====================
$roteador->adicionar(['GET'], 'disciplina_curso_listar', fn() => (new ControladorDisciplinaCurso())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'disciplina_curso_criar', fn() => (new ControladorDisciplinaCurso())->criar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'disciplina_curso_editar', fn() => (new ControladorDisciplinaCurso())->editar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'disciplina_curso_excluir', fn() => (new ControladorDisciplinaCurso())->excluir(), ['autenticadoAdmin']);

// ==================== EXAME SISTEMA ====================
$roteador->adicionar(['GET'], 'exame_sistema_listar', fn() => (new ControladorExameSistema())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'exame_sistema_editar', fn() => (new ControladorExameSistema())->editar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'exame_sistema_excluir', fn() => (new ControladorExameSistema())->excluir(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'exame_sistema_criar', fn() => (new ControladorExameSistema())->criar(), ['autenticadoAdmin']);

// ==================== EXAME UNIVERSIDADE ====================
//$roteador->adicionar(['GET'], 'exame_universidade_listar', fn() => (new ControladorExameUniversidade())->listar(), ['autenticadoAdmin']);
//$roteador->adicionar(['GET', 'POST'], 'exame_universidade_editar', fn() => (new ControladorExameUniversidade())->editar(), ['autenticadoAdmin']);
//$roteador->adicionar(['GET', 'POST'], 'exame_universidade_excluir', fn() => (new ControladorExameUniversidade())->excluir(), ['autenticadoAdmin']);
//$roteador->adicionar(['GET', 'POST'], 'exame_universidade_criar', fn() => (new ControladorExameUniversidade())->criar(), ['autenticadoAdmin']);

// ==================== LISTA PERGUNTAS EXAME SISTEMA ====================
$roteador->adicionar(['GET'], 'lista_perguntas_exame_sistema_listar', fn() => (new ControladorListaPerguntasExameSistema())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'lista_perguntas_exame_sistema_criar', fn() => (new ControladorListaPerguntasExameSistema())->criar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'lista_perguntas_exame_sistema_editar', fn() => (new ControladorListaPerguntasExameSistema())->editar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'lista_perguntas_exame_sistema_excluir', fn() => (new ControladorListaPerguntasExameSistema())->excluir(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'lista_perguntas_exame_sistema_criar_aleatorio', fn() => (new ControladorListaPerguntasExameSistema())->criar_aleatorio(), ['autenticadoAdmin']);

// ==================== LISTA PERGUNTAS EXAME UNIVERSIDADE ====================
//$roteador->adicionar(['GET'], 'lista_perguntas_exame_universidade_listar', fn() => (new ControladorListaPerguntasExameUniversidade())->listar(), ['autenticadoAdmin']);
// ...adicione as rotas de criar, editar, excluir se necessário...

// ==================== ROTEAMENTO ====================
$rota = $_GET['rota'] ?? 'inicio';
$roteador->despachar($rota);
?>
