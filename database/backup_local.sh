#!/bin/bash

echo
echo "==============================="
echo "Iniciando o processo de backup..."
echo "==============================="

# Diretório onde o script está localizado
SCRIPT_DIR="$(dirname "$(realpath "$0")")"

# Verifica se o arquivo .env existe
ENV_FILE="$SCRIPT_DIR/../.env"
echo "Verificando se o arquivo .env existe em: $ENV_FILE"
if [[ ! -f "$ENV_FILE" ]]; then
    echo "[ERRO] O arquivo '.env' não foi encontrado no diretório superior."
    echo "O backup não pode ser realizado sem o arquivo '.env'."
    exit 1
fi

# Carrega as variáveis do arquivo .env de forma segura (para suportar caracteres especiais)
echo "Carregando as variáveis de configuração do arquivo .env..."
set -a
source "$ENV_FILE"
set +a

# Verifica se as variáveis estão definidas corretamente
if [[ -z "$BD_SERVIDOR" ]]; then
    echo "[ERRO] A variável 'BD_SERVIDOR' não foi definida corretamente no '.env'."
    exit 1
fi

if [[ -z "$BD_USUARIO" ]]; then
    echo "[ERRO] A variável 'BD_USUARIO' não foi definida corretamente no '.env'."
    exit 1
fi

if [[ -z "$BD_SENHA" ]]; then
    echo "[ERRO] A variável 'BD_SENHA' não foi definida corretamente no '.env'."
    exit 1
fi

if [[ -z "$BD_BASEDADOS" ]]; then
    echo "[ERRO] A variável 'BD_BASEDADOS' não foi definida corretamente no '.env'."
    exit 1
fi

if [[ -z "$BD_PORTA" ]]; then
    BD_PORTA=3306
fi

# Define o diretório de backup
DIRETORIO_BACKUP="$SCRIPT_DIR/backups"
mkdir -p "$DIRETORIO_BACKUP"

# Obtém a data e a hora atual (formato: YYYY-MM-DD_HHhMMmSSs)
DATA_HORA=$(date +"%Y-%m-%d_%Hh%Mm%Ss")
NOME_ARQUIVO="backup_${DATA_HORA}.sql"
ARQUIVO_BACKUP="$DIRETORIO_BACKUP/$NOME_ARQUIVO"

# Verifica se o comando mysqldump está disponível
if ! command -v mysqldump &> /dev/null; then
    echo "[ERRO] O comando 'mysqldump' não foi encontrado no PATH. Verifique a instalação do MySQL."
    exit 1
fi

echo "DEBUG: BD_SERVIDOR=[$BD_SERVIDOR]"
echo "DEBUG: BD_PORTA=[$BD_PORTA]"
echo "DEBUG: BD_BASEDADOS=[$BD_BASEDADOS]"
echo "DEBUG: BD_USUARIO=[$BD_USUARIO]"
echo "DEBUG: BD_SENHA=[$BD_SENHA]"
echo "DEBUG: ARQUIVO_BACKUP=[$ARQUIVO_BACKUP]"

# Exibe os detalhes antes do backup
echo
echo "====================================================="
echo "Detalhes do backup:"
echo "Base de Dados: $BD_BASEDADOS"
echo "Host: $BD_SERVIDOR"
echo "Usuário: $BD_USUARIO"
echo "Porta: $BD_PORTA"
echo "Nome do Arquivo: $NOME_ARQUIVO"
echo "====================================================="

# Executa o backup e salva o erro em arquivo separado
echo "Iniciando o backup da base '$BD_BASEDADOS'..."
mysqldump --no-tablespaces -h "$BD_SERVIDOR" -P "$BD_PORTA" -u "$BD_USUARIO" -p"$BD_SENHA" "$BD_BASEDADOS" \
    > "$ARQUIVO_BACKUP" 2> "$ARQUIVO_BACKUP.err"

# Verifica se o backup foi realizado com sucesso
if [[ $? -eq 0 ]]; then
    echo "[SUCESSO] Backup realizado com sucesso!"
    echo "Arquivo salvo em: $ARQUIVO_BACKUP"
else
    echo "[ERRO] Ocorreu um erro ao realizar o backup."
    echo "Veja o erro detalhado em: $ARQUIVO_BACKUP.err"
    cat "$ARQUIVO_BACKUP.err"
fi