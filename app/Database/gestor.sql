-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Maio-2023 às 09:24
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestor`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `classificacao_cliente`
--

CREATE TABLE `classificacao_cliente` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `classificacao_cliente`
--

INSERT INTO `classificacao_cliente` (`id`, `descricao`) VALUES
(3, 'APAE'),
(1, 'Associação'),
(12, 'Conselho Metrop. Juiz de Fora'),
(2, 'Doméstica'),
(5, 'Hospital'),
(4, 'ILPI'),
(6, 'Lucro Presumido'),
(7, 'Lucro Real'),
(8, 'MEI'),
(10, 'Outros'),
(11, 'Pessoa física'),
(9, 'Simples Nacional');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(9) UNSIGNED NOT NULL,
  `codigo` int(5) UNSIGNED NOT NULL,
  `cnpj` varchar(25) NOT NULL,
  `razao` varchar(255) NOT NULL,
  `apelido` varchar(150) NOT NULL,
  `ie` varchar(150) DEFAULT NULL,
  `codigosimples` varchar(150) DEFAULT NULL,
  `cpfempresario` varchar(15) DEFAULT NULL,
  `empresario` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `clientedesde` date DEFAULT NULL,
  `contato` varchar(80) DEFAULT NULL,
  `tipocertificado` varchar(20) DEFAULT NULL,
  `vectocertificado` date DEFAULT NULL,
  `qtdefuncionarios` int(10) DEFAULT 0,
  `regimetributario` varchar(100) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 0,
  `controlacnd` tinyint(1) DEFAULT NULL,
  `movimentocontabil` tinyint(1) DEFAULT NULL,
  `obs` varchar(1000) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id`, `codigo`, `cnpj`, `razao`, `apelido`, `ie`, `codigosimples`, `cpfempresario`, `empresario`, `telefone`, `email`, `clientedesde`, `contato`, `tipocertificado`, `vectocertificado`, `qtdefuncionarios`, `regimetributario`, `tipo`, `ativo`, `controlacnd`, `movimentocontabil`, `obs`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 12, '11.111.111/1111-11', 'Supermercado Três Irmãos', 'JK', '1234', '1234', '123.456.899-00', '', '', '', '2019-02-27', '', 'a3', '2023-05-26', 67, '4', '1', 0, 0, 1, '', '2023-05-23 15:01:22', '2023-05-24 00:19:03', NULL),
