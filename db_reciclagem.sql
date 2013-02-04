-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.24-log
-- Versão do PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `db_reciclagem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_academia`
--

CREATE TABLE IF NOT EXISTS `tab_academia` (
  `id_academia` int(11) NOT NULL AUTO_INCREMENT,
  `str_academia` varchar(250) NOT NULL,
  `dec_valor_c_alojamento` decimal(10,0) DEFAULT NULL,
  `dec_valor_s_alojamento` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id_academia`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_cidade`
--

CREATE TABLE IF NOT EXISTS `tab_cidade` (
  `id_cidade` int(11) NOT NULL AUTO_INCREMENT,
  `str_cidade` varchar(250) NOT NULL,
  PRIMARY KEY (`id_cidade`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_colaborador`
--

CREATE TABLE IF NOT EXISTS `tab_colaborador` (
  `id_colaborador` int(11) NOT NULL AUTO_INCREMENT,
  `num_drt` int(11) NOT NULL,
  `str_nome` varchar(250) NOT NULL,
  `num_id_cidade` int(11) NOT NULL,
  `num_id_posto` int(11) NOT NULL,
  `dt_inicial` date NOT NULL,
  `dt_final` date NOT NULL,
  `dt_previsao` date NOT NULL,
  `num_marcada` int(11) NOT NULL,
  `num_ativo` int(11) NOT NULL,
  `num_certificado` int(11) NOT NULL,
  PRIMARY KEY (`id_colaborador`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=506 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_posto`
--

CREATE TABLE IF NOT EXISTS `tab_posto` (
  `id_posto` int(11) NOT NULL AUTO_INCREMENT,
  `str_posto` varchar(250) NOT NULL,
  PRIMARY KEY (`id_posto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tab_reciclagens`
--

CREATE TABLE IF NOT EXISTS `tab_reciclagens` (
  `id_reciclagens` int(11) NOT NULL AUTO_INCREMENT,
  `num_id_colaborador` int(11) NOT NULL,
  `dt_in_nova` date NOT NULL,
  `dt_fim_nova` date NOT NULL,
  `str_academia` varchar(250) NOT NULL,
  `num_convocacao` int(11) NOT NULL,
  PRIMARY KEY (`id_reciclagens`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=525 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
