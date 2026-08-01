--
-- PostgreSQL database dump
--

\restrict IidRnTZ4jc3hgYodoeXaapz9XgjQSgsUMcna81d3oReXcg1IEvjH48FyghDWnDh

-- Dumped from database version 18.3
-- Dumped by pg_dump version 18.3

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
-- Data for Name: institutes; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO institutes VALUES (1, 'ABC', NULL, 'ABC-22', '01889421708', 'tfarukramim@gmail.com', NULL, 'logos/7SXV1pCsYqF0cfpeAfTLyCwTxNqJXcK652bDqSnZ.png', 'active', '2026-07-06 11:30:59', '2026-07-06 13:47:34');


--
-- Data for Name: projects; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO projects VALUES (1, 1, 'ASSET', NULL, 'ASSET', NULL, 'active', '2026-07-06 12:14:02', '2026-07-06 13:50:37');
INSERT INTO projects VALUES (2, 1, 'NHRDF', NULL, 'NHRDF', NULL, 'active', '2026-07-06 12:14:02', '2026-07-06 12:14:02');
INSERT INTO projects VALUES (3, 1, 'ISEC', NULL, 'ISEC', NULL, 'active', '2026-07-06 12:14:02', '2026-07-06 12:14:02');


--
-- Data for Name: courses; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO courses VALUES (1, 1, 'ITSS', 'ITSS 2', '6', 0.00, 24, 'NA', 'active', '2026-07-06 11:44:22', '2026-07-06 12:14:02', 1);
INSERT INTO courses VALUES (2, 1, 'DMF', 'DMF', '6', 0.00, 50, 'NA', 'active', '2026-07-06 12:46:48', '2026-07-06 12:46:48', 3);


--
-- Data for Name: batches; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO batches VALUES (1, 1, 1, 'ASSET-4TH-CYCLE', 'ASSET-4TH-CYCLE', '2026-07-07', '2026-07-23', 'Morning', 24, 'active', '2026-07-06 11:46:11', '2026-07-06 12:14:02', 1);


--
-- Data for Name: students; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO students VALUES (1, 1, 1, 1, 'Tanvir Bin Faruk Ramim', 'Tanvir Bin Faruk Ramim', 'h', 'h', 'h', 'h', '01991988602', 'tfarukramim@gmail.com', '2026-06-30', 'Male', 'Islam', 'Bangladeshi', 'A-', 'NID', '2565235624', 'Student', '01991988602', 'Ma', 'hh', NULL, 'hh', 'hh', 'jj', 'Dhaka', NULL, NULL, NULL, NULL, NULL, NULL, 'JSC/JDC', 'jjj', 2022, 'hhh', 'Near Hashemiya Madrasha, Cox''s Bazar Sadar', NULL, NULL, NULL, 'admitted', 'STP-M2PCYOMO', '2026-07-06 11:50:52', '2026-07-06 12:14:02', 1);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO users VALUES (1, 'Ramim', 'tfarukramim@gmail.com', NULL, '$2y$12$mpLAe/BVrYs/r7RICJjExuQr5kByU/Ig5lvmJV./JoopouuAQynmK', NULL, '2026-07-06 11:31:00', '2026-07-08 12:26:03', 1, '01889421708', 'admin', true);


