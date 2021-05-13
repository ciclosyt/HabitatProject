-- help : https://www.sqlshack.com/learn-sql-join-multiple-tables/

DROP DATABASE IF EXISTS chirpstack_as_events;
CREATE DATABASE chirpstack_as_events;
USE chirpstack_as_events;

CREATE TABLE empresa(
  id SERIAL PRIMARY KEY,
  empresa_id VARCHAR(150) NOT NULL,
  empresa_nombre VARCHAR(150) NOT NULL,
  NIF CHAR(9) NOT NULL,
  direccion VARCHAR(200) NOT NULL,
  code_postal CHAR(5) NOT NULL,
  telefono CHAR(12) NOT NULL,
  corro VARCHAR(200) NOT NULL,
  web VARCHAR(255) NOT NULL,
  fecha_creacion timestamp with time zone not null DEFAULT NOW()
);

-- INSERTADATOS EN LA TABLA empresa
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
    'Gantabi_001A',
    'Gantabi OneClik',
    '000000001',
    'Gran Via de les Corte Catalana, nº 800, Entresuelo',
    '08045',
    '660660661',
    'oneclick@gantabi.es',
    'htttps://gantabi.es'
  );

CREATE TABLE usuario(
    id SERIAL PRIMARY KEY,
    empresa_id INTEGER NOT NULL,
    device_name VARCHAR(100) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(200) NOT NULL,
    correo VARCHAR(150) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fechaInscripcion timestamp with time zone not null DEFAULT NOW(),
    FOREIGN KEY(empresa_id) REFERENCES empresa(id) ON DELETE RESTRICT ON UPDATE CASCADE 
    --FOREIGN KEY(my_device_name) REFERENCES device_up(id) ON DELETE RESTRICT ON UPDATE CASCADE
  );

  -- INSERTAR DATOS EN LA TABLA usuario
  INSERT INTO usuario
VALUES
  (
    default,
    1,
   'ffffff100000c845',
    'Jose',
    'Cabral',
    'devex3@gantabi.com',
    'hola123',
    default
  );