(4, 150, '02.095.711/0001-12', 'Escritório de Contabilidade', 'Contabilidade Total', '12345678', '456', '123.456.899-23', 'José Carlos', '(32) 3573-1485', 'adilson.teste@email.com', '2023-05-02', 'master', 'a1', '2023-06-09', 10, '3', '6', 1, 1, 0, 'teste', '2023-05-23 15:24:38', '2023-05-24 01:24:13', NULL),
(5, 122, '02.095.711/0001-22', 'Hospital São Vicente de Paulo', 'HSVP Rio Pomba', '1234567899', '33336', '111.111.222-33', 'Fabiana Dias', '', 'hospital.svp@email.com.br', '2020-09-28', 'Paulo Vitor', 'a1', '2023-05-29', 15, '1', '2', 1, 1, 1, 'envia variáveis para a folha de pagamento', '2023-05-23 15:34:13', '2023-05-23 23:34:03', NULL),
(7, 3, '00.000.000/0000-01', 'Associação de Pais e Amigos dos Excepcionais', 'Apae Piraúba', '12', '12', '111.111.111-11', 'Lúcia', '(11) 2323-5689', 'apae@email.com', '2018-01-01', 'Lúcia', 'a1', '2023-06-10', 0, '2', '6', 1, 1, 1, '', '2023-05-24 01:22:23', '2023-05-24 01:22:23', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(9) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `departamentos`
--

INSERT INTO `departamentos` (`id`, `nome`, `descricao`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(4, 'Depto Pessoal', NULL, '2023-05-22 19:52:04', '2023-05-22 19:52:04', NULL),
(5, 'Administração', NULL, '2023-05-22 19:52:04', '2023-05-22 19:52:04', NULL),
(6, 'Depto Fiscal', NULL, '2023-05-22 23:27:36', '2023-05-22 23:27:36', NULL),
(7, 'Depto Contábil', NULL, '2023-05-22 23:27:36', '2023-05-22 23:27:36', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

CREATE TABLE `grupos` (
  `id` int(9) UNSIGNED NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `exibir` tinyint(1) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`id`, `nome`, `descricao`, `exibir`, `criado_em`, `atualizado_em`, `deletado_em`) VALUES
(1, 'Administração', 'Grupo com acesso total ao sistema, sem nenhum tipo de restrição. Pode criar usuários, grupos e conceder ou revogar permissão de usuários', 1, '2023-05-18 15:59:20', '2023-05-18 15:59:20', NULL),
(4, 'Depto Pessoal', 'Este grupo permite acesso ao módulo de departamento pessoal', 0, '2023-05-18 16:46:47', '2023-05-18 16:46:47', NULL),
(5, 'Depto Fiscal', 'Permite acesso ao módulo departamento fiscal', 1, '2023-05-18 17:38:27', '2023-05-18 17:38:27', NULL),
(6, 'Depto Contábil', 'Permite acesso ao módulo departamento contábil', 0, '2023-05-18 17:38:27', '2023-05-18 17:38:27', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-05-17-135511', 'App\\Database\\Migrations\\TabUsuarios', 'default', 'App', 1684332500, 1),
(3, '2023-05-18-013637', 'App\\Database\\Migrations\\TabUsuariosAddUltimologin', 'default', 'App', 1684374140, 2),
(4, '2023-05-18-185414', 'App\\Database\\Migrations\\TabGrupos', 'default', 'App', 1684436334, 3),
(6, '2023-05-22-194416', 'App\\Database\\Migrations\\Departamento', 'default', 'App', 1684785272, 5),
(8, '2023-05-23-155543', 'App\\Database\\Migrations\\TabClientes', 'default', 'App', 1684864453, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `depto` int(9) NOT NULL,
  `id` int(9) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(80) DEFAULT NULL,
  `reset_expira_em` datetime DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  `atualizado_em` datetime DEFAULT NULL,
  `deletado_em` datetime DEFAULT NULL,
  `ultimo_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`depto`, `id`, `nome`, `email`, `password_hash`, `reset_hash`, `reset_expira_em`, `imagem`, `ativo`, `criado_em`, `atualizado_em`, `deletado_em`, `ultimo_login`) VALUES
(5, 8271, 'Linda', 'linda@email.com', '$2y$10$USlHMoPaNCZ.kAJBxJ.N3.UFmZDuyu/i9ZfRvD1nUyamIWwTL5uYe', NULL, NULL, NULL, 0, '2023-05-22 21:28:41', '2023-05-23 07:42:41', '2023-05-23 07:42:41', NULL),
(6, 8272, 'Maria Fernanda', 'email.da.maria@email.com.br', '$2y$10$CyxgTWhd4uAkBOUiRI5LuuB/.raQEDa7fTB5yS1v/0ivzYn7r/S.O', NULL, NULL, '1684889432_cdae220684538544b2cb.jpg', 0, '2023-05-22 21:30:06', '2023-05-23 21:50:32', NULL, NULL),
(4, 8273, 'Maria2', 'email12@email.com.br', '$2y$10$u4rHPdMQ8OF/dXJJ8vCuWunH6clFg3WaSGxz7Eg5cK7RPP4wY/x7C', NULL, NULL, NULL, 0, '2023-05-22 21:31:13', '2023-05-23 07:43:08', '2023-05-23 07:43:08', NULL),
(4, 8274, 'Maria23', 'email123@email.com.br', '$2y$10$8k6xIUHzdwNLMxUvz1CJM.h942HymTmZxLehhBjU8bZtN1YGbYCgm', NULL, NULL, NULL, 0, '2023-05-22 21:32:02', '2023-05-23 07:43:01', '2023-05-23 07:43:01', NULL),
(5, 8275, 'Linda2', 'linda1@email.com', '$2y$10$X88g/9Vk.o6SNCdmMg4Q3eoRz/80FkUUwK.VX0tzOlGBKpG5Kps4C', NULL, NULL, NULL, 0, '2023-05-22 21:33:15', '2023-05-23 07:42:50', '2023-05-23 07:42:50', NULL),
(4, 8276, 'Amanda Dias', 'amanda.dias@email.com', '$2y$10$3VEH4qKctLf4E35nyS6qUeaE8KRy0voldp9t81NY7VuAJFK4.Zsn.', NULL, NULL, NULL, 0, '2023-05-22 21:35:28', '2023-05-23 07:48:27', '2023-05-23 07:48:27', NULL),
(5, 8277, 'Amanda Dias1', 'amanda.dias1@email.com', '$2y$10$Q4fW9rXieDTC0ym0I49ouOdiNOcJjyMQHlJPPLvXAoSBk/rYRKHPG', NULL, NULL, NULL, 0, '2023-05-22 21:43:35', '2023-05-23 07:42:33', '2023-05-23 07:42:33', NULL),
(5, 8278, 'Amanda Dias2', 'amanda.dias2@email.com', '$2y$10$aBBNRy1bKLL9/lfG8kKPf.1uLnPsX8nIlrAVNu50dVqfUzFvUb/v.', NULL, NULL, NULL, 0, '2023-05-22 21:47:51', '2023-05-23 07:56:23', '2023-05-23 07:56:23', NULL),
(0, 8279, 'Amanda Dias3', 'amanda.dias3@email.com', '$2y$10$t7z9Kz5uDz4/NYo1z4gaE.Fc7OZ7hCzvEvFIIl7fw5lxiw76cj3Xy', NULL, NULL, NULL, 0, '2023-05-22 21:55:42', '2023-05-23 07:46:24', '2023-05-23 07:46:24', NULL),
(5, 8280, 'Linda5', 'linda5@email.com.br', '$2y$10$lTKfabByCTI4xJCZue8CYerqHT0evrAxApt4GMH38lKM8DPVaI0LS', NULL, NULL, NULL, 0, '2023-05-22 22:09:48', '2023-05-23 07:48:50', '2023-05-23 07:48:50', NULL),
(7, 8281, 'Adilson', 'adilson.teste@email.com', '$2y$10$IUNgsDe3UYHq26exNWRrXOhD8IEHtu3gJOXYuLAnByFmsE7KtxP86', NULL, NULL, '1684849407_e96fb35e67aae9967767.jpg', 1, '2023-05-22 22:12:36', '2023-05-23 10:43:27', NULL, NULL),
(6, 8282, 'Adilson2', 'adils2@email.com', '$2y$10$fyAlVn/C6O5VpIM51rcZd.8kdoYmscsvdkkWwlNJKDtAklX2R3ub.', NULL, NULL, NULL, 0, '2023-05-22 22:15:34', '2023-05-23 07:42:07', '2023-05-23 07:42:07', NULL),
(4, 8283, 'Amanda Dias6', 'amanda.dias6@email.com', '$2y$10$tszXpfvZryJVFEHuIUlyHuPJbwCbAvYGzapWxUT1919G41H.qrmtS', NULL, NULL, NULL, 0, '2023-05-22 22:19:41', '2023-05-23 07:43:17', '2023-05-23 07:43:17', NULL),
(4, 8284, 'Adilson5', 'amanda.dias5@email.com', '$2y$10$WtC3icjlRzMcAww4lNiFsufUfTHeEoMhhfVt2eGsVUNaT1b.WJ0Qq', NULL, NULL, NULL, 0, '2023-05-22 22:21:04', '2023-05-23 07:41:52', '2023-05-23 07:41:52', NULL),
(4, 8285, 'Adilson5', 'amanda.dias8@email.com', '$2y$10$9QfKgtdsihB1AhEmJ.ZcfepH.bdXdjntk/3lQKHr1SO.ju25JK69q', NULL, NULL, NULL, 0, '2023-05-22 22:21:34', '2023-05-23 07:42:01', '2023-05-23 07:42:01', NULL),
(4, 8286, 'Adilson7', 'adils77@email.com', '$2y$10$EPyjOVAA9kCAabsw03s.5uU/.ZVzzOqw.Odp1PUT49tKKA5kz8ft6', NULL, NULL, NULL, 0, '2023-05-22 22:24:42', '2023-05-23 07:41:24', '2023-05-23 07:41:24', NULL),
(4, 8287, 'Adilson77', 'adilson77@email.com', '$2y$10$xCnbBW5/OGgGZZZZEw.lseFR152SlVpHkFnZipyqDRUM/9Xtl7FMm', NULL, NULL, NULL, 0, '2023-05-22 22:26:37', '2023-05-23 07:41:12', '2023-05-23 07:41:12', NULL),
(0, 8288, 'Adilson8', 'adils8@email.com', '$2y$10$mMyHrxxtE0lh7607wJI8z.D6B.Gi/V8yrdq0gLc/OxhsjEKl797Ki', NULL, NULL, NULL, 0, '2023-05-22 22:31:40', '2023-05-23 07:41:35', '2023-05-23 07:41:35', NULL),
(4, 8289, 'Adilson88', 'adils88@email.com', '$2y$10$j0QDQP/lJOF1oLrdJo1Q2.b/KfQWci1NmZVCahkHPL//0DEGHbNpy', NULL, NULL, NULL, 0, '2023-05-22 22:34:04', '2023-05-23 07:42:24', '2023-05-23 07:42:24', NULL),
(7, 8290, 'Isabela', 'isabela@email.com.br', '$2y$10$OibjCWCxSDUVgEsGmixoouGRgWwj.dviZQ2kJVj1zaAVlIcU2a7km', NULL, NULL, '1684809086_236103286de5d68768d7.jpg', 1, '2023-05-22 23:31:26', '2023-05-22 23:31:26', NULL, NULL),
(6, 8291, 'Carlos Dias', 'carlos.dias@email.com.br', '$2y$10$XgeMKXnTaCugA4JAYVCIlez9q3uMW8A5it6m/JSEGfifzyBjgdIjS', NULL, NULL, '1684897856_15d288ed4a5a48b3d21b.jpg', 1, '2023-05-23 00:04:14', '2023-05-24 00:10:56', NULL, NULL),
(7, 8292, 'Cristinao Gomes', 'cristiano.gomes@email.com', '$2y$10$2940duqvFE96ByLuP3mKmeKhRqS5/E4Q6TCDTHUUrDzxJg5Xr//Im', NULL, NULL, NULL, 0, '2023-05-23 00:23:40', '2023-05-23 07:43:28', '2023-05-23 07:43:28', NULL),
(7, 8293, 'Cristinao Gomes2', 'marcosimperatori@gmail.com', '$2y$10$43rRQLE./nXJDUWcrZUPi.C8.c6PdYlJRXEWbI/DyVe9xFUa1aYdi', NULL, NULL, NULL, 0, '2023-05-23 08:01:11', '2023-05-23 08:02:17', '2023-05-23 08:02:17', NULL),
(7, 8294, 'Cristinao Gomes3', 'cristiano.gomes2@email.com', '$2y$10$7IEZ5UXccgV5TkV//v/QjusztM9jQ2DPnr5/nOO/nu5EyvlIFr0Nm', NULL, NULL, NULL, 0, '2023-05-23 08:51:44', '2023-05-23 12:39:47', '2023-05-23 12:39:47', NULL),
(4, 8295, 'teste', 'email1234@email.com.br', '$2y$10$y5q.IzGbvrYfYpszdZpQU.J3z7ZE3h8DpVzHjcR1yYjyfMqRFC5Ai', NULL, NULL, NULL, 0, '2023-05-23 10:02:17', '2023-05-23 12:24:45', '2023-05-23 12:24:45', NULL),
(4, 8296, 'Adriana da Silva Pereira', 'adriana.silva.pereira@outlook.com', '$2y$10$.TbA5mOaodcrXM0ocWbUYeFO0YtL1NSa/pyYnPDLdvCCauGLHpMsi', NULL, NULL, '1684860410_0c91377875c287ef77ad.jpg', 1, '2023-05-23 13:46:50', '2023-05-23 13:46:50', NULL, NULL),
(5, 8297, 'Usuário Teste', 'usuario.teste@email.com.br', '$2y$10$4XGqE2pF9Rv.HrMiEDHmUeA8IYW9c88MbPnchTvHRoLgICYhzPeN6', NULL, NULL, NULL, 0, '2023-05-24 00:13:57', '2023-05-24 00:13:57', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `classificacao_cliente`
--
ALTER TABLE `classificacao_cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `un_descricao` (`descricao`);

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `razao` (`razao`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `classificacao_cliente`
--
ALTER TABLE `classificacao_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(9) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8298;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
