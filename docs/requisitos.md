# Documento de Requisitos - SPEX (Sistema de Simulação e Preparação para Exames)

## 1. Introdução

O Sistema de Simulação e Preparação para Exames (SPEX) tem como objetivo principal fornecer uma plataforma digital para estudantes simularem exames, avaliarem seu desempenho e acompanharem sua evolução, visando a preparação eficiente para provas escolares e exames de admissão.

Este documento descreve os requisitos funcionais e não funcionais identificados até o momento para o desenvolvimento do sistema.

## 2. Escopo do Sistema

O SPEX permitirá:

- Cadastro e autenticação de estudantes;
- Criação e gerenciamento de simulações de exames;
- Correção automática das respostas;
- Geração de relatórios de desempenho;
- Gestão de conteúdos por professores e administradores;
- Visualização de estatísticas de aproveitamento por área/disciplina.

## 3. Usuários do Sistema

- **Estudante**: realiza simulações, acompanha resultados e progresso.
- **Professor**: cria questões, define exames e acompanha estatísticas.
- **Administrador**: gerencia usuários, questões, permissões e configurações do sistema.

## 4. Requisitos Funcionais (RF)

| Código | Requisito | Prioridade |
|--------|-----------|------------|
| RF01 | O sistema deve permitir que o estudante se cadastre usando e-mail e senha. | Alta |
| RF02 | O sistema deve autenticar estudantes com e-mail e senha. | Alta |
| RF03 | O sistema deve permitir que o estudante realize simulações com tempo limite. | Alta |
| RF04 | O sistema deve corrigir automaticamente as respostas e calcular a nota final. | Alta |
| RF05 | O sistema deve apresentar estatísticas de desempenho ao estudante. | Média |
| RF06 | O professor deve poder cadastrar questões com múltiplas alternativas. | Alta |
| RF07 | O professor deve organizar questões por disciplina e nível de dificuldade. | Média |
| RF08 | O administrador deve gerenciar os cadastros de usuários e permissões. | Alta |
| RF09 | O sistema deve permitir exportar os resultados das simulações. | Baixa |

## 5. Requisitos Não Funcionais (RNF)

| Código | Requisito | Prioridade |
|--------|-----------|------------|
| RNF01 | O sistema deve ser responsivo e acessível por dispositivos móveis. | Alta |
| RNF02 | O sistema deve suportar pelo menos 100 usuários simultâneos. | Média |
| RNF03 | O sistema deve utilizar autenticação segura (criptografia de senhas). | Alta |
| RNF04 | O sistema deve estar disponível 99% do tempo. | Média |
| RNF05 | O backend deve ser implementado com Laravel (PHP) e banco de dados PostgreSQL. | Alta |
| RNF06 | O sistema deve utilizar Docker para containerização dos serviços. | Alta |

## 6. Restrições

- O sistema será desenvolvido em ambiente Linux.
- Utilização obrigatória de ferramentas como GitHub, Docker, Laravel, PostgreSQL.
- Interface do usuário feita com React e Bulma.
- O sistema deve seguir a arquitetura cliente-servidor com serviços separados.

## 7. Diagrama de Casos de Uso

[Inserir imagem ou link para o diagrama de casos de uso com os atores Estudante, Professor e Administrador.]

## 8. Diagrama de Classes

[Inserir imagem ou link para o diagrama UML das classes do sistema, como Estudante, Simulacao, Questao, etc.]

## 9. Diagramas de Atividades

- **Processo: Realizar Simulação**
  [Inserir aqui o diagrama de atividades representando o fluxo de um estudante ao realizar uma simulação.]

## 10. Diagramas de Sequência

- **Exemplo: Fluxo de Login**
  [Inserir diagrama de sequência que mostra a interação entre Estudante → Frontend → Backend → Banco de Dados.]

## 11. Diagrama de Componentes

[Inserir diagrama representando os módulos do sistema: Frontend (React), Backend (Laravel), Banco de Dados (PostgreSQL), Monitoramento (Grafana/Prometheus), Certificados SSL (Let's Encrypt), DNS/DHCP.]

## 12. Diagrama Entidade-Relacionamento (DER)

O DER abaixo apresenta a estrutura do banco de dados do sistema SPEX, modelando as entidades principais como ESTUDANTE, QUESTAO, SIMULACAO, e suas relações.

### Principais Entidades

- **ESTUDANTE:** id, nome, email, senha, data_registro  
- **QUESTAO:** id, enunciado, alternativa_a, alternativa_b, alternativa_c, alternativa_d, resposta_correta, disciplina  
- **SIMULACAO:** id, id_estudante, data_execucao, nota_total  
- **RESPOSTA:** id, id_simulacao, id_questao, resposta_dada, correta (bool)  

### Relacionamentos

- Um estudante pode realizar várias simulações (1:N).
- Uma simulação contém várias questões (N:M).
- Uma questão pode estar em várias simulações (N:M).
- A tabela RESPOSTA serve como entidade associativa entre SIMULACAO e QUESTAO.

[Inserir aqui imagem ou link para o DER.]

## 13. Glossário

- **Simulação**: Conjunto de questões disponibilizadas ao estudante como se fosse um exame real.  
- **Estatística de Desempenho**: Representação gráfica ou textual dos acertos, erros e tempo de resposta.  
- **Entidade**: Objeto do mundo real modelado no banco de dados (ex: Estudante, Questão).  
- **Atributo**: Informação associada a uma entidade (ex: nome, email, nota).  
- **Relacionamento**: Ligação entre entidades (ex: um estudante realiza várias simulações).

## 14. Histórico de Versões

| Data | Versão | Descrição | Autor |
|------|--------|-----------|--------|
| 2025-04-05 | 1.0 | Documento inicial de requisitos | Equipe SPEX |
| 2025-04-05 | 1.1 | Inclusão de diagramas UML e DER | Equipe SPEX |