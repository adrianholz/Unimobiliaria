-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07-Dez-2021 às 01:22
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imobiliaria`
--
CREATE DATABASE IF NOT EXISTS `imobiliaria` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `imobiliaria`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairros`
--

CREATE TABLE IF NOT EXISTS `bairros` (
  `cod_bairro` int(11) NOT NULL,
  `nome_bairro` varchar(100) NOT NULL,
  PRIMARY KEY (`cod_bairro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `bairros`
--

INSERT INTO `bairros` (`cod_bairro`, `nome_bairro`) VALUES
(1, 'Bairro Alto'),
(2, 'Cambuí'),
(3, 'Cedro'),
(4, 'Centro'),
(5, 'Chácara dos Pinheiros'),
(6, 'Cohab 1'),
(7, 'Convívio'),
(8, 'Fazenda Lageado'),
(9, 'Jardim Brasil'),
(10, 'Jardim Continental'),
(11, 'Jardim do Bosque'),
(12, 'Jardim Itamaraty'),
(13, 'Jardim Ypê'),
(14, 'Jardim Ouro Verde'),
(15, 'Marajoara'),
(16, 'Maria Luiza'),
(17, 'Monte Mor'),
(18, 'Parque Bela Vista'),
(19, 'Parque dos Pinheiros'),
(20, 'Real Park'),
(21, 'Santa Maria I'),
(22, 'Recanto Azul'),
(23, 'Rubião Jr'),
(24, 'Vila Antártica'),
(25, 'Vila Aparecida'),
(26, 'Vila Assumpção'),
(27, 'Vila dos Lavradores'),
(28, 'Vila dos Médicos'),
(29, 'Vila Sônia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imovel`
--

CREATE TABLE IF NOT EXISTS `imovel` (
  `codimovel` int(11) NOT NULL AUTO_INCREMENT,
  `codtipo` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `areaterreno` varchar(45) DEFAULT NULL,
  `areaconstruida` varchar(45) DEFAULT NULL,
  `localizacao` varchar(45) DEFAULT NULL,
  `qtdquartos` int(11) DEFAULT NULL,
  `qtdsalas` int(11) DEFAULT NULL,
  `qtdbanheiros` int(11) DEFAULT NULL,
  `qtdcozinha` int(11) DEFAULT NULL,
  `qtdgourmet` int(11) DEFAULT NULL,
  `qtdpiscinas` int(11) DEFAULT NULL,
  `qtdvagas` int(11) DEFAULT NULL,
  `obs` varchar(500) DEFAULT NULL,
  `valor_venda` int(10) NOT NULL,
  `valor_aluguel` int(7) NOT NULL,
  `mod_venda` varchar(50) NOT NULL,
  `tour` varchar(100) NOT NULL,
  PRIMARY KEY (`codimovel`),
  KEY `fkcodtipo` (`codtipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `imovel`
--

INSERT INTO `imovel` (`codimovel`, `codtipo`, `id_usuario`, `descricao`, `areaterreno`, `areaconstruida`, `localizacao`, `qtdquartos`, `qtdsalas`, `qtdbanheiros`, `qtdcozinha`, `qtdgourmet`, `qtdpiscinas`, `qtdvagas`, `obs`, `valor_venda`, `valor_aluguel`, `mod_venda`, `tour`) VALUES
(2, 2, 1, 'teste', '230', '90', 'Maria Luiza', 1, 1, 1, 1, 0, 0, 5, 'b', 220000, 780, 'Ambos', ''),
(3, 4, 3, 'Casa simples, e sem pintura', '230', '23', 'Cohab 1', 3, 2, 2, 1, 0, 0, 0, 'Rua tranquila', 0, 890, 'Aluguel', ''),
(4, 1, 2, 'Casa completamente confortÃ¡vel', '230', '200', 'Marajoara', 2, 2, 2, 1, 0, 1, 2, 'Rua barulhenta', 200000, 0, 'Venda', ''),
(7, 2, 3, 'Rua Simples', '230', '23', 'Jardim Brasil', 2, 1, 1, 2, 0, 2, 4, 'e', 223000, 0, 'Venda', ''),
(8, 4, 15, '1 quarto pequeno', '560', '350', 'Bairro Alto', 1, 1, 2, 1, 1, 1, 3, '', 0, 990, 'Aluguel', ''),
(9, 2, 15, 'Recem reformada', '220', '200', 'Maria Luiza', 2, 2, 3, 1, 0, 2, 3, '', 250000, 770, 'Ambos', ''),
(10, 3, 15, 'Casa com belos detalhes', '200', '190', 'Cohab 1', 1, 2, 3, 1, 1, 2, 2, '', 1000000, 1000, 'Ambos', 'https://my.matterport.com/show/?m=gw3crczNsrX');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imoveltipo`
--

CREATE TABLE IF NOT EXISTS `imoveltipo` (
  `codtipo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`codtipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `imoveltipo`
--

INSERT INTO `imoveltipo` (`codtipo`, `descricao`) VALUES
(1, 'Casa Térrea'),
(2, 'Casa sobrado'),
(3, 'Apartamento'),
(4, 'Chácara');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `Id_usuario` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) CHARACTER SET utf8 NOT NULL,
  `telefone` varchar(19) CHARACTER SET utf8 NOT NULL,
  `usuario` varchar(50) CHARACTER SET utf8 NOT NULL,
  `senha` varchar(20) NOT NULL,
  PRIMARY KEY (`Id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`Id_usuario`, `nome`, `telefone`, `usuario`, `senha`) VALUES
(1, 'Diogo Henrique', '14999992021', 'DH92@gmail.com', '123456'),
(2, 'Robert Christian', '14999992022', 'Rbt93@gmail.com', '654789'),
(3, 'ADRIAN HOLZSCHUH', '1499992024', 'AH99@gmail.com', '963852'),
(4, 'Lucas Marques', '14999992023', 'LM03@gmail.com', '789456'),
(17, 'Wallace Afonso', '123', 'wallace0@gmail.com', '0'),
(15, 'Lucas Henrique Marques', '98765432112', 'LukasBom@gmail.com', '1234'),
(25, 'Wesley', '(21) 32132-2323', 'wesley@gmail.com', 'wesley123');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `imovel`
--
ALTER TABLE `imovel`
  ADD CONSTRAINT `fkcodtipo` FOREIGN KEY (`codtipo`) REFERENCES `imoveltipo` (`codtipo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
