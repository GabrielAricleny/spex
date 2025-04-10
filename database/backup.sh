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

# Carrega as variáveis do arquivo .env
echo "Carregando as variáveis de configuração do arquivo .env..."
export $(grep -v '^#' "$ENV_FILE" | xargs)

# Verifica se as variáveis estão definidas corretamente
if [[ -z "$DB_HOST" ]]; then
    echo "[ERRO] A variável 'DB_HOST' não foi definida corretamente no '.env'."
    exit 1
fi

if [[ -z "$DB_USERNAME" ]]; then
    echo "[ERRO] A variável 'DB_USERNAME' não foi definida corretamente no '.env'."
    exit 1
fi

if [[ -z "$DB_PASSWORD" ]]; then
    echo "[ERRO] A variável 'DB_PASSWORD' não foi definida corretamente no '.env'."
    exit 1
fi

if [[ -z "$DB_DATABASE" ]]; then
    echo "[ERRO] A variável 'DB_DATABASE' não foi definida corretamente no '.env'."
    exit 1
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

# Exibe os detalhes antes do backup
echo
echo "====================================================="
echo "Detalhes do backup:"
echo "Base de Dados: $DB_DATABASE"
echo "Host: $DB_HOST"
echo "Usuário: $DB_USERNAME"
echo "Nome do Arquivo: $NOME_ARQUIVO"
echo "====================================================="

# Executa o backup e filtra o aviso de senha insegura
echo "Iniciando o backup da base '$DB_DATABASE'..."
mysqldump -h "$DB_HOST" -P "$DB_PORT" -u "$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" \
    2>&1 | grep -v "Using a password on the command line interface can be insecure." > "$ARQUIVO_BACKUP"

# Verifica se o backup foi realizado com sucesso
if [[ $? -eq 0 ]]; then
    echo "[SUCESSO] Backup realizado com sucesso!"
    echo "Arquivo salvo em: $ARQUIVO_BACKUP"
else
    echo "[ERRO] Ocorreu um erro ao realizar o backup."
fi