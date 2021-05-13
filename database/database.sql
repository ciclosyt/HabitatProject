

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

-- INSERT INTO usuario VALUES (
--     default, "Jose", "Cabral", "660660660", "cabralzay@gmail.com", "hola", default
-- );

-- https://www.postgresql.org/docs/9.1/sql-grant.html 

CREATE TABLE compra (
  id int PRIMARY KEY AUTO_INCREMENT,
  id_compra int NOT NULL,
  num_compra char(8) NOT NULL,
  ref_compra_uuid CHAR(36) NOT NULL,
  nom_usuario VARCHAR(100) NOT NULL,
  fecha datetime default NOW(),
  FOREIGN KEY(id_compra) REFERENCES usuario(id_usuario) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- INSERT INTO compra VALUES (
--     default, 1, "00124", "uuid", "Jose Cabral", default
-- );

CREATE TABLE reserva(
  id int PRIMARY KEY AUTO_INCREMENT,
  id_reserva int NOT NULL,
  num_reserva char(8) NOT NULL,
  ref_reserva_uuid CHAR(36),
  nom_usuario VARCHAR(100) NOT NULL,
  fecha datetime default NOW(),
  FOREIGN KEY(id_reserva) REFERENCES usuario(id_usuario) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- INSERT INTO reserva VALUES (
--     default, 1, "00124", "uuid", "Jose Cabral", default
-- );

CREATE TABLE proprietario (
  id int PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(60) NOT NULL,
  apellido VARCHAR(60) NOT NULL,
  telefono char(9) NOT NULL,
  email VARCHAR(60) NOT NULL,
  password VARCHAR(250) NOT NULL,
  fecha_inscripcion datetime default NOW()
);

-- INSERT INTO proprietario VALUES(
--   default, "Javier", "CC", "660000742", "javierC@gmail.com", "javier123", default
-- );

-- INSERT INTO proprietario VALUES(
--   default, "Adrian Mt", "CC", "660555742", "aDrianM@gmail.com", "adiam223", default
-- );


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

INSERT INTO `inmueble` (`id`, `id_proprietario`, `titulo`, `precio`, `imagen`, `descripcion`, `num_habitacione`, `wc`, `estacionamiento`, `fecha_inscripcion`) VALUES
(7, 1, 'Casa en la playa hoy NN', '72500.00', '0406dba0a8b5675484c442452a8467a8.jpg', '22 Hola mundo 1 Hola mundo 1 Hola mundo 1 Hola mundo 1 Hola mundo 1 Hola mundo 1 Hola mundo 1', 4, 2, 1, '2021-04-25 22:36:58'),
(9, 1, 'Micasa su casa ACT', '8270.00', '29dfc610a040c426f92da6f987252198.jpg', 'Ola mundo hola mui hga  Ola mundo hola mui hga  Ola mundo hola mui hga  Ola mundo hola mui hga ', 3, 2, 2, '2021-04-27 00:42:00'),
(10, 1, 'Oferta de casa en la playa 33er', '12500.00', 'b2773d96c07dde6b73eccd6dddebd796.jpg', 'Esta casa es mui chula  Esta casa es mui chula  Esta casa es mui chula  Esta casa es mui chula ', 5, 2, 3, '2021-04-27 00:59:33');

CREATE TABLE mensaje(
  id_mensaje int PRIMARY KEY AUTO_INCREMENT,
  remintente VARCHAR(60) NOT NULL,
  destinatario VARCHAR(60) NOT NULL,
  contexto TEXT NOT NULL,
  fecha datetime default NOW(),
  FOREIGN KEY(id_mensaje) REFERENCES usuario(id_usuario) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY(id_mensaje) REFERENCES proprietario(id) ON DELETE RESTRICT ON UPDATE CASCADE
);