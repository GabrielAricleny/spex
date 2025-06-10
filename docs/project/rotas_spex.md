# Documentação das Rotas do SPEX

Documentação das Rotas - SPEX

🏠 Página Inicial
## -----------------------------------------------------------------------
GET / → Carrega a página pública inicial do sistema.
## -----------------------------------------------------------------------


👤 Rotas de Utilizador
## -----------------------------------------------------------------------
GET /login → Exibe o formulário de login do estudante.
POST /login → Processa os dados do formulário de login.
GET /logout → Termina a sessão do estudante.
GET /dashboard → Exibe o painel do estudante (requer autenticação).

Middleware: autenticado
## -----------------------------------------------------------------------


🚰️ Rotas de Administrador
## -----------------------------------------------------------------------
GET /admin/login → Exibe o formulário de login do administrador.
POST /admin/login → Processa os dados de login do administrador.
GET /admin/logout → Termina a sessão do administrador.
GET /admin/painel → Carrega o painel de administração.

Middleware: admin
## -----------------------------------------------------------------------
📌 Nota: Todas as rotas protegidas utilizam middlewares definidos no arquivo middlewares.php, localizado em /src/config/.


## ======================================================================================================================
## Resumo das Rotas: ====================================================================================================
## ======================================================================================================================

## Rotas de Utilizador (Estudante)

| Método | URL         | Ação                               | Middleware |
|--------|-------------|------------------------------------|------------|
| GET    | /login      | Exibe o formulário de login        | Nenhum     |
| POST   | /login      | Processa a tentativa de login      | Nenhum     |
| GET    | /logout     | Termina a sessão do utilizador     | Nenhum     |
| GET    | /dashboard  | Página principal do estudante      | auth       |

## Rotas de Administrador (Admin)

| Método | URL           | Ação                               | Middleware |
|--------|---------------|------------------------------------|------------|
| GET    | /admin/login  | Exibe o formulário de login admin  | Nenhum     |
| POST   | /admin/login  | Processa login do admin            | Nenhum     |
| GET    | /admin/logout | Termina a sessão do admin          | Nenhum     |
| GET    | /admin/painel | Painel principal do admin          | admin      |

---

## Notas

- Middleware `auth`: exige que o utilizador esteja autenticado (estudante ou admin).
- Middleware `admin`: exige que o utilizador tenha nível de acesso `admin`.
- URLs no menu e navegação devem corresponder a estas rotas para manter a consistência.
- As páginas `/dashboard` e `/admin/painel` devem ter proteção para evitar acessos não autorizados.
