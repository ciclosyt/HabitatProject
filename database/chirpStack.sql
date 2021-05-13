--CREACION DE USUARIO 

-- crea el usuario
CREATE USER chirpstack2 WITH  SUPERUSER PASSWORD 'pwdchirpstack2'; -- ok
-- consulta lista user 
psql -h 54.195.37.13 -p 5432 -U postgres postgres -- ok
psql -h 54.195.37.13 -p 5432 -U chirpstack_as_events chirpstack_as_events -- ok

create database db_chrip2 with owner chirpstack2;


-- CREATE ROLE

CREATE ROLE chirpstack2 with LOGIN PASSWORD 'pwdchirpstack2';

--CREATE USER chirpstack with encrypted password 'pwdchirpstack';
-- le da asigna la base de dato de uso
GRANT ALL previleges ON chirpstack_as_events TO chirpstack_as_events;
-- ortogra el previlecio de (INSERT, SELECT, UPDATE)
ALTER USER chirpstack2 WITH NOSUPERUSER;
ALTER USER chirpstack_as_events WITH SUPERUSER;


-- LOS PREVILEGIO SE DAN EN UNA DETERMINADA TABLA

-- GRANT privileges create  ON DATABASE chirpstack_as_events TO chirpstack_as_events;
-- GRANT privileges create  ON DATABASE chirpstack_as_events TO chirpstack;
GRANT INSERT, SELECT, UPDATE  ON DATABASE chirpstack_as_events TO chirpstack2;
GRANT INSERT, SELECT, UPDATE  ON db_chrip2 TO chirpstack2;
GRANT INSERT, SELECT, UPDATE  ON chirpstack_as_events.* TO chirpstack2;
GRANT  UPDATE  ON db_chrip2 TO chirpstack2;
-- GRANT PREVILEGES INSERT  ON DATABASE chirpstack_as_event TO chirpstack;
--GRANT ALL PRIVILEGES ON DATABASE nanotutoriales_website TO nanotutoriales;

CREATE DATABASE chirpst WITH OWNER chirpstack2;


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
    my_device_name uuid NOT NULL,
    nombre VARCHAR(150) NOT NULL,
    apellidos VARCHAR(200) NOT NULL,
    correo VARCHAR(150) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fechaInscripcion timestamp with time zone not null DEFAULT NOW(),
    FOREIGN KEY(empresa_id) REFERENCES empresa(id) ON DELETE RESTRICT ON UPDATE CASCADE, 
    FOREIGN KEY(my_device_name) REFERENCES device_up(id) ON DELETE RESTRICT ON UPDATE CASCADE
  );
-- insert usuario
drop table empresa, usuario, notificacion_mensaje, role_permiso, tarea_usuario, dispositivo 
-- alterar la tabla usuario
alter  table public.usuario add COLUMN  tipo  type_role NOT NULL;

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
    "ffffff100000c845",
    "Artur",
    "Alves",
    "devexD2@gantabi.com",
    "hola",
    default
  );

