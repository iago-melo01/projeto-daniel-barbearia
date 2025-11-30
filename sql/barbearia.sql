-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/11/2025 às 22:43
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `barbearia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamento`
--

CREATE TABLE `agendamento` (
  `id` int(11) NOT NULL,
  `nome_cliente` varchar(50) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `telefone_cliente` varchar(13) NOT NULL,
  `barbeiro` int(11) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `horario` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `agendamento`
--

INSERT INTO `agendamento` (`id`, `nome_cliente`, `email_cliente`, `telefone_cliente`, `barbeiro`, `servico`, `horario`) VALUES
(1, 'Lucas Ferreira', 'lucas.ferreira@email.com', '83 9653-4944', 1, 'Corte Masculino', '2025-01-15 10:00:00'),
(2, 'Marcos Almeida', 'marcos.almeida@email.com', '83 9653-4944', 2, 'Corte + Barba', '2025-01-15 11:00:00'),
(3, 'Bruno Rodrigues', 'bruno.rodrigues@email.com', '83 9653-4944', 1, 'Corte Degradê', '2025-01-15 14:00:00'),
(4, 'Felipe Souza', 'felipe.souza@email.com', '83 9653-4944', 3, 'Barba Completa', '2025-01-16 09:00:00'),
(5, 'Ricardo Lima', 'ricardo.lima@email.com', '83 9653-4944', 2, 'Corte + Sobrancelha', '2025-01-16 10:30:00'),
(6, 'André Martins', 'andre.martins@email.com', '83 9653-4944', 4, 'Corte Masculino', '2025-01-16 15:00:00'),
(7, 'Thiago Pereira', 'thiago.pereira@email.com', '83 9653-4944', 1, 'Corte + Barba', '2025-01-17 11:00:00'),
(8, 'Gustavo Rocha', 'gustavo.rocha@email.com', '83 9653-4944', 3, 'Corte Social', '2025-01-17 16:00:00'),
(9, 'Lucas Ferreira', 'lucas.ferreira@email.com', '83 9653-4944', 2, 'Relaxamento Capilar', '2025-01-18 10:00:00'),
(10, 'Marcos Almeida', 'marcos.almeida@email.com', '83 9653-4944', 4, 'Barba + Bigode', '2025-01-18 14:30:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `barbeiros`
--

CREATE TABLE `barbeiros` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `barbeiros`
--

INSERT INTO `barbeiros` (`id`, `email`, `senha`, `nome`, `descricao`) VALUES
(1, 'joao.silva@barbearia.com', '123456', 'João Silva', 'Especialista em cortes clássicos e modernos. 10 anos de experiência.'),
(2, 'carlos.santos@barbearia.com', '123456', 'Carlos Santos', 'Mestre em barbas e bigodes. Tradição e qualidade.'),
(3, 'pedro.oliveira@barbearia.com', '123456', 'Pedro Oliveira', 'Especialista em cortes degradê e fades. Estilo contemporâneo.'),
(4, 'rafael.costa@barbearia.com', '123456', 'Rafael Costa', 'Barbeiro completo: cortes, barbas e tratamentos. 8 anos de experiência.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `servicos`
--

CREATE TABLE `servicos` (
  `id` int(11) NOT NULL,
  `servico` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `servicos`
--

INSERT INTO `servicos` (`id`, `servico`, `descricao`, `preco`, `imagem`) VALUES
(1, 'Corte Masculino', 'Corte de cabelo masculino com tesoura e máquina. Inclui acabamento e penteado.', 35.00, 'https://pvbeauty.com.br/wp-content/uploads/2024/08/corte-de-cabelo-moicano-masculino-pv-beauty-17.webp'),
(2, 'Corte + Barba', 'Corte de cabelo completo + barba aparada e desenhada. Serviço completo.', 50.00, 'https://i.pinimg.com/564x/3f/25/d4/3f25d444ea12db44d013335b4ce585aa.jpg'),
(3, 'Barba Completa', 'Aparar, desenhar e modelar a barba. Inclui tratamento com produtos.', 25.00, 'https://img.freepik.com/fotos-gratis/jovem-arrumando-a-barba-no-barbeiro_23-2148985728.jpg?semt=ais_hybrid&w=740&q=80'),
(4, 'Corte + Sobrancelha', 'Corte de cabelo + design de sobrancelhas. Look completo e harmonioso.', 45.00, 'https://siterg.uol.com.br/wp-content/uploads/2020/09/1000-1000-4sobrancelha-divulgacao-1000x600.jpg'),
(5, 'Relaxamento Capilar', 'Tratamento relaxante para o couro cabeludo. Massagem e produtos especiais.', 30.00, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbDdhkbMH7h8A9r1WjgRJRTBzohd3k0xQAWw&s');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cliente` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `telefone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `cliente`, `email`, `senha`, `telefone`) VALUES
(1, 'Lucas Ferreira', 'lucas.ferreira@email.com', 'senha123', '11987654321'),
(2, 'Marcos Almeida', 'marcos.almeida@email.com', 'senha123', '11976543210'),
(3, 'Bruno Rodrigues', 'bruno.rodrigues@email.com', 'senha123', '11965432109'),
(4, 'Felipe Souza', 'felipe.souza@email.com', 'senha123', '11954321098'),
(5, 'Ricardo Lima', 'ricardo.lima@email.com', 'senha123', '11943210987'),
(6, 'André Martins', 'andre.martins@email.com', 'senha123', '11932109876'),
(7, 'Thiago Pereira', 'thiago.pereira@email.com', 'senha123', '11921098765'),
(8, 'Gustavo Rocha', 'gustavo.rocha@email.com', 'senha123', '11910987654');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamento`
--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barbeiro` (`barbeiro`);

--
-- Índices de tabela `barbeiros`
--
ALTER TABLE `barbeiros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `servicos`
--
ALTER TABLE `servicos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamento`
--
ALTER TABLE `agendamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `barbeiros`
--
ALTER TABLE `barbeiros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `servicos`
--
ALTER TABLE `servicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamento`
--
ALTER TABLE `agendamento`
  ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`barbeiro`) REFERENCES `barbeiros` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
