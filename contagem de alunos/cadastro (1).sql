-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Dez-2022 às 02:17
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `contagem de alunos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `usuario`, `password`, `created_at`) VALUES
(1, 'Estelita_Fernanda1', '$2y$10$A1outjdslqq6jDjqctJWrOzm90ykH.mUQLhG6UjUxXnfl/EeHM8Ha', '2022-11-24 22:32:03'),
(2, 'Juininho_1', '$2y$10$6krFJR6.KCB8ELAd4Kk6.OxocHQgSKENobhZFmotOYdWWqxOr.YHa', '2022-11-25 20:57:35'),
(3, 'Maria_Eloiza1', '$2y$10$D1q5y6X6envvtOf9RWqVju50fL28./bNcOBy2.0vEobl03L2zLt/q', '2022-11-30 00:14:33'),
(4, 'Jean_Thaue2', '$2y$10$Fz4KnKXeGFs4GvRLbbnqeOU5ZLvDmWfs0OY5TT2.QzA0.MJ62UB1a', '2022-11-30 11:09:21'),
(5, 'Jean_Thaue1', '$2y$10$jekB2ug5vuOuFoiQARzme.o6A4mblr3ZvJhtjy1XPT.HUhnOFPHKO', '2022-11-30 11:10:23'),
(8, 'estelita_fernanda', '$2y$10$vMKuQ7vVLV/X.Zq8/ix7DeHViv0u/EAD0rmjklKepdBm2z26TPKle', '2022-12-02 12:17:23');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
