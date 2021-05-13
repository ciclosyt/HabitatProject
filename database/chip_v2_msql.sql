DROP DATABASE IF EXISTS chirpstack_as;
CREATE DATABASE chirpstack_as;
USE chirpstack_as;

CREATE TABLE empresa(
  id INT PRIMARY KEY AUTO_INCREMENT,
  empresa_id VARCHAR(150) NOT NULL,
  empresa_nombre VARCHAR(150) NOT NULL,
  NIF CHAR(9) NOT NULL,
  direccion VARCHAR(200) NOT NULL,
  code_postal CHAR(5) NOT NULL,
  telefono CHAR(12) NOT NULL,
  corro VARCHAR(200) NOT NULL,
  web VARCHAR(255) NOT NULL,
  fecha_creacion timestamp not null DEFAULT NOW()
);
-- INSERT en la Tabla Empresa
INSERT INTO empresa (
    empresa_id,
    empresa_nombre,
    NIF,
    direccion,
    code_postal,
    telefono,
    corro,
    web
  )
VALUES(
    "Gantabi_001A",
    "Gantabi OneClik",
    "000000001",
    "Gran Via de les Corte Catalana, nº 800, Entresuelo",
    "08045",
    "660660661",
    "oneclick@gantabi.es",
    "htttps://gantabi.es"
  );
INSERT INTO empresa
VALUES(
    default,
    "ALDI_002B",
    "Aldi LDA",
    "000000002",
    "Ronda del Guirnadó, nº 55",
    "08045",
    "660660557",
    "comercio@aldi.es",
    "htttps://...",
    default
  );
CREATE TABLE usuario(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_empresa int NOT NULL,
    rol int NOT NULL,
    cod_nivel_consulta int NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    apellidos VARCHAR(200) NOT NULL,
    correo VARCHAR(150) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fechaInscripcion timestamp not null DEFAULT NOW(),
    FOREIGN KEY(id_empresa) REFERENCES empresa(id) ON DELETE RESTRICT ON UPDATE CASCADE
  );
INSERT INTO usuario VALUES  (
    default,
    1,
    1,
    0001,
    "Jose",
    "Cabral",
    "devex3@gantabi.com", "hola123",
    default
  );
INSERT INTO usuario VALUES (
    default,
    2,
    2,
    0002,
    "Artur",
    "Alves",
    "devexD2@gantabi.com", "hola",
    default
  );
INSERT INTO usuario VALUES (
    default,
    2,
    2,
     0001,
    "Jose",
    "Cabral",
    "usuario@gmail.com", 
    "hola",
    default
  );
  
  create table device_up (
    id int primary key,
    received_at timestamp not null,
    dev_eui char(60) not null,
    device_name varchar(100) not null,
    application_id bigint not null,
    application_name varchar(100) not null,
    frequency bigint not null,
    dr smallint not null,
    adr boolean not null,
    f_cnt bigint not null,
    f_port smallint not null,
    tags varchar(100) not null,
    data char(60) not null,
    rx_info varchar(100) not null,
    object varchar(100) not null
  );

INSERT INTO device_up VALUES(
    default,
    NOW(),
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    "",
    ""
);

-- NOTE: These are example indices, depending on how this table is being
  -- used, you might want to change these.
create index idx_device_up_received_at on device_up(received_at);
create index idx_device_up_dev_eui on device_up(dev_eui);
create index idx_device_up_application_id on device_up(application_id);
create index idx_device_up_frequency on device_up(frequency);
create index idx_device_up_dr on device_up(dr);
create index idx_device_up_tags on device_up(tags);
    
CREATE TABLE dispositivo(
    id INT PRIMARY KEY AUTO_INCREMENT,
    empresa_id int NOT NULL,
    my_device_id uuid NOT NULL,
    id_usuario int NOT NULL,
    cod_consulta int NOT NULL,
    fecha_inscripcion timestamp  not null DEFAULT NOW(),
    
    FOREIGN KEY(empresa_id) REFERENCES empresa(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY(my_device_id) REFERENCES device_up(id) ON DELETE RESTRICT ON UPDATE CASCADE,
     FOREIGN KEY(id_usuario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE
  -- FOREIGN KEY(cod_consulta) REFERENCES usuario(cod_nivel_consulta) ON DELETE RESTRICT ON UPDATE CASCADE
  );

INSERT INTO dispositivo VALUES(
default,
1,
1,
1,
0001,
default
);



-- CASO DE USO rol =1 / super Admin
  -- SELECT * FROM dispositivo; = lista todos os dispositivos
  -- CASO DE USO rol =2 / Admini
  -- SELECT * FROM dispositivo WHERE rol = 2 AND  cod_consulta = ' cod_consulta';
  -- -- ( lista todos os dispositivos que apuntan al rol = 2 de todas las empresa que tiene el Admin)
  -- CASO 2A listar os dispositivos de una sola empresa.
  -- SELECT * FROM dispositivo WHERE rol = 2 AND empresa_id = 'empresa_id';
  -- -- ( lista todos os dispositivos que apuntan al roll = 2 de todas todos los dispositivos que tiene una unica empresa)
  -- CASO DE USO rol =3 / usuario
  -- SELECT * FROM dispositivo WHERE cod_consulta = ' cod_consulta' AND empresa_id = 'empresa_id';
  -- -- ( lista todos os dispositivos que apuntan al roll = 2 yauna determinada empresa)
  CREATE TABLE notificacion_mensaje(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_ispospositivo uuid NOT NULL,
    asunto VARCHAR(200) NOT NULL,
    -- origen_dispositivo referencia device_up(device_name)
    id_destinatario int NOT NULL,
    -- destinatario_user referencia  usuario( correo)
    body TEXT NOT NULL,
    fecha_envio timestamp with time zone not null DEFAULT NOW(),
    FOREIGN KEY(id_ispospositivo) REFERENCES device_up(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY(id_destinatario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE
  );
-- TRIGGER DE ELVIO DE MENSAJE
  -- TRIGGER/PROCEDURE  DE CAMBIO DE PASSWORD
  -- Tablas obligatoria que recogen los datos de Servidor [ChirpStack LoRaWan Server] /
  -- CREACION DE TABLAS
  