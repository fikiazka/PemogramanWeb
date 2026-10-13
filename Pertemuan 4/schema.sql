--
-- PostgreSQL database dump
--

\restrict GxFo3iJfTenEqIWJkTmX8bscYPiZzFI6ihG978I1nhSbIiYGOagSYUQTd22Y8cI

-- Dumped from database version 18.6
-- Dumped by pg_dump version 18.6

-- Started on 2026-10-14 00:47:45

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 222 (class 1259 OID 16452)
-- Name: anggota; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.anggota (
    id integer NOT NULL,
    nama character varying(255) NOT NULL,
    no_anggota character varying(50) NOT NULL,
    alamat character varying(255),
    no_hp character varying(30)
);


ALTER TABLE public.anggota OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 16451)
-- Name: anggota_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.anggota_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.anggota_id_seq OWNER TO postgres;

--
-- TOC entry 5045 (class 0 OID 0)
-- Dependencies: 221
-- Name: anggota_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.anggota_id_seq OWNED BY public.anggota.id;


--
-- TOC entry 220 (class 1259 OID 16437)
-- Name: buku; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.buku (
    id integer NOT NULL,
    judul character varying(255) NOT NULL,
    pengarang character varying(255) NOT NULL,
    tahun integer NOT NULL,
    isbn character varying(50),
    stok integer DEFAULT 0 NOT NULL,
    kategori character varying(50)
);


ALTER TABLE public.buku OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16436)
-- Name: buku_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.buku_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.buku_id_seq OWNER TO postgres;

--
-- TOC entry 5046 (class 0 OID 0)
-- Dependencies: 219
-- Name: buku_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.buku_id_seq OWNED BY public.buku.id;


--
-- TOC entry 226 (class 1259 OID 16554)
-- Name: peminjaman; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.peminjaman (
    id integer NOT NULL,
    buku_id integer NOT NULL,
    anggota_id integer NOT NULL,
    tanggal_pinjam date DEFAULT CURRENT_DATE NOT NULL,
    tanggal_kembali date,
    status character varying(20) DEFAULT 'dipinjam'::character varying NOT NULL
);


ALTER TABLE public.peminjaman OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 16553)
-- Name: peminjaman_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.peminjaman_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.peminjaman_id_seq OWNER TO postgres;

--
-- TOC entry 5047 (class 0 OID 0)
-- Dependencies: 225
-- Name: peminjaman_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.peminjaman_id_seq OWNED BY public.peminjaman.id;


--
-- TOC entry 224 (class 1259 OID 16466)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id integer NOT NULL,
    nama character varying(100) NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(255) NOT NULL,
    role character varying(20) DEFAULT 'petugas'::character varying NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 16465)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- TOC entry 5048 (class 0 OID 0)
-- Dependencies: 223
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 4873 (class 2604 OID 16455)
-- Name: anggota id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.anggota ALTER COLUMN id SET DEFAULT nextval('public.anggota_id_seq'::regclass);


--
-- TOC entry 4871 (class 2604 OID 16440)
-- Name: buku id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.buku ALTER COLUMN id SET DEFAULT nextval('public.buku_id_seq'::regclass);


--
-- TOC entry 4876 (class 2604 OID 16557)
-- Name: peminjaman id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.peminjaman ALTER COLUMN id SET DEFAULT nextval('public.peminjaman_id_seq'::regclass);


--
-- TOC entry 4874 (class 2604 OID 16469)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 4882 (class 2606 OID 16464)
-- Name: anggota anggota_no_anggota_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.anggota
    ADD CONSTRAINT anggota_no_anggota_key UNIQUE (no_anggota);


--
-- TOC entry 4884 (class 2606 OID 16462)
-- Name: anggota anggota_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.anggota
    ADD CONSTRAINT anggota_pkey PRIMARY KEY (id);


--
-- TOC entry 4880 (class 2606 OID 16450)
-- Name: buku buku_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.buku
    ADD CONSTRAINT buku_pkey PRIMARY KEY (id);


--
-- TOC entry 4890 (class 2606 OID 16566)
-- Name: peminjaman peminjaman_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.peminjaman
    ADD CONSTRAINT peminjaman_pkey PRIMARY KEY (id);


--
-- TOC entry 4886 (class 2606 OID 16477)
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- TOC entry 4888 (class 2606 OID 16479)
-- Name: users users_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_key UNIQUE (username);


--
-- TOC entry 4891 (class 2606 OID 16572)
-- Name: peminjaman peminjaman_anggota_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.peminjaman
    ADD CONSTRAINT peminjaman_anggota_id_fkey FOREIGN KEY (anggota_id) REFERENCES public.anggota(id);


--
-- TOC entry 4892 (class 2606 OID 16567)
-- Name: peminjaman peminjaman_buku_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.peminjaman
    ADD CONSTRAINT peminjaman_buku_id_fkey FOREIGN KEY (buku_id) REFERENCES public.buku(id);


-- Completed on 2026-10-14 00:47:46

--
-- PostgreSQL database dump complete
--

\unrestrict GxFo3iJfTenEqIWJkTmX8bscYPiZzFI6ihG978I1nhSbIiYGOagSYUQTd22Y8cI

