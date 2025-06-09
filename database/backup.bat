@echo off
setlocal enabledelayedexpansion

echo.
echo ===============================
echo Iniciando o processo de backup...
echo ===============================

:: Verifica se o arquivo .env existe
echo Verificando se o arquivo .env existe em: "..\.env"
if not exist "..\.env" (
    echo [ERRO] O arquivo ".env" nao foi encontrado no diretorio superior.
    echo O backup nao pode ser realizado sem o arquivo ".env".
    echo.
    pause
    exit /b
)

:: Carrega as variaveis de configuracao do arquivo .env
echo Carregando as variaveis de configuracao do arquivo ".env"...
for /f "usebackq tokens=1,* delims==" %%a in ("..\.env") do (
    set "%%a=%%b"
)

:: Verifica se as variaveis estao definidas corretamente
if "%DB_HOST%"=="" (
    echo [ERRO] A variavel "DB_HOST" nao foi definida corretamente no ".env".
    echo.
    pause
    exit /b
)

if "%DB_USERNAME%"=="" (
    echo [ERRO] A variavel "DB_USERNAME" nao foi definida corretamente no ".env".
    echo.
    pause
    exit /b
)

if "%DB_PASSWORD%"=="" (
    echo [ERRO] A variavel "DB_PASSWORD" nao foi definida corretamente no ".env".
    echo.
    pause
    exit /b
)

if "%DB_DATABASE%"=="" (
    echo [ERRO] A variavel "DB_DATABASE" nao foi definida corretamente no ".env".
    echo.
    pause
    exit /b
)

if "%DB_PORT%"=="" (
    echo [ERRO] A variavel "DB_PORT" nao foi definida corretamente no ".env".
    echo.
    pause
    exit /b
)

:: Define o diretorio de backup
set "DIRETORIO_BACKUP=.\backups"

:: Obtem a data atual (formato: YYYY-MM-DD)
echo Obtendo a data atual...
for /f "tokens=1-3 delims=/" %%a in ("%DATE%") do (
    set "DATA=%%c-%%a-%%b"
)

:: Obter a hora atual (formato: HHhMMmSSs)
for /f "tokens=1-4 delims=:.," %%a in ("%TIME%") do (
    set HORA=%%a
    set MINUTO=%%b
    set SEGUNDO=%%c
)

:: Remover espaços extras (se houver)
set HORA=!HORA: =0!
set MINUTO=!MINUTO: =0!
set SEGUNDO=!SEGUNDO: =0!

:: Preenche com zero à esquerda se necessário
if 1!HORA! lss 110 set "HORA=0!HORA!"
if 1!MINUTO! lss 110 set "MINUTO=0!MINUTO!"
if 1!SEGUNDO! lss 110 set "SEGUNDO=0!SEGUNDO!"

:: Nome do arquivo com data e hora formatada
set "NOME_ARQUIVO=backup_!DATA!_!HORA!h!MINUTO!m!SEGUNDO!s.sql"

:: Cria o diretorio de backup se nao existir
echo Verificando se o diretorio de backup existe...
if not exist "!DIRETORIO_BACKUP!" (
    echo [INFO] Diretorio nao encontrado. Criando: "!DIRETORIO_BACKUP!"...
    mkdir "!DIRETORIO_BACKUP!"
)

:: Verifica se o mysqldump esta disponivel
echo Verificando disponibilidade do "mysqldump"...
where mysqldump > nul
if %errorlevel% neq 0 (
    echo [ERRO] O comando "mysqldump" nao foi encontrado no PATH.
    echo.
    pause
    exit /b
)

:: Detalhes antes do backup
echo.
echo =====================================================
echo Detalhes do backup:
echo Base de Dados: "!DB_DATABASE!"
echo Host: "!DB_HOST!"
echo Usuario: "!DB_USERNAME!"
echo Nome do Arquivo: "!NOME_ARQUIVO!"
echo =====================================================

:: Executa o backup
echo Iniciando o backup da base "!DB_DATABASE!"...
mysqldump -h "!DB_HOST!" -P "!DB_PORT!" -u "!DB_USERNAME!" -p"!DB_PASSWORD!" "!DB_DATABASE!" 2>&1 | findstr /V /C:"Using a password on the command line interface can be insecure." > "!DIRETORIO_BACKUP!\!NOME_ARQUIVO!" 2> backup_erro.log

:: Verifica se o backup foi realizado com sucesso
if %errorlevel% equ 0 (
    echo [SUCESSO] Backup realizado com sucesso!
    echo Arquivo salvo em: "!DIRETORIO_BACKUP!\!NOME_ARQUIVO!"
    
    :: Remove arquivo de erro se estiver vazio
    for %%F in (backup_erro.log) do if %%~zF equ 0 del backup_erro.log

) else (
    echo.
    echo [ERRO] Ocorreu um erro ao realizar o backup.
    echo Verifique a mensagem de erro abaixo:
    echo.
    type backup_erro.log
)

pause