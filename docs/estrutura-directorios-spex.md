📁 /spex
├── 📁 database
     ├── 📁 backups # 🗃️ Backups automáticos da base de dados
     ├── 📝 backup.bat # Script de backup para Windows
     ├── 📝 backup.sh # Script de backup para Linux
     ├── 📄 CAMINHO_BACKUP # Caminho onde os backups são salvos
     ├── 📄 schema.sql # Script de criação da base de dados  
     ├── 📄 seeds.sql # Dados iniciais (usuários, cursos, etc)
     ├── 📄 triggers.sql # Restrições ao Nível da Base de Dados
     └── 📄 consultar_estudantes.sql # Consulta para testes de login
├── 📁 docs
     ├── 📁 diagramas # 📊 Diagramas UML do sistema
          ├── 📁 diagrama_arquitectura_sistema
          ├── 📁 diagrama_entidade_relacionamento
          ├── 📁 diagramas_actividades
          ├── 📁 diagramas_casos_uso
          ├── 📁 diagramas_classes
          └── 📁 diagramas_sequencia
     ├── 📄 requisitos.md # Requisitos do sistema
     ├── 📄 sys.md # Informações do sistema (markdown)
     ├── 📄 sys.txt # Versão TXT de "sys.md"
     └── 📄 guia_instalacao # Guia de instalação e uso
├── 📁 public │ ├── 🌐 index.html # Página pública inicial
     ├── 📁 css # Estilos (Bulma, personalizados)
          ├── 📁 bulma
          └── 📁 fontawesome
     ├── 🖼️ img # Imagens públicas do sistema
     ├── 📜 js # Scripts JavaScript
     ├── 📁 uploads # Arquivos dos usuários
          └── 📁 users │
               ├── 📁 usuario_1
                    ├── 🖼️ perfil
                    ├── 📄 exames
                    ├── 📄 relatorios
                    └── 📄 docs
               └── 📁 usuario_2 # Estrutura igual a de usuário 1
     └── 🧩 favicon.ico # Ícone do site
├── 📁 src
     ├── 📁 assets
          ├── 🔤 fonts # Fontes internas
          ├── 🧩 icons # Ícones internos
          └── 🖼️ img # Imagens internas
     ├── 📁 controllers # Controladores da aplicação
          ├── 🧰 helpers # Funções reutilizáveis
          ├── 🔐 AuthController.php
          └── 👤 EstudanteController.ph
     ├── 📁 models
          └── 👥 EstudanteModel.ph
     ├── 📁 views # Páginas visíveis ao usuário
          ├── 📝 cadastro_estudante.php
          ├── 📊 dashboard.php
          ├── 🔐 login.php │
          └── 🔁 recuperar_senha.php
     └── ⚙️ config
          ├── 🛠️ config.php
          ├── 🗃️ database.php
          └── 🌍 env_loader.php
├── 📁 tests
     ├── 🧪 unit # Testes unitário
     ├── 🔗 integration # Testes de integração
     ├── 🧪 test_db.php
     ├── 🧪 test_login.php
     └── 🔁 test_login2.php
├── 🚀 index.php # Redirecionamento inicial
├── 📘 README.md # Documentação principal do projeto
├── 🛡️ .env # Variáveis de ambiente (confidencial)
└── 🚫 .gitignore # Arquivos ignorados pelo Git