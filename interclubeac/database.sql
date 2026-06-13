-- ============================================
-- INTER CLUBE ACADEMIA DE FUTEBOL - ANGOLA
-- Base de Dados Principal
-- ============================================


-- Tabela de Atletas / Candidaturas
CREATE TABLE candidaturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rup VARCHAR(20) UNIQUE NOT NULL,
    nome_completo VARCHAR(150) NOT NULL,
    data_nascimento DATE NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    bi VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    telefone2 VARCHAR(20),
    provincia VARCHAR(50) NOT NULL,
    municipio VARCHAR(50) NOT NULL,
    bairro VARCHAR(100) NOT NULL,
    nome_pai VARCHAR(150),
    nome_mae VARCHAR(150),
    contacto_emergencia VARCHAR(20) NOT NULL,
    posicao_preferida VARCHAR(50),
    clube_anterior VARCHAR(100),
    observacoes TEXT,
    foto_atleta VARCHAR(255),
    comprovativo_pagamento VARCHAR(255),
    valor_inscricao DECIMAL(10,2) NOT NULL DEFAULT 5000.00,
    status ENUM('pendente','pagamento_pendente','em_analise','aprovado','rejeitado') DEFAULT 'pendente',
    motivo_rejeicao TEXT,
    data_candidatura DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    admin_id INT,
    notas_admin TEXT
);

-- Tabela de Eventos
CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT,
    data_evento DATE NOT NULL,
    hora_evento TIME,
    local_evento VARCHAR(200),
    imagem VARCHAR(255),
    publicado TINYINT(1) DEFAULT 0,
    destaque TINYINT(1) DEFAULT 0,
    criado_por INT,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de Administradores
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    nivel ENUM('super_admin','admin','editor') DEFAULT 'admin',
    ativo TINYINT(1) DEFAULT 1,
    ultimo_login DATETIME,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Contactos
CREATE TABLE contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20),
    assunto VARCHAR(200) NOT NULL,
    mensagem TEXT NOT NULL,
    lido TINYINT(1) DEFAULT 0,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de Categorias
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    idade_min INT NOT NULL,
    idade_max INT NOT NULL,
    descricao TEXT,
    valor_inscricao DECIMAL(10,2) DEFAULT 5000.00,
    ativo TINYINT(1) DEFAULT 1
);

-- Inserir Categorias
INSERT INTO categorias (nome, idade_min, idade_max, descricao, valor_inscricao) VALUES
('Petizes', 5, 7, 'Categoria para crianças dos 5 aos 7 anos', 3000.00),
('Traquinas', 8, 9, 'Categoria para crianças dos 8 aos 9 anos', 3000.00),
('Benjamins', 10, 11, 'Categoria para crianças dos 10 aos 11 anos', 3500.00),
('Infantis', 12, 13, 'Categoria para jovens dos 12 aos 13 anos', 4000.00),
('Iniciados', 14, 15, 'Categoria para jovens dos 14 aos 15 anos', 4500.00),
('Juvenis', 16, 17, 'Categoria para jovens dos 16 aos 17 anos', 5000.00),
('Juniores', 18, 20, 'Categoria para jovens dos 18 aos 20 anos', 5500.00),
('Seniores', 21, 45, 'Categoria para atletas dos 21 anos em diante', 6000.00);

-- Inserir Admin padrão (password: Admin@2024)
INSERT INTO admins (nome, email, password, nivel) VALUES
('Super Admin', 'admin@interclubeac.ao', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'super_admin');

-- Inserir Eventos de exemplo
INSERT INTO eventos (titulo, descricao, data_evento, hora_evento, local_evento, publicado, destaque) VALUES
('Inscrições Abertas 2025', 'A Academia de Futebol Inter Clube abre inscrições para a época 2025. Vagas limitadas para todas as categorias.', '2025-01-15', '08:00:00', 'Estádio 11 de Novembro, Luanda', 1, 1),
('Torneio Interacademias', 'Grande torneio entre as principais academias de futebol de Angola. Venha apoiar os nossos jovens talentos!', '2025-03-20', '09:00:00', 'Complexo Desportivo da Cidadela, Luanda', 1, 1),
('Dia Aberto da Academia', 'Treinamento aberto ao público. Venha conhecer as nossas instalações e metodologias de treino.', '2025-02-10', '10:00:00', 'Academia Inter Clube, Luanda', 1, 0);
