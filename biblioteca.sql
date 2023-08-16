-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 16-Ago-2023 às 11:06
-- Versão do servidor: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acessos`
--

CREATE TABLE `acessos` (
  `id` int(11) NOT NULL,
  `nome` varchar(35) NOT NULL,
  `chave` varchar(35) NOT NULL,
  `grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acessos`
--

INSERT INTO `acessos` (`id`, `nome`, `chave`, `grupo`) VALUES
(2, 'Home', 'home', 0),
(4, 'Usuários', 'usuarios', 1),
(5, 'Leitores', 'leitores', 1),
(6, 'Livros', 'livros', 2),
(7, 'Categorias', 'categorias', 2),
(8, 'Cargos', 'cargos', 2),
(9, 'Locais', 'locais', 2),
(10, 'Editoras', 'editoras', 2),
(11, 'Grupos', 'grupos', 2),
(12, 'Acessos', 'acessos', 2),
(13, 'Empréstimos Ativos', 'emprestimos', 3),
(14, 'Lista de Devoluções', 'devolucoes', 3),
(15, 'Devoluções de Hoje', 'devolucoes_hoje', 3),
(16, 'Devoluções em Atraso', 'devolucoes_atraso', 3),
(17, 'Todos os Empréstimos', 'todos_emprestimos', 3),
(18, 'Configurações', 'config', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id`, `nome`) VALUES
(1, 'Administrador'),
(2, 'Gerente'),
(3, 'Bibliotecário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'angustia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `config`
--

CREATE TABLE `config` (
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `icone` varchar(100) DEFAULT NULL,
  `logo_rel` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `marca_dagua` varchar(5) NOT NULL,
  `dias_entrega` int(11) NOT NULL,
  `instancia_api` varchar(50) DEFAULT NULL,
  `token_api` varchar(50) DEFAULT NULL,
  `api_whatsapp` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `config`
--

INSERT INTO `config` (`nome`, `email`, `telefone`, `endereco`, `instagram`, `logo`, `icone`, `logo_rel`, `id`, `marca_dagua`, `dias_entrega`, `instancia_api`, `token_api`, `api_whatsapp`) VALUES
('BOOK.exe', 'contato@hugocursos.com.br', '(47) 99999-9999', 'Rua X Número 150 - Itajaí S ', '', 'logo.png', 'icone.png', 'logo.jpg', 1, 'Não', 5, 'NOS13L97', '213E3-C1W-555SW', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `editoras`
--

CREATE TABLE `editoras` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `editoras`
--

INSERT INTO `editoras` (`id`, `nome`) VALUES
(1, 'Editora A'),
(2, 'Editora B'),
(3, 'Editora C');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id` int(11) NOT NULL,
  `livro` int(11) NOT NULL,
  `leitor` int(11) NOT NULL,
  `data_emprestimo` date NOT NULL,
  `data_devolucao` date NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `funcionario` int(11) NOT NULL,
  `devolvido` varchar(5) NOT NULL,
  `hash` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `emprestimos`
--

INSERT INTO `emprestimos` (`id`, `livro`, `leitor`, `data_emprestimo`, `data_devolucao`, `obs`, `funcionario`, `devolvido`, `hash`) VALUES
(7, 2, 2, '2023-01-06', '2023-03-06', '', 1, 'Sim', NULL),
(8, 7, 1, '2023-01-06', '2023-03-06', '', 1, 'Sim', NULL),
(9, 6, 2, '2023-01-05', '2023-03-06', '', 1, 'Sim', NULL),
(10, 7, 1, '2023-02-06', '2023-03-06', '', 1, 'Sim', NULL),
(11, 2, 1, '2023-03-06', '2023-03-06', '', 1, 'Sim', NULL),
(12, 2, 1, '2023-03-06', '2023-03-06', '', 1, 'Sim', NULL),
(13, 2, 1, '2023-03-05', '2023-03-06', '', 1, 'Sim', NULL),
(14, 6, 1, '2023-03-06', '2023-03-06', '', 1, 'Sim', NULL),
(15, 6, 1, '2023-03-06', '2023-03-06', '', 1, 'Sim', NULL),
(16, 6, 1, '2023-03-06', '2023-03-06', '', 1, 'Sim', NULL),
(17, 2, 1, '2023-03-06', '2023-03-06', '', 1, 'Sim', NULL),
(18, 2, 1, '2023-03-06', '2023-03-06', '', 1, 'Sim', NULL),
(19, 6, 2, '2023-03-06', '2023-03-06', '', 1, 'Sim', NULL),
(20, 7, 1, '2023-03-06', '2023-03-06', '', 1, 'Sim', NULL),
(21, 2, 1, '2023-03-06', '2023-03-06', '', 1, 'Sim', NULL),
(22, 6, 1, '2023-03-06', '2023-03-06', '', 1, 'Sim', NULL),
(23, 7, 1, '2023-03-06', '2023-03-07', 'fsdf f ffdgdgfdgfd gfdg dfgdfgdfg', 1, 'Sim', NULL),
(24, 2, 8, '2023-03-07', '2023-03-07', 'Obs Teste', 1, 'Sim', NULL),
(25, 2, 8, '2023-03-07', '2023-03-07', 'Obs Teste', 1, 'Sim', NULL),
(26, 6, 8, '2023-03-07', '2023-03-07', 'Obs Teste', 1, 'Sim', NULL),
(27, 6, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', NULL),
(28, 6, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', NULL),
(29, 2, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', NULL),
(30, 7, 8, '2023-03-07', '2023-03-07', 'teste', 1, 'Sim', NULL),
(31, 6, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', NULL),
(32, 2, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', '53WFZLP19C'),
(33, 6, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', '9J7AN2F3W5'),
(34, 2, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', 'U0QMA3F0T1'),
(35, 6, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', 'C09JA7DIBH'),
(36, 2, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', '83V2HWQ4EC'),
(37, 7, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', 'JM1S5Y9N0R'),
(38, 6, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', 'X8LJ5A30MB'),
(39, 2, 8, '2023-03-07', '2023-03-07', 'aaaaaaaaaaaaa', 1, 'Sim', '85MC10WTB7'),
(40, 7, 8, '2023-03-07', '2023-03-07', 'aaaaaaaaaaaaa', 1, 'Sim', '33NJ0P02F5'),
(41, 7, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', '5NC0J0IA74'),
(42, 42, 8, '2023-03-07', '2023-03-07', '', 1, 'Sim', '257WZ1Q9W1'),
(43, 41, 2, '2023-03-07', '2023-08-03', '', 1, 'Sim', 'A0A3HROV21'),
(44, 42, 9, '2023-03-07', '2023-03-07', '', 1, 'Sim', '0O0GNW020L'),
(45, 44, 9, '2023-03-07', '2023-03-07', '', 1, 'Sim', 'Q650U0K3CG'),
(46, 2, 1, '2023-08-03', '2023-08-08', 'sada', 1, 'Não', ''),
(47, 3, 2, '2023-08-03', '2023-08-03', '', 1, 'Sim', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `nome` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`id`, `nome`) VALUES
(1, 'Pessoas'),
(2, 'Cadastros'),
(3, 'Empréstimos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `leitores`
--

CREATE TABLE `leitores` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `data_cad` date NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `obs` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `leitores`
--

INSERT INTO `leitores` (`id`, `nome`, `telefone`, `cpf`, `endereco`, `data_cad`, `ativo`, `obs`) VALUES
(1, 'Leitor 1', '(99) 99999-9999', '1', 'sla', '2023-08-15', 'Sim', 'a'),
(2, 'Leitor 2', '(88) 88888-8888', '2', 'fsafa', '2023-08-15', 'Sim', 'b'),
(3, 'leitor 3', '(77) 77777-7777', '3', 'ex', '2023-08-15', 'Sim', 'surfistinha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(100) DEFAULT NULL,
  `autor` varchar(50) DEFAULT NULL,
  `ano` int(11) DEFAULT NULL,
  `editora` int(11) NOT NULL,
  `edicao` varchar(50) DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `local` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `data_cad` date NOT NULL,
  `emprestimos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id`, `codigo`, `titulo`, `subtitulo`, `autor`, `ano`, `editora`, `edicao`, `categoria`, `foto`, `local`, `status`, `obs`, `data_cad`, `emprestimos`) VALUES
(3, '12345', 'harry potter', 'pedras filosofal', 'j.k rowling', 2000, 2, 'HP', 1, '03-08-2023-11-30-56-Captura-de-tela-2023-08-01-080746.png', 2, 'Disponível', 'a', '2023-08-03', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locais`
--

CREATE TABLE `locais` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `locais`
--

INSERT INTO `locais` (`id`, `nome`) VALUES
(1, 'Prateleira 1'),
(2, 'Prateleira 2'),
(3, 'Prateleira 3'),
(4, 'Prateleira 4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  `senha_crip` varchar(130) NOT NULL,
  `nivel` varchar(25) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `senha_crip`, `nivel`, `ativo`, `telefone`, `endereco`, `foto`, `data`) VALUES
(1, 'Teste', 'teste@gmail.com', '123', '202cb962ac59075b964b07152d234b70', 'Administrador', 'Sim', '(47) 99999-999', 'fsafa', '03-08-2023-08-19-21-Captura-de-tela-2023-08-01-080746.png', '2023-02-27'),
(2, 'Pedro', 'pedrox@teste.com', '123', '202cb962ac59075b964b07152d234b70', 'Bibliotecário', 'Sim', '(99) 99999-9999', 'Rua Mato Grosso', 'sem-foto.jpg', '2023-08-10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_permissoes`
--

CREATE TABLE `usuarios_permissoes` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `permissao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios_permissoes`
--

INSERT INTO `usuarios_permissoes` (`id`, `usuario`, `permissao`) VALUES
(49, 19, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acessos`
--
ALTER TABLE `acessos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `editoras`
--
ALTER TABLE `editoras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leitores`
--
ALTER TABLE `leitores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locais`
--
ALTER TABLE `locais`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acessos`
--
ALTER TABLE `acessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `editoras`
--
ALTER TABLE `editoras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `leitores`
--
ALTER TABLE `leitores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `locais`
--
ALTER TABLE `locais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios_permissoes`
--
ALTER TABLE `usuarios_permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
