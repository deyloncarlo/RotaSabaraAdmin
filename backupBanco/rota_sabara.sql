-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/06/2016 às 02:54
-- Versão do servidor: 5.7.9
-- Versão do PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `rota_sabara`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `estatistica_pontoturistico`
--

DROP TABLE IF EXISTS `estatistica_pontoturistico`;
CREATE TABLE IF NOT EXISTS `estatistica_pontoturistico` (
  `id_estatisticaPontoTuristico` int(5) NOT NULL AUTO_INCREMENT,
  `id_pontTuristico` int(5) NOT NULL,
  `numero_visualizacoes` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_estatisticaPontoTuristico`),
  KEY `id_pontTuristico` (`id_pontTuristico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `ponto_turistico`
--

DROP TABLE IF EXISTS `ponto_turistico`;
CREATE TABLE IF NOT EXISTS `ponto_turistico` (
  `id_pontoTuristico` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_insercao_no_sistema` date NOT NULL,
  `descricao` text NOT NULL,
  `resumo` text NOT NULL,
  `caminho_imagem_destacada` varchar(255) DEFAULT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `isEcologica` tinyint(1) NOT NULL,
  `isIgreja` tinyint(1) NOT NULL,
  `isCulinaria` tinyint(1) NOT NULL,
  `isMuseu` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_pontoTuristico`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_administrativo`
--

DROP TABLE IF EXISTS `usuario_administrativo`;
CREATE TABLE IF NOT EXISTS `usuario_administrativo` (
  `id_usuarioAdministrativo` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `genero` varchar(1) NOT NULL,
  `permissao` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  PRIMARY KEY (`id_usuarioAdministrativo`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `usuario_administrativo`
--

INSERT INTO `usuario_administrativo` (`id_usuarioAdministrativo`, `nome`, `genero`, `permissao`, `usuario`, `email`, `senha`) VALUES
(1, 'Deylon Carlo', '', 'Administrador', 'deyloncarlo', 'deyloncarlo@gmail.com', '123456'),
(2, 'Carlos Alexandre', 'M', 'Criar/Editar', 'carlos', 'CarlosAlexandre@ifmg.com.edu.br', '123456'),
(58, 'teste', 'M', 'Administrador', 'teste', 'teste@vai.com', '123456'),
(59, 'segundoTeste', 'M', 'Administrador', 'segundoTeste', 'Segundoteste@vai.com', '123456'),
(60, 'quarto', 'M', 'Criar/Editar', 'quarto', 'quarto@gmail.com', '123456'),
(61, 'douglas carlo', 'M', 'Criar/Editar', 'douglasc', 'douglascarlo@gmail.com', '12345678');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
