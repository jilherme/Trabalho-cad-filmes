-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 27-Nov-2019 às 20:38
-- Versão do servidor: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cad_filmes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `cod_cliente` int(10) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` text COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `rua` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `uf` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cod_cliente`),
  UNIQUE KEY `Codcliente_UNIQUE` (`cod_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `filme`
--

DROP TABLE IF EXISTS `filme`;
CREATE TABLE IF NOT EXISTS `filme` (
  `cod_filme` int(3) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `produtora` varchar(50) NOT NULL,
  `diretor` varchar(50) NOT NULL,
  `atores` varchar(200) NOT NULL,
  `classificacao` varchar(50) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `capa` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`cod_filme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `filme`
--

INSERT INTO `filme` (`cod_filme`, `titulo`, `genero`, `produtora`, `diretor`, `atores`, `classificacao`, `ano`, `capa`) VALUES
(1, 'O Touro Ferdinando', 'Fantasia/Aventura', 'Blue Sky Studios Twentieth Century Fox Animation D', 'Carlos Saldanha', 'Ferdinando', 'Livre', '2018', 'capas/15735286865dca246ef140d.gif'),
(2, 'Era do gelo 3', 'Ação/Romance', 'Blue Sky Studios, Twentieth Century Fox Animation', 'Carlos Saldanha', 'Ray Romano, John Leguizamo, Queen Latifah,...', 'Livre', '2009', 'imagens/sem_foto.png'),
(3, 'Pet - A Vida Secreta dos Bichos', 'Aventura/Comédia', 'Universal Studios, Illumination Entertainment', 'Chris Renaud, Yarrow Cheney', ' Kevin Hart, Louis C.K., Jenny Slate, Eric Stonestreet, ...', 'Livre', '2016', 'imagens/sem_foto.png'),
(4, 'Enrolados', 'Animação', 'Disney', 'Byron Howard, Nathan Greno', 'Mandy Moore, Zachary Levi, Donna Murphy', 'Livre', '2011', 'imagens/sem_foto.png'),
(5, 'A Princesa e o Sapo', 'Animação', 'Disney', 'Ron Clements, John Musker', 'Anika Noni Rose, Bruno Campos, Oprah Winfrey', 'Livre', '2009', 'imagens/sem_foto.png'),
(6, 'A Bela e a Fera', 'Animação', 'Disney', 'Gary Trousdale, Kirk Wise', 'Paige OHara, Angela ´Lansbury, Raymond Benson', 'Livre', '1991', 'imagens/sem_foto.png'),
(7, 'Robin Hood', 'Animação', 'Disney', 'Wolfgang Reitherman', 'Brian Bedford, Roger Miller, Phil Harris, Peter Ustinov', 'Livre', '1973', 'imagens/sem_foto.png'),
(8, 'Anastasia', 'Animação', '20th Century Fox, Fox Animation Studios, Twentieth', 'Don Bluth, Gary Goldman', 'Meg Ryan,John Cusak', 'Livre', '1997', 'imagens/sem_foto.png'),
(9, 'Jogador N°1', 'Fantasia', 'Warner Bros. Pictures', 'Steven Spielberg', 'Olivia Cooke, Tye Sheridan', '12 anos', '2018', 'imagens/sem_foto.png'),
(10, 'Mulher Maravilha', 'Fantasia', 'Warner Bros. Pictures', 'Patty Jenkins', 'Gal Gadot, Chris Pine', '12 anos', '2017', 'imagens/sem_foto.png'),
(11, 'O Hobbit: Uma Jornada Inesperada', 'Fantasia', 'Warner Bros. Pictures', 'Peter Jackson', ' Martin Freeman, Ian McKellen, Richard Armitage', '12 anos', '2012', 'imagens/sem_foto.png'),
(12, 'Frozen - Uma Aventura Congelante', 'Animação', 'Walt Disney Animation Studios', 'Jennifer Lee, Chris Buck', 'Ana, Elsa, Olaf, Kristoff, Hans...', 'Livre', '2014', 'imagens/sem_foto.png'),
(13, 'Meu Malvado Favorito', 'Aventura/Comédia', 'Illumination Entertainment', 'Pierre Coffin, Chris Renaud', 'Gru, Vector, Minions, Agnes, Edith, Margo...', 'Livre', '2010', 'imagens/sem_foto.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacao`
--

DROP TABLE IF EXISTS `locacao`;
CREATE TABLE IF NOT EXISTS `locacao` (
  `cod_locacao` int(11) NOT NULL AUTO_INCREMENT,
  `cod_cliente` int(10) NOT NULL,
  `cod_filme` int(3) NOT NULL,
  `data_loca` date NOT NULL,
  `data_devo` date NOT NULL,
  PRIMARY KEY (`cod_locacao`),
  KEY `fk_locacao_cliente_idx` (`cod_cliente`),
  KEY `fk_locacao_filme1_idx` (`cod_filme`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `cod_usuario` varchar(45) NOT NULL,
  `nome` varchar(10) NOT NULL,
  `senha` varchar(8) NOT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`cod_usuario`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
