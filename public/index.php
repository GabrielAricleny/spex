<?php
declare(strict_types=1);

// HABILITANDO OUTPUT DE ERROS
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

ini_set('log_errors', 1);
ini_set('error_log', '/tmp/php_errors.log');

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
use App\controladores\admin\ControladorPerguntaCadastrada;
use App\controladores\admin\ControladorListaPerguntasExameUniversidade;
use App\controladores\admin\ControladorListaPerguntasExameSistema;
use App\controladores\admin\ControladorPerguntaAcertadaExameSistema;
use App\controladores\utilizador\ControladorLoginEstudante;
use App\controladores\utilizador\ControladorEstudante as ControladorEstudanteUser;
use App\controladores\utilizador\ControladorExames;

// Instancia o roteador
$roteador = new Roteador();

// Página inicial pública
$roteador->adicionar(['GET'], 'inicio', fn() => (new ControladorInicio())->index());

// Login e sessão - administrador
$roteador->adicionar(['GET'], 'login_admin', fn() => (new ControladorLoginAdmin())->mostrarFormulario());
$roteador->adicionar(['POST'], 'autenticar_admin', fn() => (new ControladorLoginAdmin())->processarLogin());
$roteador->adicionar(['GET'], 'sair_admin', fn() => (new ControladorLoginAdmin())->terminarSessao(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'painel_admin', fn() => (new ControladorPainelAdmin())->painel(), ['autenticadoAdmin']);

// CRUDs para todas as tabelas do painel_admin.php
$roteador->adicionar(['GET', 'POST'], 'crud_nivel_acesso', fn() => (new ControladorNivelAcesso())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_usuario', fn() => (new ControladorUsuario())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_administrador', fn() => (new ControladorAdministrador())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_curso', fn() => (new ControladorCurso())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_exame_sistema', fn() => (new ControladorExameSistema())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_exame_sistema_realizado', fn() => (new ControladorExameSistemaRealizado())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_historico_aluno_exame_sistema', fn() => (new ControladorHistoricoAlunoExameSistema())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_estudante', fn() => (new ControladorEstudante())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_universidade', fn() => (new ControladorUniversidade())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_exame_universidade', fn() => (new ControladorExameUniversidade())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'listar_disciplina', fn() => (new ControladorDisciplina())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'criar_disciplina', fn() => (new ControladorDisciplina())->criar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'editar_disciplina', fn() => (new ControladorDisciplina())->editar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'excluir_disciplina', fn() => (new ControladorDisciplina())->excluir(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_disciplina_curso', fn() => (new ControladorDisciplinaCurso())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_tema', fn() => (new ControladorTema())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_status_pergunta', fn() => (new ControladorStatusPergunta())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_pergunta_cadastrada', fn() => (new ControladorPerguntaCadastrada())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_lista_perguntas_exame_universidade', fn() => (new ControladorListaPerguntasExameUniversidade())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_lista_perguntas_exame_sistema', fn() => (new ControladorListaPerguntasExameSistema())->crud(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'crud_pergunta_acertada_exame_sistema', fn() => (new ControladorPerguntaAcertadaExameSistema())->crud(), ['autenticadoAdmin']);

// Login e sessão - estudante
$roteador->adicionar(['GET'], 'login_estudante', fn() => (new ControladorLoginEstudante())->mostrarFormulario());
$roteador->adicionar(['POST'], 'autenticar_estudante', fn() => (new ControladorLoginEstudante())->processarLogin());
$roteador->adicionar(['GET'], 'sair_estudante', fn() => (new ControladorLoginEstudante())->terminarSessao(), ['autenticadoEstudante']);

// Funcionalidades do estudante
$roteador->adicionar(['GET'], 'dashboard_estudante', fn() => (new ControladorEstudanteUser())->dashboard(), ['autenticadoEstudante']);
$roteador->adicionar(['GET', 'POST'], 'cadastro_estudante', fn() => (new ControladorEstudanteUser())->cadastro());
$roteador->adicionar(['GET', 'POST'], 'registro', fn() => (new ControladorEstudanteUser())->cadastro());

// Novas rotas para disciplinas
$roteador->adicionar(['GET'], 'disciplinas_listar', fn() => (new ControladorDisciplina())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'disciplinas_criar', fn() => (new ControladorDisciplina())->criar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'disciplinas_editar', fn() => (new ControladorDisciplina())->editar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'disciplinas_excluir', fn() => (new ControladorDisciplina())->excluir(), ['autenticadoAdmin']);

// Novas rotas para universidades
$roteador->adicionar(['GET'], 'universidades_listar', fn() => (new ControladorUniversidade())->listar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'universidades_criar', fn() => (new ControladorUniversidade())->criar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'universidades_editar', fn() => (new ControladorUniversidade())->editar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET'], 'universidades_excluir', fn() => (new ControladorUniversidade())->excluir(), ['autenticadoAdmin']);

// Rota a partir da query string, por padrão 'inicio'
$rota = $_GET['rota'] ?? 'inicio';

// Despacha a rota atual
$roteador->despachar($rota);
?>
