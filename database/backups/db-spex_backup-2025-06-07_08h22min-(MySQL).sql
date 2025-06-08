-- Criação da base de dados
CREATE DATABASE IF NOT EXISTS spex CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE spex;

-- Tabela: nivel_acesso
CREATE TABLE IF NOT EXISTS nivel_acesso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Tabela: usuario
CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    id_nivel_acesso INT NOT NULL,
    data_registro DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (id_nivel_acesso) REFERENCES nivel_acesso(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela: disciplina
CREATE TABLE IF NOT EXISTS disciplina (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Tabela: curso
CREATE TABLE IF NOT EXISTS curso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE,
    descricao TEXT,
    imagem VARCHAR(255)
) ENGINE=InnoDB;

-- Tabela: aula
CREATE TABLE IF NOT EXISTS aula (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_disciplina INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    conteudo TEXT,
    ordem INT NOT NULL,
    video_url VARCHAR(255),
    FOREIGN KEY (id_disciplina) REFERENCES disciplina(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela: curso_disciplina
CREATE TABLE IF NOT EXISTS curso_disciplina (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_curso INT NOT NULL,
    id_disciplina INT NOT NULL,
    FOREIGN KEY (id_curso) REFERENCES curso(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_disciplina) REFERENCES disciplina(id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE (id_curso, id_disciplina)
) ENGINE=InnoDB;

-- Tabela: estudante
CREATE TABLE IF NOT EXISTS estudante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_registro DATETIME NOT NULL DEFAULT NOW()
) ENGINE=InnoDB;

-- Tabela: matricula
CREATE TABLE IF NOT EXISTS matricula (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_estudante INT NOT NULL,
    id_curso INT NOT NULL,
    data_matricula DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (id_estudante) REFERENCES estudante(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_curso) REFERENCES curso(id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE (id_estudante, id_curso)
) ENGINE=InnoDB;

-- Tabela: progresso
CREATE TABLE IF NOT EXISTS progresso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_matricula INT NOT NULL,
    id_aula INT NOT NULL,
    data_visualizacao DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (id_matricula) REFERENCES matricula(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_aula) REFERENCES aula(id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE (id_matricula, id_aula)
) ENGINE=InnoDB;

-- Tabela: pergunta
CREATE TABLE IF NOT EXISTS pergunta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_aula INT NOT NULL,
    pergunta TEXT NOT NULL,
    resposta_correta TEXT NOT NULL,
    FOREIGN KEY (id_aula) REFERENCES aula(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela: alternativa
CREATE TABLE IF NOT EXISTS alternativa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_pergunta INT NOT NULL,
    texto TEXT NOT NULL,
    correta BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_pergunta) REFERENCES pergunta(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Tabela: resposta_estudante
CREATE TABLE IF NOT EXISTS resposta_estudante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_estudante INT NOT NULL,
    id_pergunta INT NOT NULL,
    id_alternativa INT,
    data_resposta DATETIME NOT NULL DEFAULT NOW(),
    FOREIGN KEY (id_estudante) REFERENCES estudante(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_pergunta) REFERENCES pergunta(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_alternativa) REFERENCES alternativa(id) ON DELETE SET NULL ON UPDATE CASCADE,
    UNIQUE (id_estudante, id_pergunta)
) ENGINE=InnoDB;

-- Tabela: configuracao
CREATE TABLE IF NOT EXISTS configuracao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_sistema VARCHAR(100) NOT NULL,
    email_contato VARCHAR(100) NOT NULL,
    telefone_contato VARCHAR(20),
    endereco TEXT,
    logo_url VARCHAR(255)
) ENGINE=InnoDB;
