<?php
require_once('includes/header.php');
?>

<?php

function verify_password($password1, $password2){
    if($password1==$password2)
        return true;
    else
        return false;
}

?>

<?php //Gestion création de compte user

$alerteRe = '<h3>Inscription</h3>';

if(!isset($_SESSION['user_id'])){
	
	if (isset($_POST['fpseudo']))
            $pseudo = htmlspecialchars($_POST["fpseudo"]);

	if (isset($_POST['femail']))
            $email = htmlspecialchars($_POST["femail"]);
    
    if (isset($_POST['fpassword']))
            $password1 = htmlspecialchars($_POST["fpassword"]);
    
    if (isset($_POST['repeatPassword']))
            $password2 = htmlspecialchars($_POST["repeatPassword"]);

	if(isset($_POST['submit']) AND $_POST['submit']=='Valider'){
			$alerteRe = '<h3>Inscription</h3>';
			if(verify_password($password1,$password2)){
				$getReq = $db->query("INSERT INTO users VALUES('0', '$pseudo', '$email', '$password1')");
				header('Location: connect.php');
			 	$getReq->closeCursor();
			}else{
				$alerteRe = '<h3>Inscription - <span style="color:#fd7a01;">Passwords non identiques</span></h3>';
			}
	}
	
?>

<div id="main"><!-- sous partie du main -->
<section id="content">
<div id="left">

<?php echo $alerteRe ?>

<br>

	<div>
  	<form method="post">
    <label for="fname"><strong>PSEUDO :</strong> </label>
    <input type="text" id="ipseudo" name="fpseudo" placeholder="Entrer votre pseudo" maxlength="15" required>
	
	<label for="lname"><strong>EMAIL :</strong></label>
    <input type="email" id="iemail" name="femail" placeholder="Entrer votre mail"  maxlength="20" required>

    <label for="country"><strong>PASSWORD :</strong> </label>
 	<input type="password" id="ipassword" name="fpassword" placeholder="Entrer votre mot de passe" maxlength="15" required>
	
	<label for="country"><strong>PASSWORD :</strong> </label>
 	<input type="password" id="ipassword" name="repeatPassword" placeholder="Confirmer votre mot de passe" maxlength="15" required>

  	<br><br>
  	<div class="wrap">
	
    <div class='element'>
	<input type="submit" name="submit" value="Valider">
	<input type="reset" value="Reset" name="reset" id="reset" />
	</div>
	</div>
  </form>
</div>
<br>
</div>
<?php
}else{
	header('Location:connect.php');
}
require_once('includes/sidebar.php');
?>

</section>
</div>

<?php
require_once('includes/footer.php');
?>