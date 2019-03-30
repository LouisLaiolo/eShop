<?php //Gestion connexion d'un user
require_once('includes/header.php');

$alerteRe = '<h3>Connexion</h3>';

if(!isset($_SESSION['user_id'])){
	if (isset($_POST['fpseudo']))
            $pseudo = htmlspecialchars($_POST["fpseudo"]);
	if (isset($_POST['fpassword']))
            $password = htmlspecialchars($_POST["fpassword"]);
	if(isset($_POST['submit']) AND $_POST['submit'] == 'Valider'){
			$alerteRe = '<h3>Connexion</h3>';
			$select = $db->query("SELECT id FROM users WHERE username='$pseudo'");
			if($select->fetchColumn()){
				$select = $db->query("SELECT * FROM users WHERE username = '".$pseudo."' AND password = '".$password."'");
				$result = $select->fetch(PDO::FETCH_OBJ);
				$_SESSION['user_id'] = $result->id;
				$_SESSION['user_name'] = $result->username;
				$_SESSION['user_email'] = $result->email;
				$_SESSION['user_password'] = $result->password;
				header('Location: index.php');
				$select->closeCursor();
			}else{
				 $alerteRe = '<h3>Connexion - <span style="color:#fd7a01;">Mauvais identifiant ou mot de passe</span></h3>';
				 $select->closeCursor();
			}
	}
?>
<div id="main"><!-- sous partie du main -->
	<section id="content">
		<div id="left">
			<?php echo $alerteRe ?>
			<br/>
				<div>
				  	<form method="post">
					    <label for="fname"><strong>PSEUDO :</strong></label>
					    <input type="text" id="ipseudo" name="fpseudo" placeholder="Entrer votre pseudo" maxlength="15" required>
					    <label for="country"><strong>PASSWORD :</strong></label>
					 	<input type="password" id="ipassword" name="fpassword" placeholder="Entrer votre mot de passe" maxlength="15" required>
					  	<br/><br/>
					  	<div class="wrap">
						    <div class='element'>
								<input type="submit" name="submit" value="Valider">
								<input type="reset" value="Reset" name="reset" id="reset"/>
							</div>
						</div>
				  </form>
			</div>
			<br/>
		</div>
<?php
		}else{ //fin du premier if
			header('Location:index.php');
		}
		require_once('includes/sidebar.php');
		?>
	</section>
</div>

<?php require_once('includes/footer.php'); ?>