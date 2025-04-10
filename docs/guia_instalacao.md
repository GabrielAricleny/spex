# Guia de Instalação - Sistema SPEX

## 1. Requisitos do Sistema

- **PHP** 7.4 ou superior
- **MySQL** 5.7 ou superior
- **Servidor Web** Apache ou Nginx
- **Composer** (para gerenciar dependências PHP)
- **Docker** (opcional, para containerização)

## 2. Passos de Instalação

### 2.1 Clonando o repositório

```bash
git clone https://github.com/usuario/repo_spex.git
cd repo_spex
```

### 2.2 Instalando as dependências com o Composer

```bash
composer install
```

### 2.3 Configurando o ambiente

Copie o arquivo `.env.example` para `.env`:

```bash
cp .env.example .env
```

### 2.4 Configurando o banco de dados

1. Crie uma base de dados MySQL com o nome `spex`.
2. Ajuste as credenciais no arquivo `.env`:

   ```env
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=spex
   DB_USERNAME=seu_usuario
   DB_PASSWORD=sua_senha
   ```

### 2.5 Rodando as migrações

Execute o comando abaixo para criar as tabelas no banco de dados:

```bash
php artisan migrate
```

### 2.6 Acessando o sistema

Abra o navegador e acesse:

```
http://localhost
```

## 3. Configuração do Docker (Opcional)

Caso prefira utilizar Docker, siga os passos abaixo:

- Crie os containers:

  ```bash
  docker-compose up -d
  ```

- Acesse o sistema pela URL configurada no arquivo `docker-compose.yml`.

## 4. Problemas Comuns

- Se o PHP não estiver funcionando corretamente, verifique a versão do PHP no seu sistema.
- Se houver problemas com o banco de dados, verifique as credenciais no arquivo `.env`.

## 5. Suporte

Para mais informações ou para relatar problemas, entre em contato com o suporte via e-mail ou consulte a [documentação do repositório GitHub](https://github.com/usuario/repo_spex).