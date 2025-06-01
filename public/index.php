<?php
declare(strict_types=1);
use App\config\Roteador;

// HABILITANDO OUTPUT DE ERROS
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../src/config/carregador_ambiente.php';
// require_once __DIR__ . '/../src/config/configuracao_basedados.php';
require_once __DIR__ . '/../src/config/autoload.php';

use App\controladores\ControladorInicio;
use App\controladores\admin\ControladorLoginAdmin;
use App\controladores\admin\ControladorPainelAdmin;
use App\controladores\admin\ControladorNivelAcesso;
use App\controladores\utilizador\ControladorLoginEstudante;
use App\controladores\utilizador\ControladorEstudante;
use App\controladores\utilizador\ControladorExames;

$roteador = new Roteador();

// Página inicial pública
$roteador->adicionar('GET', 'inicio', fn() => (new ControladorInicio())->index());

// Login e sessão - administrador
$roteador->adicionar('GET', 'login_admin', fn() => (new ControladorLoginAdmin())->mostrarFormulario());
$roteador->adicionar('POST', 'autenticar_admin', fn() => (new ControladorLoginAdmin())->processarLogin());
$roteador->adicionar('GET', 'sair_admin', fn() => (new ControladorLoginAdmin())->terminarSessao(), ['autenticadoAdmin']);
$roteador->adicionar('GET', 'painel_admin', fn() => (new ControladorPainelAdmin())->painel(), ['autenticadoAdmin']);

// CRUD Nível de Acesso
$roteador->adicionar('GET', 'admin_nivel_acesso', fn() => (new ControladorNivelAcesso())->index(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'admin_nivel_acesso_criar', fn() => (new ControladorNivelAcesso())->criar(), ['autenticadoAdmin']);
$roteador->adicionar(['GET', 'POST'], 'admin_nivel_acesso_editar', fn() => (new ControladorNivelAcesso())->editar(), ['autenticadoAdmin']);
$roteador->adicionar('GET', 'admin_nivel_acesso_eliminar', fn() => (new ControladorNivelAcesso())->eliminar(), ['autenticadoAdmin']);

// Login e sessão - estudante
$roteador->adicionar('GET', 'login_estudante', fn() => (new ControladorLoginEstudante())->mostrarFormulario());
$roteador->adicionar('POST', 'autenticar_estudante', fn() => (new ControladorLoginEstudante())->processarLogin());
$roteador->adicionar('GET', 'sair_estudante', fn() => (new ControladorLoginEstudante())->terminarSessao(), ['autenticadoEstudante']);

// Funcionalidades do estudante
$//roteador->adicionar('GET', 'dashboard_estudante', fn() => (new ControladorEstudante())->dashboard(), ['autenticadoEstudante']);
//$roteador->adicionar('GET', 'arena_exames', fn() => (new ControladorExames())->listarExames(), ['autenticadoEstudante']);


// Rota a partir da query string, por padrão 'inicio'
$rota = $_GET['rota'] ?? 'inicio';

// Despacha a rota actual
$roteador->despachar($rota);

