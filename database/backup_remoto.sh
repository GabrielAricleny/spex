#!/bin/bash
# filepath: /var/www/spex.edu.ao/database/backup_remoto.sh

# Configurações do banco remoto
BD_SERVIDOR="192.168.1.100"      # IP do servidor MySQL remoto
BD_PORTA="3306"
BD_BASEDADOS="db_spex"
BD_USUARIO="admin_spex"
BD_SENHA="admin.spex"

# Caminho do backup
DATA=$(date +"%Y-%m-%d_%Hh%Mm%Ss")
ARQUIVO_BACKUP="/var/www/spex.edu.ao/database/backups/backup_remoto_${DATA}.sql"

# Executa o mysqldump remoto
mysqldump -h "$BD_SERVIDOR" -P "$BD_PORTA" -u "$BD_USUARIO" -p"$BD_SENHA" "$BD_BASEDADOS" > "$ARQUIVO_BACKUP"

if [ $? -eq 0 ]; then
    echo "Backup remoto realizado com sucesso: $ARQUIVO_BACKUP"
else
    echo "Erro ao realizar backup remoto!"
fi