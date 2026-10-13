--
-- PostgreSQL database dump
--

\restrict rBDEYnPHjrr3qCYkouaoiRkEgOKfOe0Z4Rt0hrYgX1slUonGb3Z3pF8LwCk3FS3

-- Dumped from database version 18.6
-- Dumped by pg_dump version 18.6

-- Started on 2026-10-14 01:02:04

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

--
-- TOC entry 5019 (class 0 OID 16466)
-- Dependencies: 224
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, nama, username, password, role) FROM stdin;
1	Fiki Azka	fikiiazka	$2y$10$A9M/C6KPcop7krGApfwknODxA8LZZD3/rHmGeYjDN83iaT9f0d3L2	petugas
2	Admin SIMPUS	admin	$2y$10$5T/xL3SxRvotpgGYv38m0ecIkNQXH.FK1gz4MigJpPWhUF59Ux2aC	admin
\.


--
-- TOC entry 5025 (class 0 OID 0)
-- Dependencies: 223
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 2, true);


-- Completed on 2026-10-14 01:02:05

--
-- PostgreSQL database dump complete
--

\unrestrict rBDEYnPHjrr3qCYkouaoiRkEgOKfOe0Z4Rt0hrYgX1slUonGb3Z3pF8LwCk3FS3

