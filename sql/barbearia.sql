-- =====================================================
-- BANCO DE DADOS: BARBEARIA
-- Arquivo unificado com todas as tabelas
-- =====================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- =====================================================
-- Criar banco de dados (se não existir)
-- =====================================================
CREATE DATABASE IF NOT EXISTS `barbearia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `barbearia`;

-- =====================================================
-- Tabela: BARBEIROS
-- =====================================================
CREATE TABLE `barbeiros` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `email` varchar(100) NOT NULL,
    `senha` varchar(50) NOT NULL,
    `nome` varchar(100) NOT NULL,
    `descricao` varchar(300) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email`(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- Tabela: SERVICOS
-- =====================================================
CREATE TABLE `servicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servico` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- Tabela: USUARIOS (Clientes)
-- =====================================================
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `senha` (`senha`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- Tabela: AGENDAMENTO
-- (Criada por último por causa da FK com barbeiros)
-- =====================================================
CREATE TABLE `agendamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(50) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `barbeiro` int(11) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `horario` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `barbeiro` (`barbeiro`),
  CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`barbeiro`) REFERENCES `barbeiros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;