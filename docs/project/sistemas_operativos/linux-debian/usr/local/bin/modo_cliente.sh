#!/bin/bash

[ ! -f "$LOG" ] && touch "$LOG" && chmod 644 "$LOG"

LOG="/var/log/alternar_modo.log"
echo "[+] $(date) - Alternar para MODO CLIENTE..." | tee -a "$LOG"

# Verificar se hostapd está a correr
if systemctl is-active --quiet hostapd; then
    echo "[i] Parar hostapd..." | tee -a "$LOG"
    systemctl stop hostapd
fi

# Parar bind9 (se aplicável)
systemctl stop bind9 >/dev/null 2>&1

# Aplicar configuração de rede
cp /etc/network/interfaces.cliente /etc/network/interfaces
echo "[✓] Configuração de rede (cliente) aplicada." | tee -a "$LOG"

# Reiniciar interfaces
ifdown wlp4s0 && ifdown enp0s31f6
ifup enp0s31f6 && ifup wlp4s0
echo "[✓] Interfaces reiniciadas." | tee -a "$LOG"

# Iniciar wpa_supplicant (cliente)
systemctl start wpa_supplicant@wlp4s0
echo "[✓] wpa_supplicant iniciado." | tee -a "$LOG"

echo "[✔] $(date) - MODO CLIENTE activado com sucesso." | tee -a "$LOG"