--
-- Data for Name: activity_logs; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO activity_logs VALUES (1, 1, 'batch_changed', 'Batch changed from ASSET-4TH-CYCLE to ASSET-4TH-CYCLE', 'ASSET-4TH-CYCLE', 'ASSET-4TH-CYCLE', 1, '2026-07-06 13:25:46', '2026-07-06 13:25:46');
INSERT INTO activity_logs VALUES (2, 1, 'batch_changed', 'Batch changed from ASSET-4TH-CYCLE to ASSET-4TH-CYCLE', 'ASSET-4TH-CYCLE', 'ASSET-4TH-CYCLE', 1, '2026-07-06 13:52:37', '2026-07-06 13:52:37');


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO migrations VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO migrations VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO migrations VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO migrations VALUES (4, '2026_07_06_065957_create_institutes_table', 1);
INSERT INTO migrations VALUES (5, '2026_07_06_070014_add_institute_fields_to_users_table', 1);
INSERT INTO migrations VALUES (6, '2026_07_06_070251_create_courses_table', 1);
INSERT INTO migrations VALUES (7, '2026_07_06_070724_create_batches_table', 1);
INSERT INTO migrations VALUES (8, '2026_07_06_071107_add_is_super_admin_to_users_table', 1);
INSERT INTO migrations VALUES (9, '2026_07_06_071904_create_students_table', 1);
INSERT INTO migrations VALUES (10, '2026_07_06_181258_create_projects_table', 1);
INSERT INTO migrations VALUES (11, '2026_07_06_181306_add_project_id_to_courses_table', 1);
INSERT INTO migrations VALUES (12, '2026_07_06_181311_add_project_id_to_batches_table', 1);
INSERT INTO migrations VALUES (13, '2026_07_06_181315_add_project_id_to_students_table', 1);
INSERT INTO migrations VALUES (14, '2026_07_06_192108_create_activity_logs_table', 1);


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO sessions VALUES ('0JydAzMzDOjVwjZFPmsDU6mcUCzO1vNsFUZ3iWmA', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'eyJfdG9rZW4iOiJlZXpVY0RidzFqSzk0ck4zNk1aclJOOVF5NUVNbjBuME5MeWg1dzViIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1783535042);
INSERT INTO sessions VALUES ('41zeS48PDTH1DziXkIIHCdOfhyECMoX7OZOL8Qqo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'eyJfdG9rZW4iOiJyU0tyOWdLZFdUMkhBME9vcDhsWlpjblpQdVdEcEpETW0wVldCTTA5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbX19', 1783534993);
INSERT INTO sessions VALUES ('DnabL7iihZ9mvS4r9sBGetvLmK49efdWY19YiBPk', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI3bEtQdjZpQ3Y3Ujd6Z2R1em5yNWJGcFoxdEJDMlJIT2FpY043UEg3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxfQ==', 1783533889);
INSERT INTO sessions VALUES ('PsW3D6jZTsu7FdKDvsOiFPb93JhxZNXs7JbvxrIx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'eyJfdG9rZW4iOiJlWllscVgzeW1WZHV1cDcyUEhmQ1ZJbnJlYWM0dFgzcXhwZmo2VldqIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCIsInJvdXRlIjpudWxsfSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1783545586);
INSERT INTO sessions VALUES ('v9OUgtYAphCqnHYY6cGc2x8b5bjPaqlKIsHvE1X9', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'eyJfdG9rZW4iOiJYZktmU0E0YW5ZUHRLTHBod2dQc3Y4TDM1OEVvU0kxbElkU2VtQ0FYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6Ly8xMjcuMC4wLjE6MDAwL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sIl9mbGFzaCI6eyJvbGQiOJOXSwibmV3IjpbXX0sImxvZ2luX3dlYl80OWJhYzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYWI0MzA5ODlkIjoxLCJjdXJyZW50X3Byb2plY3RfaWQiOjF9', 1783535693);
INSERT INTO sessions VALUES ('kbaM0CQHY1wYGmTHtmBzJ0Q8LjiTacNaqhU9cxJP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'eyJfdG9rZW4iOiIxd0lFc05qYUR0UHVXdjZyM21ST0x4TGxMZGNPRjRMNGdQMXJCb05vIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1783546386);
INSERT INTO sessions VALUES ('kAG1GJPnfpSmxSroJzlAO3iBkphXRXx6ZpllW3h9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'eyJfdG9rZW4iOiJOQjBoMVFDdG1vUGw3SFZNbVBXN0w5elhZSmZPcTVSR0hwZm9FVDNSIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1783546387);
INSERT INTO sessions VALUES ('0EApHz0pupbvPZrrnxppDy1nCX9zC1aPpKIFAlPy', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'eyJfdG9rZW4iOiJUWEpWam95OXNiYVBQT3N5cGtza1lXeHc4U3UzM3c0VjZWQTdwOHlxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1783547763);
INSERT INTO sessions VALUES ('FKVisyu3UCN4geuEGRamvtVzodo5SRA4mdn8EqA9', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:152.0) Gecko/20100101 Firefox/152.0', 'eyJfdG9rZW4iOiJmUWFEYTJWYUd1ZUgzRmxrYmVFWW1iNlVWSVVtT0RUbmp6elhUVXh2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvcGhwXC9sYXJhdmVsXC90cmFpbm5pbmciLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1783548752);


--
-- Name: activity_logs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.activity_logs_id_seq', 2, true);


--
-- Name: batches_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.batches_id_seq', 1, true);


--
-- Name: courses_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.courses_id_seq', 2, true);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: institutes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.institutes_id_seq', 1, true);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.migrations_id_seq', 14, true);


--
-- Name: projects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.projects_id_seq', 3, true);


--
-- Name: students_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.students_id_seq', 1, true);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 1, true);


--
-- PostgreSQL database dump complete
--

\unrestrict IidRnTZ4jc3hgYodoeXaapz9XgjQSgsUMcna81d3oReXcg1IEvjH48FyghDWnDh


