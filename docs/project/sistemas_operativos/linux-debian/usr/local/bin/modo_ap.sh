#!/bin/bash

[ ! -f "$LOG" ] && touch "$LOG" && chmod 644 "$LOG"

LOG="/var/log/alternar_modo.log"
echo "[+] $(date) - Alternar para MODO AP..." | tee -a "$LOG"

# Verificar se wpa_supplicant está a correr
if systemctl is-active --quiet wpa_supplicant@wlp4s0; then
    echo "[i] Parar wpa_supplicant@wlp4s0..." | tee -a "$LOG"
    systemctl stop wpa_supplicant@wlp4s0
fi

# Parar hostapd se já estiver a correr (evita erro)
systemctl stop hostapd >/dev/null 2>&1

# Aplicar configuração de rede
cp /etc/network/interfaces.ap /etc/network/interfaces
echo "[✓] Configuração de rede (AP) aplicada." | tee -a "$LOG"

# Reiniciar interfaces
ifdown wlp4s0 && ifdown enp0s31f6
ifup enp0s31f6 && ifup wlp4s0
echo "[✓] Interfaces reiniciadas." | tee -a "$LOG"

# Iniciar serviços de AP
systemctl start hostapd
systemctl start bind9
echo "[✓] Serviços hostapd e bind9 iniciados." | tee -a "$LOG"

echo "[✔] $(date) - MODO AP activado com sucesso." | tee -a "$LOG"

