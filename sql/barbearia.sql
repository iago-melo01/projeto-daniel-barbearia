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
  UNIQUE KEY `email` (`email`)
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- Tabela: AGENDAMENTO
-- (Criada por último por causa da FK com barbeiros)
-- =====================================================
CREATE TABLE `agendamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cliente` varchar(50) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `telefone_cliente` varchar(13) NOT NULL,
  `barbeiro` int(11) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `horario` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `barbeiro` (`barbeiro`),
  CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`barbeiro`) REFERENCES `barbeiros` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- DADOS DE TESTE
-- =====================================================

-- =====================================================
-- Inserir BARBEIROS
-- =====================================================
INSERT INTO `barbeiros` (`email`, `senha`, `nome`, `descricao`) VALUES
('joao.silva@barbearia.com', '123456', 'João Silva', 'Especialista em cortes clássicos e modernos. 10 anos de experiência.'),
('carlos.santos@barbearia.com', '123456', 'Carlos Santos', 'Mestre em barbas e bigodes. Tradição e qualidade.'),
('pedro.oliveira@barbearia.com', '123456', 'Pedro Oliveira', 'Especialista em cortes degradê e fades. Estilo contemporâneo.'),
('rafael.costa@barbearia.com', '123456', 'Rafael Costa', 'Barbeiro completo: cortes, barbas e tratamentos. 8 anos de experiência.');

-- =====================================================
-- Inserir SERVIÇOS
-- =====================================================
INSERT INTO `servicos` (`servico`, `descricao`, `preco`, `imagem`) VALUES
('Corte Masculino', 'Corte de cabelo masculino com tesoura e máquina. Inclui acabamento e penteado.', 35.00, 'https://via.placeholder.com/300x200?text=Corte+Masculino'),
('Corte + Barba', 'Corte de cabelo completo + barba aparada e desenhada. Serviço completo.', 50.00, 'https://via.placeholder.com/300x200?text=Corte+Barba'),
('Barba Completa', 'Aparar, desenhar e modelar a barba. Inclui tratamento com produtos.', 25.00, 'https://via.placeholder.com/300x200?text=Barba+Completa'),
('Corte Degradê', 'Corte moderno com degradê perfeito. Estilo contemporâneo e versátil.', 40.00, 'https://via.placeholder.com/300x200?text=Degrade'),
('Corte + Sobrancelha', 'Corte de cabelo + design de sobrancelhas. Look completo e harmonioso.', 45.00, 'https://via.placeholder.com/300x200?text=Corte+Sobrancelha'),
('Relaxamento Capilar', 'Tratamento relaxante para o couro cabeludo. Massagem e produtos especiais.', 30.00, 'https://via.placeholder.com/300x200?text=Relaxamento'),
('Corte Social', 'Corte tradicional e elegante. Ideal para eventos e ocasiões especiais.', 38.00, 'https://via.placeholder.com/300x200?text=Corte+Social'),
('Barba + Bigode', 'Aparar barba e bigode com precisão. Design personalizado.', 22.00, 'https://via.placeholder.com/300x200?text=Barba+Bigode');

-- =====================================================
-- Inserir USUARIOS (Clientes)
-- =====================================================
INSERT INTO `usuarios` (`cliente`, `email`, `senha`, `telefone`) VALUES
('Lucas Ferreira', 'lucas.ferreira@email.com', 'senha123', '11987654321'),
('Marcos Almeida', 'marcos.almeida@email.com', 'senha123', '11976543210'),
('Bruno Rodrigues', 'bruno.rodrigues@email.com', 'senha123', '11965432109'),
('Felipe Souza', 'felipe.souza@email.com', 'senha123', '11954321098'),
('Ricardo Lima', 'ricardo.lima@email.com', 'senha123', '11943210987'),
('André Martins', 'andre.martins@email.com', 'senha123', '11932109876'),
('Thiago Pereira', 'thiago.pereira@email.com', 'senha123', '11921098765'),
('Gustavo Rocha', 'gustavo.rocha@email.com', 'senha123', '11910987654');

-- =====================================================
-- Inserir AGENDAMENTOS
-- =====================================================
INSERT INTO `agendamento` (`nome_cliente`, `email_cliente`,`telefone_cliente`, `barbeiro`, `servico`, `horario`) VALUES
('Lucas Ferreira', 'lucas.ferreira@email.com','83 9653-4944' ,1, 'Corte Masculino', '2025-01-15 10:00:00'),
('Marcos Almeida', 'marcos.almeida@email.com','83 9653-4944',2, 'Corte + Barba', '2025-01-15 11:00:00'),
('Bruno Rodrigues', 'bruno.rodrigues@email.com','83 9653-4944' ,1, 'Corte Degradê', '2025-01-15 14:00:00'),
('Felipe Souza', 'felipe.souza@email.com','83 9653-4944' ,3, 'Barba Completa', '2025-01-16 09:00:00'),
('Ricardo Lima', 'ricardo.lima@email.com','83 9653-4944' ,2, 'Corte + Sobrancelha', '2025-01-16 10:30:00'),
('André Martins', 'andre.martins@email.com','83 9653-4944' ,4, 'Corte Masculino', '2025-01-16 15:00:00'),
('Thiago Pereira', 'thiago.pereira@email.com','83 9653-4944' ,1, 'Corte + Barba', '2025-01-17 11:00:00'),
('Gustavo Rocha', 'gustavo.rocha@email.com','83 9653-4944' ,3, 'Corte Social', '2025-01-17 16:00:00'),
('Lucas Ferreira', 'lucas.ferreira@email.com','83 9653-4944' ,2, 'Relaxamento Capilar', '2025-01-18 10:00:00'),
('Marcos Almeida', 'marcos.almeida@email.com','83 9653-4944' ,4, 'Barba + Bigode', '2025-01-18 14:30:00');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;