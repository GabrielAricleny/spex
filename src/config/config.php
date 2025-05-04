<?php
require_once __DIR__ . '/env_loader.php';

define('DB_HOST', getenv('DB_HOST'));
define('DB_DATABASE',   getenv('DB_DATABASE'));
define('DB_USERNAME',   getenv('DB_USERNAME'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));

define('APP_NAME', getenv('APP_NAME'));
define('APP_ENV', getenv('APP_ENV'));
define('APP_DEBUG', filter_var(getenv('APP_DEBUG'), FILTER_VALIDATE_BOOLEAN));
define('APP_URL', getenv('APP_URL'));

define('SESSION_LIFETIME', getenv('SESSION_LIFETIME'));