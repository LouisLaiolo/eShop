<?php //Gestion de la modification d'un user
    require_once('includes/header.php');

    $alerteRe = '<h3>Informations personnelles</h3>';
    $user_id = $_SESSION['user_id'];
	$select = $db->query("SELECT * FROM users WHERE id = '$user_id'");

    if (!$select) 
        $alerteRe = '<h3>Informations personnelles - <span style="color:#fd7a01;">Une erreur est survenue</span></h3>';
    if (isset($_POST['fpseudo'])){
            $_SESSION['user_name'] = htmlspecialchars($_POST["fpseudo"]);
            $pseudo = $_SESSION['user_name'];
    }
    if (isset($_POST['femail'])){
            $_SESSION['user_email'] = htmlspecialchars($_POST["femail"]);
            $email = $_SESSION['user_email'];
     }
    if (isset($_POST['fpassword'])){
            $_SESSION['user_password'] = htmlspecialchars($_POST["fpassword"]);
            $password = $_SESSION['user_password'];
    }
    if(isset($_POST['submit']) AND $_POST['submit'] == 'Sauvegarder'){
        $alerteRe = '<h3>Informations personnelles</h3>';
        $getReq = $db->query("UPDATE users SET username = '$pseudo', email = '$email', password = '$password' WHERE id = '$user_id' ");
            if ($getReq){
                $alerteRe = '<h3>Informations personnelles - <span style="color:#7C7CBF;">Modification(s) enregistrée(s)</span></h3>';
                $getReq->closeCursor();
            } else {
                $alerteRe = '<h3>Informations personnelles - <span style="color:#fd7a01;">Une erreur est survenue</span></h3>';
                $getReq->closeCursor();
            }
    }
?>

<?php //Gérer les redirections suite a la deco
    if(isset($_POST['deco']) AND $_POST['deco'] == 'Se deconnecter'){ //Deconnexion de l'utilisateur
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
    }
?>

<div id="main"><!-- sous partie du main -->
    <section id="content">
        <div id="left">
            <?php echo $alerteRe ?>
            <br/>
            <div>
                <form method="post">
                    <label for="fname"><strong>PSEUDO :</strong> </label>
                    <input type="text" id="ipseudo" name="fpseudo" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" maxlength="15" required>
                    <label for="lname"><strong>EMAIL :</strong></label>
                    <input type="email" id="iemail" name="femail" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" maxlength="20" required>
                    <label for="country"><strong>PASSWORD :</strong> </label>
                 	<input type="password" id="ipassword" name="fpassword" value="<?php echo htmlspecialchars($_SESSION['user_password']); ?>" maxlength="15" required>
                  	<br/><br/>
                  	<div class="wrap">
                        <div class='element'>
                            <input type="submit" name="submit" value="Sauvegarder">
                        </div>
                        <form action="disconnect.php" method="post">
                            <input type="submit" value="Se deconnecter" name="deco" id="return_submit" />
                        </form>
                	</div>
              </form>
            </div>
            <br/><br/>
            <h3>Mes transactions</h3>
            <br/>
            <?php
            $select = $db->query("SELECT * FROM transactions WHERE user_id = '$user_id'"); // On récupère tout le contenu de la table transactions correspondant a l'user id
            $s = $select->fetch(PDO::FETCH_OBJ);
            	if(empty($s["id"])){ //On check si le retour est vide
            			echo '<h1 style="color:#fd7a01;"> Aucune transaction enregistrée </h1>'; //Par défaut, puisque sans commande possible, aucune transaction n'est faisable à ce jour
            	} else { //Sinon On affiche chaque entrée une à une
                	while($s){
                		$transaction_id = $s->transaction_id;
                		$select2 = $db->query("SELECT * FROM products_transactions WHERE transaction_id='$transaction_id'");
            ?>
                		<h1>Nom et prénom : <?php echo $s->name; ?></h1>
                		<h1>Rue : <?php echo $s->street; ?></h1>
                		<h1>Ville : <?php echo $s->city; ?></h1>
                		<h1>Pays : <?php echo $s->country; ?></h1>
                		<h1>Date de transaction : <?php echo $s->date; ?></h1>
                		<h1>ID de transaction : <?php echo $s->transaction_id; ?></h1>
                		<h1>Prix total : <?php echo $s->amount; ?></h1>
                		<h1>Frais de port : <?php echo $s->shipping; ?></h1>
                		<h1>Produits : </h1>
                		<?php 
                            while($r = $select2->fetch(PDO::FETCH_OBJ)){
                        ?> 
                		<h1>Nom : <?php echo $r->product; ?></h1>
                		<h1>Quantité : <?php echo $r->quantity; ?></h1>
                	       <?php 
                        } 
                    ?>
                		<h1>Devise utilisée : <?php echo $s->currency_code; ?></h1>
                	<?php
                	}
                } 
            ?>
            <br/>
        </div>
        <?php require_once('includes/sidebar.php'); ?>
    </section>
</div>
<?php require_once('includes/footer.php'); ?>