#!/bin/bash

echo "Dispositivos conectados ao AP (via wlp4s0):"
echo ""

# Obter dump completo uma vez para evitar múltiplas execuções do comando
dump=$(iw dev wlp4s0 station dump)

# Extrair todos os MACs conectados
macs=$(echo "$dump" | grep "^Station" | awk '{print $2}')

for mac in $macs; do
    # Obter IP associado ao MAC via tabela ARP
    ip=$(ip neigh | grep -i $mac | awk '{print $1}')
    [ -z "$ip" ] && ip="(IP desconhecido)"

    # Resolver nome (via /etc/hosts ou DNS local)
    if [[ "$ip" != "(IP desconhecido)" ]]; then
        nome=$(getent hosts $ip | awk '{print $2}')
        [ -z "$nome" ] && nome="(Sem nome definido)"
    else
        nome="(Sem nome definido)"
    fi

    # Obter bloco de dados da estação
    block=$(echo "$dump" | awk -v mac="$mac" '
        $0 ~ "Station "mac {
            print_line = 1
        }
        print_line && NF == 0 {
            exit
        }
        print_line
    ')

    # Extrair dados
    sinal=$(echo "$block" | grep "signal:" | head -n 1 | awk '{print $2}')
    tempo=$(echo "$block" | grep "connected time:" | awk '{print $3}')

    # Exibir dados
    echo "Nome: $nome"
    echo "MAC: $mac"
    echo "IP: $ip"
    echo "Sinal: $sinal dBm"
    echo "Tempo de ligação: $tempo segundos"
    echo "-----------------------------"
done

