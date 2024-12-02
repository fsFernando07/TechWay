CREATE DATABASE BD_TechWay;
USE BD_TechWay;

CREATE TABLE Usuario(
    id int primary key auto_increment,
    nome varchar(80),
    email varchar(80),
    senha varchar(80),
    id_google varchar(100),
    foto varchar(100),
    recuperar_senha varchar(80)
);

CREATE TABLE Categorias(
    id int primary key auto_increment,
    categoria varchar(40)
);

CREATE TABLE Estabelecimento(
    id int primary key auto_increment,
    nome_estabelecimento varchar(80),
    descricao text,
    cnpj varchar(20),
    bairro varchar(40),
    tipo_logradouro varchar(20),
    logradouro varchar(80),
    numero int,
    telefone varchar(20),
    horario varchar(80),
    instagram varchar(400),
    tiktok varchar(400),
    facebook varchar(400),
    emailCom varchar(100),
    emailLog varchar(100),
    senha varchar(100),
    autorizado varchar(20),
    recuperar_senha varchar(80),
    id_categoria int,
    CONSTRAINT FK_Categoria FOREIGN KEY (id_categoria)
    REFERENCES Categorias(id)
);

CREATE TABLE Fotos_Estabelecimento(
    id int primary key auto_increment,
    id_estabelecimento int,
    logo varchar(100),
    foto_1 varchar(100),
    foto_2 varchar(100),
    foto_3 varchar(100),
    foto_4 varchar(100),
    foto_5 varchar(100),
    foto_6 varchar(100),
    foto_7 varchar(100),
    foto_8 varchar(100),
    foto_9 varchar(100),
    foto_10 varchar(100),
    CONSTRAINT FK_Estabelecimento FOREIGN KEY (id_estabelecimento)
    REFERENCES Estabelecimento(id)
);


CREATE TABLE Tipo_Monitor(
    id int primary key auto_increment,
    tipo varchar(20)
);

CREATE TABLE Monitor(
    id int primary key auto_increment,
    nome varchar(80),
    descricao text,
    numero_cadastur varchar(20),
    genero varchar(40),
    idiomas varchar(80),
    areas_especializacao varchar(100),
    email varchar(100),
    senha varchar(100),
    telefone varchar(20),
    instagram varchar(400),
    tiktok varchar(400),
    facebook varchar(400),
    autorizado varchar(20),
    recuperar_senha varchar(80),
    id_tipo int,
    CONSTRAINT FK_Tipo FOREIGN KEY (id_tipo)
    REFERENCES Tipo_Monitor(id)
);

CREATE TABLE Fotos_Monitor(
    id int primary key auto_increment,
    id_monitor int,
    foto_perfil varchar(100),
    foto_1 varchar(100),
    foto_2 varchar(100),
    foto_3 varchar(100),
    foto_4 varchar(100),
    foto_5 varchar(100),
    CONSTRAINT FK_Monitor FOREIGN KEY (id_monitor)
    REFERENCES Monitor(id)
);

CREATE TABLE Admin(
    id int primary key auto_increment,
    email varchar(100),
    senha varchar(100)
);

INSERT INTO Categorias(categoria) VALUES("Hospedagem"),("Alimentação"),("Compras"),("Locomoção");

INSERT INTO Tipo_Monitor(tipo) VALUES("Monitor"), ("Guia"), ("Guia e Monitor");

INSERT INTO Admin(email, senha) VALUES("admin@gmail.com", "$2y$10$/qVtnT/UfBk/CLWOHUay/u7cqz/QlT7k.2Pqee2Mz7ltwBS6vzzMS");