CREATE TABLE dispositivo(
    id SERIAL PRIMARY KEY,
    empresa_id INTEGER NOT NULL,
    my_device_name uuid NOT NULL,
    id_usuario integer NOT NULL,
    fecha_inscripcion timestamp with time zone not null DEFAULT NOW(),
    FOREIGN KEY(empresa_id) REFERENCES empresa(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY(my_device_name) REFERENCES device_up(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY(id_usuario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE
  );

INSERT INTO dispositivo
VALUES(default, 1, "ffffff100000c845", 1, 0001, default);
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
    id SERIAL PRIMARY KEY,
    id_ispospositivo uuid NOT NULL,
    asunto VARCHAR(200) NOT NULL,
    -- origen_dispositivo referencia device_up(device_name)
    id_destinatario integer NOT NULL,
    -- destinatario_user referencia  usuario( correo)
    body TEXT NOT NULL,
    fecha_envio timestamp with time zone not null DEFAULT NOW(),
    FOREIGN KEY(id_ispospositivo) REFERENCES device_up(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY(id_destinatario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE
  );
-- Tablas de trabajo
  CREATE TABLE contador_registro_dispositivo(
    id SERIAL PRIMARY KEY,
    int num_registro_tabla_D_up int NOT NULL,
    fecha_isercion timestamp with time zone not null
  );
-- CREATICON DE TIPO DE DATO ESPECIALES (ENUM)
CREATE TYPE type_role AS ENUM('superAdmin', 'dmin', 'usuario');
CREATE TYPE type_previlege AS ENUM ('ALL', 'INSERT', 'SELECT', 'UPDATE', 'DELETE');
-- select * from pg_catalog.pg_type 
-- DELETE FROM pg_catalog.pg_type WHERE "oid"=17347;

-- CREACION DE LA TABLA PERMISO_ROLES

-- CREATE TABLE tb_role(
--    id SERIAL PRIMARY KEY,
--   tipo  type_role  NOT NULL,  
-- );
-- CREATE TABLE tb_permiso(
--   id INT PRIMARY KEY,
--   permiso type_previleges NOT NULL;
 
-- );

-- select nombre.usuario, tipo.tb_role, in_action.role_permiso WHERE id.usuario=id.id_action;, 

CREATE TABLE role_permiso(
  id SERIAL PRIMARY KEY,
  id_action_usuario INTEGER NOT NULL,
  tipo  type_role  NOT NULL, 
  permiso type_previlege NOT NULL,
  date_ort_previleges timestamp with time zone not null,
  -- FOREIGN KEY(id_action) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  -- FOREIGN KEY(id_action) REFERENCES role(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY(id_action_usuario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE
);

INSERT INTO role_permiso VALUES(default, 1, 'superAdmin', 'ALL');

CREATE TABLE tarea_usuario(
    id SERIAL PRIMARY KEY,
    id_usuario INTEGER NOT NULL,
    id_ispospositivo uuid NOT NULL,
    condicion_temperatura decimal(3,2),
    condicion_humedad decimal(3,2), 
    fecha_isercion timestamp with time zone not null,
    FOREIGN KEY(id_usuario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY(id_ispospositivo) REFERENCES device_up(id) ON DELETE RESTRICT ON UPDATE CASCADE
);



-- funcion de control de registro
--   CREATE
--   OR REPLACE FUNCTION conta_disposito() returns integer AS 'SELECT COUNT(distinct device_name) FROM public.device_up;' language sql;
-- -- llamar a la funcion
-- select
--   conta_disposito();
-- -- FUNCION REGISTRA DISPOSITIVOS
--   CREATE
--   OR REPLACE FUNCTION insert_dispositivos() RETURNS trigger 
--   AS $$ 
--   DECLARE temp_row chirpstack_as_events.dispositivo%rowtype;
-- -- llenar datos
--   temp_row.empresa_id : = NEW.empresa_id;
-- temp_row.my_device_name : = NEW.my_device_name;
-- temp_row.id_usuario : = NEW.id;
-- temp_row.cod_consulta : = NEW.cod_nivel_consulta;
-- BEGIN -- insertando los datos
--   -- INSERT INTO chirpstack_as_events.dispositivo (empresa_id, my_device_name, id_usuario, cod_consulta) SELECT temp_row.*;
-- INSERT INTO chirpstack_as_events.dispositivo
-- SELECT
--   temp_row.*;
-- END;
-- -- Devuelve el la estructura grabada NEW
-- RETURN NEW;
-- END IF;
-- RETURN NULL;
-- END;
-- -- Fin del procedimiento
-- $$ LANGUAGE plpgsql;


-- CREATE TRIGGER tg_insert_dispositivos
--   -- Este disparador se activa con los eventos de inserción, actualización y borrado
--   AFTER INSERT ON chirpstack_as_events.usuario
--   FOR EACH ROW
--   EXECUTE PROCEDURE insert_dispositivos();


-- TRIGGER DE ELVIO DE MENSAJE
-- TRIGGER/PROCEDURE  DE CAMBIO DE PASSWORD
--/ Tablas obligatoria que recogen los datos de Servidor [ChirpStack LoRaWan Server] /
-- CREACION DE TABLAS
create table device_up (
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
-- NOTE: These are example indices, depending on how this table is being
-- used, you might want to change these.
create index idx_device_up_received_at on device_up(received_at);
create index idx_device_up_dev_eui on device_up(dev_eui);
create index idx_device_up_application_id on device_up(application_id);
create index idx_device_up_frequency on device_up(frequency);
create index idx_device_up_dr on device_up(dr);
create index idx_device_up_tags on device_up(tags);
create table device_status (
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
create table device_join (
  id uuid primary key,
  received_at timestamp with time zone not null,
  dev_eui bytea not null,
  device_name varchar(100) not null,
  application_id bigint not null,
  application_name varchar(100) not null,
  dev_addr bytea not null,
  tags hstore not null
);
-- NOTE: These are example indices, depending on how this table is being
-- used, you might want to change these.
create index idx_device_join_received_at on device_join(received_at);
create index idx_device_join_dev_eui on device_join(dev_eui);
create index idx_device_join_application_id on device_join(application_id);
create index idx_device_join_tags on device_join(tags);
create table device_ack (
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
-- NOTE: These are example indices, depending on how this table is being
-- used, you might want to change these.
create index idx_device_ack_received_at on device_ack(received_at);
create index idx_device_ack_dev_eui on device_ack(dev_eui);
create index idx_device_ack_application_id on device_ack(application_id);
create index idx_device_ack_tags on device_ack(tags);
create table device_error (
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
-- NOTE: These are example indices, depending on how this table is being
-- used, you might want to change these.
create index idx_device_error_received_at on device_error(received_at);
create index idx_device_error_dev_eui on device_error(dev_eui);
create index idx_device_error_application_id on device_error(application_id);
create index idx_device_error_tags on device_error(tags);
create table device_location (
  id uuid primary key,
  received_at timestamp with time zone not null,
  dev_eui bytea not null,
  device_name varchar(100) not null,
  application_id bigint not null,
  application_name varchar(100) not null,
  altitude double precision not null,
  latitude double precision not null,
  longitude double precision not null,
  geohash varchar(12) not null,
  tags hstore not null,
  -- this field is currently not populated
  accuracy smallint not null[
);
-- NOTE: These are example indices, depending on how this table is being
-- used, you might want to change these.
create index idx_device_location_received_at on device_location(received_at);
create index idx_device_location_dev_eui on device_location(dev_eui);
create index idx_device_location_application_id on device_location(application_id);
create index idx_device_location_tags on device_location(tags);