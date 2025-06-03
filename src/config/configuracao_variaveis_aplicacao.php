<?php
require_once __DIR__ . '/carregador_ambiente.php';

define('BD_SERVIDOR', getenv('BD_SERVIDOR')); 

define('BD_PORTA', getenv('BD_PORTA') ?: '3306');
define('BD_BASEDADOS', getenv('BD_BASEDADOS'));
define('BD_USUARIO', getenv('BD_USUARIO'));
define('BD_SENHA', getenv('BD_SENHA'));

define('APP_NOME', getenv('APP_NAME'));
define('APP_AMBIENTE', getenv('APP_ENV'));
define('APP_DEPURAR', filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN));
define('APP_URL', getenv('APP_URL'));

define('EMAIL_SERVIDOR', getenv('MAIL_HOST'));
define('EMAIL_PORTA', getenv('MAIL_PORT'));
define('EMAIL_USUARIO', getenv('MAIL_USERNAME'));
define('EMAIL_SENHA', getenv('MAIL_PASSWORD'));
define('EMAIL_CRIPTOGRAFIA', getenv('MAIL_ENCRYPTION'));

define('DURACAO_SESSAO', getenv('SESSION_LIFETIME') ?: 120);
