-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 22-Jun-2019 às 23:43
-- Versão do servidor: 10.1.37-MariaDB
-- versão do PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `volei301`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogador`
--

CREATE TABLE `jogador` (
  `id_jogador` int(11) NOT NULL,
  `nome_jogador` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `elo_jogador` int(5) NOT NULL DEFAULT '1000',
  `login_jogador` varchar(55) COLLATE utf8_bin NOT NULL,
  `senha_jogador` varchar(55) COLLATE utf8_bin NOT NULL,
  `numero_vitorias` int(11) NOT NULL DEFAULT '0',
  `numero_derrotas` int(9) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `jogador`
--

INSERT INTO `jogador` (`id_jogador`, `nome_jogador`, `elo_jogador`, `login_jogador`, `senha_jogador`, `numero_vitorias`, `numero_derrotas`) VALUES
(1, 'Adryan', 962, '', '', 0, 0),
(2, 'Alice', 975, '', '', 0, 0),
(3, 'Amanda', 1025, '', '', 0, 0),
(4, 'André', 998, '', '', 0, 0),
(5, 'Attus', 1050, '', '', 0, 0),
(6, 'Bruna', 1025, '', '', 0, 0),
(7, 'Bryan', 952, '', '', 0, 0),
(8, 'Ellison', 949, '', '', 0, 0),
(9, 'Erick', 975, '', '', 0, 0),
(10, 'Esther', 975, '', '', 0, 0),
(11, 'Felipe', 1000, '', '', 0, 0),
(12, 'Gabriel', 975, '', '', 0, 0),
(13, 'Gregory', 1049, '', '', 0, 0),
(14, 'Henrique', 1050, '', '', 0, 0),
(15, 'João', 1000, '', '', 0, 0),
(16, 'Kiara', 949, '', '', 0, 0),
(17, 'Luana', 1000, '', '', 0, 0),
(18, 'Lucas L.', 1000, '', '', 0, 0),
(19, 'Lucas R.', 1050, '', '', 0, 0),
(20, 'Luiza', 952, '', '', 0, 0),
(21, 'Maicon', 1038, '', '', 0, 0),
(22, 'Mayara', 952, '', '', 0, 0),
(23, 'Moyses', 1049, '', '', 0, 0),
(24, 'Natan', 1050, '', '', 0, 0),
(25, 'Pablo', 952, '', '', 0, 0),
(26, 'Pedro', 952, '', '', 0, 0),
(27, 'Rafael', 1049, '', '', 0, 0),
(28, 'Raul', 1050, '', '', 0, 0),
(29, 'Telmo', 972, '', '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jogador`
--
ALTER TABLE `jogador`
  ADD PRIMARY KEY (`id_jogador`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jogador`
--
ALTER TABLE `jogador`
  MODIFY `id_jogador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
