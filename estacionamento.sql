-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Maio-2022 às 17:35
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estacionamento`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id_cadastro` int(4) NOT NULL,
  `placa` char(8) DEFAULT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `cpf` char(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carro_cliente`
--

CREATE TABLE `carro_cliente` (
  `id_carro` int(8) NOT NULL,
  `id_cadastro` int(4) DEFAULT NULL,
  `placa` char(8) DEFAULT NULL,
  `cor` varchar(50) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `marca` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `convenio`
--

CREATE TABLE `convenio` (
  `id_convenio` varchar(200) NOT NULL,
  `loja_conveniada` varchar(200) NOT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `numero_residencial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estacionamento`
--

CREATE TABLE `estacionamento` (
  `id_carro` int(8) NOT NULL,
  `data_hora_entrada` datetime NOT NULL,
  `tipo_tarifa` varchar(100) DEFAULT NULL,
  `id_convenio` varchar(200) DEFAULT NULL,
  `valor` int(11) DEFAULT NULL,
  `data_hora_saida` datetime DEFAULT NULL,
  `tipo_cliente` varchar(50) DEFAULT NULL,
  `ultimo_pagamento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tarifa`
--

CREATE TABLE `tarifa` (
  `tipo_tarifa` varchar(100) NOT NULL,
  `tipo_cliente` varchar(50) DEFAULT NULL,
  `dia_da_semana` varchar(50) DEFAULT NULL,
  `horario` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id_cadastro`);

--
-- Índices para tabela `carro_cliente`
--
ALTER TABLE `carro_cliente`
  ADD PRIMARY KEY (`id_carro`),
  ADD KEY `fk_idcadastro` (`id_cadastro`);

--
-- Índices para tabela `convenio`
--
ALTER TABLE `convenio`
  ADD PRIMARY KEY (`id_convenio`);

--
-- Índices para tabela `estacionamento`
--
ALTER TABLE `estacionamento`
  ADD PRIMARY KEY (`id_carro`,`data_hora_entrada`),
  ADD KEY `fk_tipotarifa` (`tipo_tarifa`),
  ADD KEY `fk_lojaconveniada` (`id_convenio`);

--
-- Índices para tabela `tarifa`
--
ALTER TABLE `tarifa`
  ADD PRIMARY KEY (`tipo_tarifa`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carro_cliente`
--
ALTER TABLE `carro_cliente`
  ADD CONSTRAINT `fk_idcadastro` FOREIGN KEY (`id_cadastro`) REFERENCES `cadastro` (`id_cadastro`);

--
-- Limitadores para a tabela `estacionamento`
--
ALTER TABLE `estacionamento`
  ADD CONSTRAINT `fk_idcarro` FOREIGN KEY (`id_carro`) REFERENCES `carro_cliente` (`id_carro`),
  ADD CONSTRAINT `fk_lojaconveniada` FOREIGN KEY (`id_convenio`) REFERENCES `convenio` (`id_convenio`),
  ADD CONSTRAINT `fk_tipotarifa` FOREIGN KEY (`tipo_tarifa`) REFERENCES `tarifa` (`tipo_tarifa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
