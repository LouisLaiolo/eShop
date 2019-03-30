<?php
	session_start();
	require_once('../includes/header.php');

	if(isset($_SESSION['username']) && $_SESSION['username']) 
		header('Location: admin.php');
	// si le formulaire a été envoyé
	if(isset($_POST['submit'])) {
		$username = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : null;
		$password = (isset($_POST['password'])) ? htmlspecialchars($_POST['password']) : null;
		if($username && $password) {
			if($username === ADMIN_USER && $password === ADMIN_PASS) {
				$_SESSION['username'] = $username;
				header('Location: admin.php');
			} else 
				echo 'Identifiants erronés';
		}
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
		<title>Administration</title>
	</head>
	<body>
		<h1>Administration - Connexion</h1>
		<form action="" method="POST">
			<label for="fname"><strong>PSEUDO :</strong></label>
			<input type="text" id="ipseudo" name="username" placeholder="Entrez votre pseudo" maxlength="15" required>
			<br/><br/>
			<label for="fname"><strong>MOT DE PASSE :</strong></label>
			<input type="text" id="imdp" name="password" placeholder="Entrez votre mot de passe" maxlength="15" required>
			<br/><br/>
			<input type="submit" name="submit"/><br/><br/>
		</form>
	</body>
</html>
