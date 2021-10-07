<!DOCTYPE HTML>
<!--
	Adaptation du modèle "Editorial by HTML5 UP"
	html5up.net | @ajlkn
	Utilisé sous licence CCA 3.0 (html5up.net/license)
	
	Page administrateur adaptée du modèle gratuit Bootply "Bootstrap 3 Admin"
	
	Images du domaine public de Pixabay.com
-->
<html>
	<head>
		<title>VulneWeb by LeBlogDuHacker</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">
						<div class="inner">

							<!-- Header -->
								<header id="header">
									<a href="index.php" class="logo"><strong>VulneWeb</strong> by LeBlogDuHacker</a>
									<ul class="icons">
										<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon fa-snapchat-ghost"><span class="label">Snapchat</span></a></li>
										<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="#" class="icon fa-medium"><span class="label">Medium</span></a></li>
									</ul>
								</header>

							<?php 
								if(isset($_POST['query'])) { //Gère les recherches depuis le champ en question
									echo "Vous avez cherché : " . $_POST['query']; //ATTENTION: pas d'échappement de caractères (XSS)
									//exemple de correction : echo "Vous avez cherché : " . htmlentities($_POST['query']);
								} else { ?>
								
							<!-- Section -->
								<section>
									<header class="major">
										<h2>Article du jour</h2>
									</header>
									
										<article>
											<div class="content">
											<?php

												if(!isset($_GET['id'])) {
													if(isset($_GET['page'])) {//on regarde si une page doit être incluse
														include($_GET['page']);//ATTENTION: on peut inclure n'importe quel fichier (faille include)
														//exemple de correction : if($_GET['page']==="galerie") { include("/var/www/html/demo/galerie.php"); }
														//voir éventuellement str_replace(array("\n","\r",PHP_EOL),'',$_GET['page'])==="galerie") { include("/var/www/html/demo/galerie.php"); }
													}
													else {
														die("Aucun article ou page sélectionné(e).");
													}
												} else {
													$mysqli = new mysqli("localhost", "demoutilisateur", "Mdp@Ass3zSécuris3", "demobdd"); // Connexion BDD 
													if ($mysqli->connect_errno) {
														die("Échec de la connexion - Veuillez réessayer plus tard : " . $mysqli->connect_error()); //affiche l'erreur
													}
													$mysqli->set_charset("utf8");
													$rowsarticles=$mysqli->query("SELECT * FROM `articles` WHERE id=" . $_GET['id'] . " LIMIT 1");//ATTENTION: pas d'échappement dans la requête SQL (Injection SQL) 
													//exemple de correction : $rowsarticles=$mysqli->query("SELECT * FROM `articles` WHERE id=" . $mysqli->real_escape_string($_GET['id']));
													if ($rowsarticles->num_rows==0) {
														echo "Aucun article à afficher.";
													}   
													else if($row = $rowsarticles->fetch_array()) {
														
														?>
														<?php 
															echo "<h3>" . $row['titre'] . "</h3>"; //ATTENTION: pas d'échappement de caractères (XSS stocké)
															echo $row['contenu']; //ATTENTION: pas d'échappement de caractères (XSS stocké)
															//exemple de correction : echo htmlentities($row['contenu']); et echo "<h3>" . htmlentities($row['titre']) . "</h3>";
														?>
											  <?php }?>
									      <?php } ?>
											</div>
										</article>
										<hr>
										<div>
											<h3>Commentaires</h3>
											<?php 
												if (isset($_POST['pseudo']) && isset($_POST['commentaire'])) {
													
													$queryinsert = "INSERT INTO `commentaires`(`id`, `idarticle`, `pseudo`, `commentaire`) VALUES (NULL, ".$_GET['id'].", '" . $_POST['pseudo'] . "', '" . $_POST['commentaire'] . "')";//ATTENTION: pas d'échappement dans la requête SQL (Injection SQL)
													//exemple de correction : $mysqli->real_escape_string()  autour de $_GET['id'], $_POST['pseudo'] et $_POST['commentaire'] 											
													$mysqli->query($queryinsert);
												} 
												
												$rowscommentaires=$mysqli->query("SELECT * FROM `commentaires` WHERE idarticle=" . $_GET['id']);//ATTENTION: pas d'échappement dans la requête SQL
												//exemple de correction : $mysqli->real_escape_string($_GET['id'])
												if ($rowscommentaires->num_rows==0) {
													echo "Aucun commentaire";
												} else {
													while($row = $rowscommentaires->fetch_array())
													{
														echo $row['pseudo'] . " dit : <br>"; //ATTENTION: pas d'échappement de caractères (XSS stocké)
														echo "&nbsp;&nbsp;&nbsp;" . $row['commentaire'];//ATTENTION: pas d'échappement de caractères (XSS stocké)
														//exemple de correction : echo htmlentities($row['pseudo']); et echo htmlentities($row['commentaire']);
														echo "<br><br>";
													}														
												}
											?>
											<form method="post" action="#">
												<input type="text" name="pseudo" placeholder="Votre pseudo"/>
												<textarea name="commentaire" placeholder="Votre commentaire"></textarea>
												<input type="submit" value="Envoyer"/> <!-- ATTENTION: aucune vérification JavaScript, possibilité de spam et de bugs -->
												<!-- exemple de correction : utiliser des bibliothèques de validation (https://jqueryvalidation.org/)-->
											</form>
										</div>
									
								</section>

								<?php } ?>
						
						</div>
					</div>

				<!-- Sidebar -->
					<div id="sidebar">
						<div class="inner">

							<!-- Search -->
								<section id="search" class="alt">
									<form method="post" action="#">
										<input type="text" name="query" id="query" placeholder="Rechercher" />
									</form>
								</section>

							<!-- Menu -->
								<nav id="menu">
									<header class="major">
										<h2>Menu</h2>
									</header>
									<ul>
										<li><a href="index.php">Accueil</a></li>
										<li><a href="admin">Admin</a></li>
										<li>
											<span class="opener">Sous-menu</span>
											<ul>
												<li><a href="article.php?page=galerie.php">Galerie</a></li>
												<li><a href="#">Ipsum Adipiscing</a></li>
											</ul>
										</li>
										<li><a href="#">Partenaires</a></li>
										<li><a href="#">À propos</a></li>
										<li><a href="#">Contact</a></li>
										<li><a href="#">Mentions légales</a></li>
									</ul>
								</nav>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Ante interdum</h2>
									</header>
									<div class="mini-posts">
										<article>
											<a href="#" class="image"><img src="images/pic07.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
										<article>
											<a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
											<p>Aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore aliquam.</p>
										</article>
									</div>
									<ul class="actions">
										<li><a href="#" class="button">Lire plus</a></li>
									</ul>
								</section>

							<!-- Section -->
								<section>
									<header class="major">
										<h2>Nous contacter</h2>
									</header>
									<p>Sed varius enim lorem ullamcorper dolore aliquam aenean ornare velit lacus, ac varius enim lorem ullamcorper dolore. Proin sed aliquam facilisis ante interdum. Sed nulla amet lorem feugiat tempus aliquam.</p>
									<ul class="contact">
										<li class="fa-envelope-o"><a href="#">information@entreprise.fr</a></li>
										<li class="fa-phone">(+33) 712345678</li>
										<li class="fa-home">1234 Rue de la Ville<br />
										Paris, 75000</li>
									</ul>
								</section>

							<!-- Footer -->
								<footer id="footer">
									<p class="copyright">&copy; MonSite. Tous Droits Réservés. Images de Démonstration : <a href="https://unsplash.com">Unsplash</a>. Design: <a href="https://html5up.net">HTML5 UP</a>.</p>
								</footer>

						</div>
					</div>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