INSERT INTO usuario
VALUES
  (
    default,
    1,
    'ffffff100000c845',
    'Artur',
    'Alves',
    'devexD2@gantabi.com',
    'hola',
    default
  );

  CREATE TABLE dispositivo(
    id SERIAL NOT NULL,
    device_name VARCHAR(100) PRIMARY KEY UNIQUE NOT NULL,
    id_empresa INTEGER NOT NULL,
    id_usuario INTEGER NOT NULL,
    fecha_inscripcion timestamp with time zone not null DEFAULT NOW(),
    FOREIGN KEY(id_empresa) REFERENCES empresa(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY(device_name) REFERENCES device_up(device_name) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY(id_usuario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE
  );

-- INSERTAR DATOS EN LA TABLA dispositivos
  INSERT INTO dispositivo
VALUES(default, 1, 'ffffff100000c845', 1, default);
  INSERT INTO dispositivo
VALUES(default, 1, 'ffffff100000c845', 1, default);
  INSERT INTO dispositivo
VALUES(default, 2, 'ffffff100000c845', 2, default);

    CREATE TABLE notificacion_mensaje(
    id SERIAL NOT NULL,
    device_name VARCHAR(100) PRIMARY KEY UNIQUE NOT NULL,
    asunto VARCHAR(200) NOT NULL,
    id_destinatario INTEGER NOT NULL,
    body TEXT NOT NULL,
    fecha_envio timestamp with time zone not null DEFAULT NOW(),
    FOREIGN KEY(device_name) REFERENCES device_up(device_name) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY(id_destinatario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE
  );

  CREATE TABLE role_permiso(
  id SERIAL PRIMARY KEY,
  id_action_usuario INTEGER NOT NULL,
  tipo type_role  NOT NULL, 
  permiso type_previlege NOT NULL,
  date_ort_previleges timestamp with time zone not null,
  FOREIGN KEY(id_action_usuario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE tarea_usuario(
    id SERIAL PRIMARY KEY,
    id_usuario INTEGER NOT NULL,
    device_name VARCHAR(100) PRIMARY KEY UNIQUE NOT NULL,
    condicion_temperatura decimal(3,2),
    condicion_humedad decimal(3,2), 
    fecha_isercion timestamp with time zone not null,
    FOREIGN KEY(id_usuario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY(device_name) REFERENCES device_up(device_name) ON DELETE RESTRICT ON UPDATE CASCADE
);

-- TABLAS OBLIGATORIAS PARA EL FUNCIONAMIENTO DE CHIRPSTACK 

CREATE TABLE device_up (
  id uuid primary key,
  received_at timestamp with time zone not null,
  dev_eui bytea not null,
  device_name varchar(100) not null,
  application_id bigint not null,
  application_name varchar(100) not null,
  frequency bigint not null,
  dr smallint not null,
  adr boolean not null,
  f_cnt bigint not null,
  f_port smallint not null,
  tags hstore not null,
  data bytea not null,
  rx_info jsonb not null,
  object jsonb not null
);

create index idx_device_up_received_at on device_up(received_at);
create index idx_device_up_dev_eui on device_up(dev_eui);
create index idx_device_up_application_id on device_up(application_id);
create index idx_device_up_frequency on device_up(frequency);
create index idx_device_up_dr on device_up(dr);
create index idx_device_up_tags on device_up(tags);

CREATE TABLE device_status (
  id uuid primary key,
  received_at timestamp with time zone not null,
  dev_eui bytea not null,
  device_name varchar(100) not null,
  application_id bigint not null,
  application_name varchar(100) not null,
  margin smallint not null,
  external_power_source boolean not null,
  battery_level_unavailable boolean not null,
  battery_level numeric(5, 2) not null,
  tags hstore not null
);
create index idx_device_status_received_at on device_status(received_at);
create index idx_device_status_dev_eui on device_status(dev_eui);
create index idx_device_status_application_id on device_status(application_id);
create index idx_device_status_tags on device_status(tags);

CREATE TABLE device_join (
  id uuid primary key,
  received_at timestamp with time zone not null,
  dev_eui bytea not null,
  device_name varchar(100) not null,
  application_id bigint not null,
  application_name varchar(100) not null,
  dev_addr bytea not null,
  tags hstore not null
);

create index idx_device_join_received_at on device_join(received_at);
create index idx_device_join_dev_eui on device_join(dev_eui);
create index idx_device_join_application_id on device_join(application_id);
create index idx_device_join_tags on device_join(tags);

CREATE TABLE device_ack (
  id uuid primary key,
  received_at timestamp with time zone not null,
  dev_eui bytea not null,
  device_name varchar(100) not null,
  application_id bigint not null,
  application_name varchar(100) not null,
  acknowledged boolean not null,
  f_cnt bigint not null,
  tags hstore not null
);

create index idx_device_ack_received_at on device_ack(received_at);
create index idx_device_ack_dev_eui on device_ack(dev_eui);
create index idx_device_ack_application_id on device_ack(application_id);
create index idx_device_ack_tags on device_ack(tags);

CREATE TABLE device_error (
  id uuid primary key,
  received_at timestamp with time zone not null,
  dev_eui bytea not null,
  device_name varchar(100) not null,
  application_id bigint not null,
  application_name varchar(100) not null,
  type varchar(100) not null,
  error text not null,
  f_cnt bigint not null,
  tags hstore not null
);

create index idx_device_error_received_at on device_error(received_at);
create index idx_device_error_dev_eui on device_error(dev_eui);
create index idx_device_error_application_id on device_error(application_id);
create index idx_device_error_tags on device_error(tags);

CREATE TABLE device_location (
  id uuid primary key,
  received_at timestamp with time zone not null,
  dev_eui bytea not null,
  device_name varchar(100) not null,
  application_id bigint not null,
  application_name varchar(100) not null,
  altitude double precision not null,
  latitude double precision not null,
  longitude double precision not null,
  geohash VARCHAR(12)  NOT NULLl,
  tags hstore  NOT NULL,
  accuracy SMALLINT NOT NULL
);

CREATE index idx_device_location_received_at on device_location(received_at);
CREATE index idx_device_location_dev_eui on device_location(dev_eui);
CREATE index idx_device_location_application_id on device_location(application_id);
CREATE index idx_device_location_tags on device_location(tags);