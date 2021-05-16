
DROP DATABASE IF EXISTS habitat;
CREATE DATABASE habitat;
USE habitat;

CREATE TABLE usuario(
  id_usuario int PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(60) NOT NULL,
  apellido VARCHAR(60) NOT NULL,
  telefono char(9) NOT NULL,
  email VARCHAR(60) NOT NULL,
  password VARCHAR(250) NOT NULL,
  fecha_inscripcion datetime default NOW()
);

CREATE TABLE compra (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_compra int NOT NULL,
  num_compra char(8) NOT NULL,
  ref_compra_uuid CHAR(36) NOT NULL,
  nom_usuario VARCHAR(100) NOT NULL,
  fecha datetime default NOW(),
  FOREIGN KEY(id_compra) REFERENCES usuario(id_usuario) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE reserva(
  id int PRIMARY KEY AUTO_INCREMENT,
  id_reserva int NOT NULL,
  num_reserva char(8) NOT NULL,
  ref_reserva_uuid CHAR(36),
  nom_usuario VARCHAR(100) NOT NULL,
  fecha datetime default NOW(),
  FOREIGN KEY(id_reserva) REFERENCES usuario(id_usuario) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE proprietario (
  id int PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(60) NOT NULL,
  apellido VARCHAR(60) NOT NULL,
  telefono char(9) NOT NULL,
  email VARCHAR(60) NOT NULL,
  password VARCHAR(250) NOT NULL,
  fecha_inscripcion datetime default NOW()
);

CREATE TABLE admin (
  id int PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(60) NOT NULL,
  apellido VARCHAR(60) NOT NULL,
  telefono char(9) NOT NULL,
  email VARCHAR(60) NOT NULL,
  password VARCHAR(250) NOT NULL,
  fecha_inscripcion datetime default NOW()
);

CREATE TABLE inmueble (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_proprietario int NOT NULL,
  titulo VARCHAR(60) NOT NULL,
  precio DECIMAL(10, 2) NOT NULL,
  imagen VARCHAR(200) NOT NULL,
  descripcion TEXT NOT NULL,
  num_habitacione int NOT NULL,
  wc int NOT NULL,
  estacionamiento int NOT NULL,
  fecha_inscripcion datetime default NOW(),
  FOREIGN KEY( id_proprietario) REFERENCES proprietario(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE mensaje(
  id_mensaje int PRIMARY KEY AUTO_INCREMENT,
  remintente VARCHAR(60) NOT NULL,
  destinatario VARCHAR(60) NOT NULL,
  contexto TEXT NOT NULL,
  fecha datetime default NOW(),
  FOREIGN KEY(id_mensaje) REFERENCES usuario(id_usuario) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY(id_mensaje) REFERENCES proprietario(id) ON DELETE RESTRICT ON UPDATE CASCADE
);