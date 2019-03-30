<?php
require_once('config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
		<title>PROJET L1 WEB</title>
		<!-- Lier les styles sheet -->
		<link rel="stylesheet" href="style/reset.css" type="text/css" media="screen">
		<link rel="stylesheet" href="style/style.css" type="text/css" media="screen">
		<link rel="stylesheet" href="style/nivo-slider.css" type="text/css" media="screen">
	</head>
	<!--########################################################################################################## BODY ###############################################################################-->
	<body>
	<?php
	if(isset($_SESSION['user_id'])){
		$username = $_SESSION['user_name'];
		$compte = "Mon compte (  $username  )";
	} else {
		$username = null;
		$compte = "Mon compte";
	}
	?>
	<div class="container">
		<header><!-- header de la page -->
			<nav><!-- menu navigation -->
				<ul>
					<li class="menu"><a href="index.php">Accueil</a></li>
					<li><a href="panier.php">Panier</a></li>
					<?php if(!isset($_SESSION['user_id'])): ?>
					<li><a href="register.php">S'inscrire</a></li>
					<li><a href="connect.php">Se connecter</a></li>
					<?php else: ?>
					<li><a href="my_account.php"> <?php echo $compte ?></a></li>
					<?php endif; ?>
					<li><a href="conditions_generales_de_vente.php">CGV</a></li>
				</ul>
			</nav>
			<div class="top_head"><!-- head -->
				<img src="imgs/logo.png" class="logo" title="Logo" alt="Logo" /><!-- logo -->
			</div>
			<section id="submenu"><!-- sous menu -->
				<ul>
					<?php
						$categories = $db->query('SELECT name, slug FROM category')->fetchAll(PDO::FETCH_OBJ);
						foreach ($categories as $category):
					?>
						<li><a href="boutique.php?category=<?= htmlspecialchars($category->slug); ?>"><?= htmlspecialchars($category->name); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</section>
		</header>