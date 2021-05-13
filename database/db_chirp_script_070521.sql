--
-- PostgreSQL database dump
--

-- Dumped from database version 13.2 (Debian 13.2-1.pgdg100+1)
-- Dumped by pg_dump version 13.2 (Ubuntu 13.2-1.pgdg20.04+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: hstore; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS hstore WITH SCHEMA public;


--
-- Name: EXTENSION hstore; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION hstore IS 'data type for storing sets of (key, value) pairs';


--
-- Name: type_previlege; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.type_previlege AS ENUM (
    'ALL',
    'INSERT',
    'SELECT',
    'UPDATE',
    'DELETE'
);


ALTER TYPE public.type_previlege OWNER TO postgres;

--
-- Name: type_role; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.type_role AS ENUM (
    'superAdmin',
    'dmin',
    'usuario'
);


ALTER TYPE public.type_role OWNER TO postgres;

--
-- Name: conta_disposito(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.conta_disposito() RETURNS integer
    LANGUAGE sql
    AS $$SELECT  COUNT(distinct device_name) FROM public.device_up;$$;


ALTER FUNCTION public.conta_disposito() OWNER TO postgres;

--
-- Name: sumar(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.sumar() RETURNS integer
    LANGUAGE sql
    AS $$SELECT  COUNT(distinct device_name) FROM public.device_up;$$;



--
-- Name: device_ack; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.device_ack (
    id uuid NOT NULL,
    received_at timestamp with time zone NOT NULL,
    dev_eui bytea NOT NULL,
    device_name character varying(100) NOT NULL,
    application_id bigint NOT NULL,
    application_name character varying(100) NOT NULL,
    acknowledged boolean NOT NULL,
    f_cnt bigint NOT NULL,
    tags public.hstore NOT NULL
);


ALTER TABLE public.device_ack OWNER TO postgres;

--
-- Name: device_error; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.device_error (
    id uuid NOT NULL,
    received_at timestamp with time zone NOT NULL,
    dev_eui bytea NOT NULL,
    device_name character varying(100) NOT NULL,
    application_id bigint NOT NULL,
    application_name character varying(100) NOT NULL,
    type character varying(100) NOT NULL,
    error text NOT NULL,
    f_cnt bigint NOT NULL,
    tags public.hstore NOT NULL
);


ALTER TABLE public.device_error OWNER TO postgres;

--
-- Name: device_join; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.device_join (
    id uuid NOT NULL,
    received_at timestamp with time zone NOT NULL,
    dev_eui bytea NOT NULL,
    device_name character varying(100) NOT NULL,
    application_id bigint NOT NULL,
    application_name character varying(100) NOT NULL,
    dev_addr bytea NOT NULL,
    tags public.hstore NOT NULL
);


ALTER TABLE public.device_join OWNER TO postgres;

--
-- Name: device_location; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.device_location (
    id uuid NOT NULL,
    received_at timestamp with time zone NOT NULL,
    dev_eui bytea NOT NULL,
    device_name character varying(100) NOT NULL,
    application_id bigint NOT NULL,
    application_name character varying(100) NOT NULL,
    altitude double precision NOT NULL,
    latitude double precision NOT NULL,
    longitude double precision NOT NULL,
    geohash character varying(12) NOT NULL,
    tags public.hstore NOT NULL,
    accuracy smallint NOT NULL
);


ALTER TABLE public.device_location OWNER TO postgres;

--
-- Name: device_status; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.device_status (
    id uuid NOT NULL,
    received_at timestamp with time zone NOT NULL,
    dev_eui bytea NOT NULL,
    device_name character varying(100) NOT NULL,
    application_id bigint NOT NULL,
    application_name character varying(100) NOT NULL,
    margin smallint NOT NULL,
    external_power_source boolean NOT NULL,
    battery_level_unavailable boolean NOT NULL,
    battery_level numeric(5,2) NOT NULL,
    tags public.hstore NOT NULL
);


ALTER TABLE public.device_status OWNER TO postgres;

--
-- Name: device_up; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.device_up (
    id uuid NOT NULL,
    received_at timestamp with time zone NOT NULL,
    dev_eui bytea NOT NULL,
    device_name character varying(100) NOT NULL,
    application_id bigint NOT NULL,
    application_name character varying(100) NOT NULL,
    frequency bigint NOT NULL,
    dr smallint NOT NULL,
    adr boolean NOT NULL,
    f_cnt bigint NOT NULL,
    f_port smallint NOT NULL,
    tags public.hstore NOT NULL,
    data bytea NOT NULL,
    rx_info jsonb NOT NULL,
    object jsonb NOT NULL
);


ALTER TABLE public.device_up OWNER TO postgres;

--
-- Name: dispositivo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.dispositivo (
    id integer NOT NULL,
    empresa_id integer NOT NULL,
    my_device_name uuid NOT NULL,
    id_usuario integer NOT NULL,
    fecha_inscripcion timestamp with time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.dispositivo OWNER TO postgres;

--
-- Name: dispositivo_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.dispositivo_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.dispositivo_id_seq OWNER TO postgres;

--
-- Name: dispositivo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.dispositivo_id_seq OWNED BY public.dispositivo.id;


--
-- Name: empresa; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.empresa (
    id integer NOT NULL,
    empresa_id character varying(150) NOT NULL,
    empresa_nombre character varying(150) NOT NULL,
    nif character(9) NOT NULL,
    direccion character varying(200) NOT NULL,
    code_postal character(5) NOT NULL,
    telefono character(12) NOT NULL,
    corro character varying(200) NOT NULL,
    web character varying(255) NOT NULL,
    fecha_creacion timestamp with time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.empresa OWNER TO postgres;

--
-- Name: empresa_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.empresa_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.empresa_id_seq OWNER TO postgres;

--
-- Name: empresa_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.empresa_id_seq OWNED BY public.empresa.id;


--
-- Name: notificacion_mensaje; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.notificacion_mensaje (
    id integer NOT NULL,
    id_ispospositivo uuid NOT NULL,
    asunto character varying(200) NOT NULL,
    id_destinatario integer NOT NULL,
    body text NOT NULL,
    fecha_envio timestamp with time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.notificacion_mensaje OWNER TO postgres;

--
-- Name: notificacion_mensaje_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.notificacion_mensaje_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.notificacion_mensaje_id_seq OWNER TO postgres;

--
-- Name: notificacion_mensaje_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.notificacion_mensaje_id_seq OWNED BY public.notificacion_mensaje.id;


--
-- Name: role_permiso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.role_permiso (
    id integer NOT NULL,
    id_action_usuario integer NOT NULL,
    tipo type_role NOT NULL,
    permiso public.type_previlege NOT NULL,
    date_ort_previleges timestamp with time zone NOT NULL
);


ALTER TABLE public.role_permiso OWNER TO postgres;

--
-- Name: role_permiso_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.role_permiso_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.role_permiso_id_seq OWNER TO postgres;

--
-- Name: role_permiso_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.role_permiso_id_seq OWNED BY public.role_permiso.id;


--
-- Name: tarea_usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tarea_usuario (
    id integer NOT NULL,
    id_usuario integer NOT NULL,
    id_ispospositivo uuid NOT NULL,
    condicion_temperatura numeric(3,2),
    condicion_humedad numeric(3,2),
    fecha_isercion timestamp with time zone NOT NULL
);


ALTER TABLE public.tarea_usuario OWNER TO postgres;

--
-- Name: tarea_usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tarea_usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tarea_usuario_id_seq OWNER TO postgres;

--
-- Name: tarea_usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tarea_usuario_id_seq OWNED BY public.tarea_usuario.id;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    id integer NOT NULL,
    empresa_id integer NOT NULL,
    my_device_name uuid NOT NULL,
    nombre character varying(150) NOT NULL,
    apellidos character varying(200) NOT NULL,
    correo character varying(150) NOT NULL,
    password character varying(255) NOT NULL,
    fechainscripcion timestamp with time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_seq OWNER TO postgres;

--
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_id_seq OWNED BY public.usuario.id;


--
-- Name: dispositivo id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dispositivo ALTER COLUMN id SET DEFAULT nextval('public.dispositivo_id_seq'::regclass);


--
-- Name: empresa id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.empresa ALTER COLUMN id SET DEFAULT nextval('public.empresa_id_seq'::regclass);


--
-- Name: notificacion_mensaje id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacion_mensaje ALTER COLUMN id SET DEFAULT nextval('public.notificacion_mensaje_id_seq'::regclass);


--
-- Name: role_permiso id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_permiso ALTER COLUMN id SET DEFAULT nextval('public.role_permiso_id_seq'::regclass);


--
-- Name: tarea_usuario id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tarea_usuario ALTER COLUMN id SET DEFAULT nextval('public.tarea_usuario_id_seq'::regclass);


--
-- Name: usuario id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario ALTER COLUMN id SET DEFAULT nextval('public.usuario_id_seq'::regclass);




SELECT pg_catalog.setval('public.dispositivo_id_seq', 1, false);


--
-- Name: empresa_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.empresa_id_seq', 1, true);


--
-- Name: notificacion_mensaje_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.notificacion_mensaje_id_seq', 1, false);


--
-- Name: role_permiso_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.role_permiso_id_seq', 1, false);


--
-- Name: tarea_usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tarea_usuario_id_seq', 1, false);


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_id_seq', 1, false);


--
-- Name: device_ack device_ack_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.device_ack
    ADD CONSTRAINT device_ack_pkey PRIMARY KEY (id);


--
-- Name: device_error device_error_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.device_error
    ADD CONSTRAINT device_error_pkey PRIMARY KEY (id);


--
-- Name: device_join device_join_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.device_join
    ADD CONSTRAINT device_join_pkey PRIMARY KEY (id);


--
-- Name: device_location device_location_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.device_location
    ADD CONSTRAINT device_location_pkey PRIMARY KEY (id);


--
-- Name: device_status device_status_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.device_status
    ADD CONSTRAINT device_status_pkey PRIMARY KEY (id);


--
-- Name: device_up device_up_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.device_up
    ADD CONSTRAINT device_up_pkey PRIMARY KEY (id);


--
-- Name: dispositivo dispositivo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dispositivo
    ADD CONSTRAINT dispositivo_pkey PRIMARY KEY (id);


--
-- Name: empresa empresa_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.empresa
    ADD CONSTRAINT empresa_pkey PRIMARY KEY (id);


--
-- Name: notificacion_mensaje notificacion_mensaje_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacion_mensaje
    ADD CONSTRAINT notificacion_mensaje_pkey PRIMARY KEY (id);


--
-- Name: role_permiso role_permiso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_permiso
    ADD CONSTRAINT role_permiso_pkey PRIMARY KEY (id);


--
-- Name: tarea_usuario tarea_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tarea_usuario
    ADD CONSTRAINT tarea_usuario_pkey PRIMARY KEY (id);


--
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


--
-- Name: idx_device_ack_application_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_ack_application_id ON public.device_ack USING btree (application_id);


--
-- Name: idx_device_ack_dev_eui; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_ack_dev_eui ON public.device_ack USING btree (dev_eui);


--
-- Name: idx_device_ack_received_at; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_ack_received_at ON public.device_ack USING btree (received_at);


--
-- Name: idx_device_ack_tags; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_ack_tags ON public.device_ack USING btree (tags);


--
-- Name: idx_device_error_application_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_error_application_id ON public.device_error USING btree (application_id);


--
-- Name: idx_device_error_dev_eui; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_error_dev_eui ON public.device_error USING btree (dev_eui);


--
-- Name: idx_device_error_received_at; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_error_received_at ON public.device_error USING btree (received_at);


--
-- Name: idx_device_error_tags; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_error_tags ON public.device_error USING btree (tags);


--
-- Name: idx_device_join_application_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_join_application_id ON public.device_join USING btree (application_id);


--
-- Name: idx_device_join_dev_eui; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_join_dev_eui ON public.device_join USING btree (dev_eui);


--
-- Name: idx_device_join_received_at; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_join_received_at ON public.device_join USING btree (received_at);


--
-- Name: idx_device_join_tags; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_join_tags ON public.device_join USING btree (tags);


--
-- Name: idx_device_location_application_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_location_application_id ON public.device_location USING btree (application_id);


--
-- Name: idx_device_location_dev_eui; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_location_dev_eui ON public.device_location USING btree (dev_eui);


--
-- Name: idx_device_location_received_at; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_location_received_at ON public.device_location USING btree (received_at);


--
-- Name: idx_device_location_tags; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_location_tags ON public.device_location USING btree (tags);


--
-- Name: idx_device_status_application_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_status_application_id ON public.device_status USING btree (application_id);


--
-- Name: idx_device_status_dev_eui; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_status_dev_eui ON public.device_status USING btree (dev_eui);


--
-- Name: idx_device_status_received_at; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_status_received_at ON public.device_status USING btree (received_at);


--
-- Name: idx_device_status_tags; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_status_tags ON public.device_status USING btree (tags);


--
-- Name: idx_device_up_application_id; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_up_application_id ON public.device_up USING btree (application_id);


--
-- Name: idx_device_up_dev_eui; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_up_dev_eui ON public.device_up USING btree (dev_eui);


--
-- Name: idx_device_up_dr; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_up_dr ON public.device_up USING btree (dr);


--
-- Name: idx_device_up_frequency; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_up_frequency ON public.device_up USING btree (frequency);


--
-- Name: idx_device_up_received_at; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_up_received_at ON public.device_up USING btree (received_at);


--
-- Name: idx_device_up_tags; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_device_up_tags ON public.device_up USING btree (tags);


--
-- Name: dispositivo dispositivo_empresa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dispositivo
    ADD CONSTRAINT dispositivo_empresa_id_fkey FOREIGN KEY (empresa_id) REFERENCES public.empresa(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: dispositivo dispositivo_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dispositivo
    ADD CONSTRAINT dispositivo_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuario(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: dispositivo dispositivo_my_device_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.dispositivo
    ADD CONSTRAINT dispositivo_my_device_name_fkey FOREIGN KEY (my_device_name) REFERENCES public.device_up(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: notificacion_mensaje notificacion_mensaje_id_destinatario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacion_mensaje
    ADD CONSTRAINT notificacion_mensaje_id_destinatario_fkey FOREIGN KEY (id_destinatario) REFERENCES public.usuario(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: notificacion_mensaje notificacion_mensaje_id_ispospositivo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.notificacion_mensaje
    ADD CONSTRAINT notificacion_mensaje_id_ispospositivo_fkey FOREIGN KEY (id_ispospositivo) REFERENCES public.device_up(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: role_permiso role_permiso_id_action_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.role_permiso
    ADD CONSTRAINT role_permiso_id_action_usuario_fkey FOREIGN KEY (id_action_usuario) REFERENCES public.usuario(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: tarea_usuario tarea_usuario_id_ispospositivo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tarea_usuario
    ADD CONSTRAINT tarea_usuario_id_ispospositivo_fkey FOREIGN KEY (id_ispospositivo) REFERENCES public.device_up(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: tarea_usuario tarea_usuario_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tarea_usuario
    ADD CONSTRAINT tarea_usuario_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuario(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: usuario usuario_empresa_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_empresa_id_fkey FOREIGN KEY (empresa_id) REFERENCES public.empresa(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: usuario usuario_my_device_name_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_my_device_name_fkey FOREIGN KEY (my_device_name) REFERENCES public.device_up(id) ON UPDATE CASCADE ON DELETE RESTRICT;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

GRANT USAGE ON SCHEMA public TO chirpstack;


--
-- PostgreSQL database dump complete
--

