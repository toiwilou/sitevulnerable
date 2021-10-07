SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `demobdd`
--

-- --------------------------------------------------------

GRANT ALL PRIVILEGES ON `demobdd`.* TO 'demoutilisateur'@'localhost' identified by 'Mdp@Ass3zSécuris3';
FLUSH PRIVILEGES;

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nomutilisateur` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `nomutilisateur`, `motdepasse`) VALUES
(1, 'Admin', 'ab4f63f9ac65152575886860dde480a1');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `idauteur` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id`, `idauteur`, `titre`, `contenu`) VALUES
(1, 1, 'Mon premier article', '<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p><p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>'),
(2, 1, 'Nulla amet dolore', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi <b>sint occaecati cupiditate non provident</b>, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>'),
(3, 1, 'Tempus ullamcorper', '<p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>'),
(4, 1, 'Sed etiam facilis', '<p>Curabitur rhoncus lacus maximus, bibendum sapien ut, ultricies libero. Nullam ornare dui vel tortor ultrices, ut aliquet massa euismod. Maecenas tincidunt ante quis suscipit luctus. Aenean imperdiet hendrerit nisl non posuere. Etiam nec arcu et ex convallis laoreet a sagittis felis. <i>Morbi eu sollicitudin</i> justo, at malesuada enim. Sed convallis finibus lorem eget hendrerit. Vivamus mauris lorem, tincidunt eget dolor quis, tincidunt facilisis ipsum. </p>'),
(5, 1, 'Feugiat lorem aenean', '<p>Nulla auctor egestas mi sed mattis. Donec pellentesque mauris ac dignissim sagittis. Nunc id magna nec ipsum aliquam consequat. Sed eu maximus libero. Ut scelerisque porta magna sodales cursus. Donec sed ultrices nunc. Donec nibh turpis, dapibus nec vestibulum sit amet, commodo tincidunt ante. Maecenas suscipit ullamcorper volutpat. In et cursus risus. Nunc sit amet ornare risus, sed euismod ligula. </p>'),
(6, 1, 'Amet varius aliquam', '<p>Nulla non lacus condimentum, pretium tortor id, fermentum magna. Phasellus sed leo ultricies, dictum nulla ut, ornare elit. Aliquam egestas vulputate diam eu placerat. Sed volutpat lobortis suscipit. Sed quis imperdiet libero. Aliquam hendrerit turpis sed mi tincidunt, ac aliquet tortor imperdiet. Proin turpis sapien, venenatis ullamcorper diam sed, tempor condimentum eros. </p>');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `idarticle` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `commentaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `idarticle`, `pseudo`, `commentaire`) VALUES
(1, 1, 'Trolleur', 'Ca ne veut rien dire votre article là !'),
(2, 6, 'Trolleur', 'rien compris...');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
