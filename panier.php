<?php
require_once('includes/header.php');
require_once('includes/functions_panier.php');
require_once('includes/paypal.php');
?>

<div id="main"><!-- sous partie du main -->
<section id="content">
<div id="left">
<h3>Mon panier</h3>
<?php
$erreur = false;

$action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action']:null));

if($action!==null) {

	if(!in_array($action, ['ajout', 'suppression', 'refresh'])) $erreur = true;

	$l = (isset($_POST['l'])?$_POST['l']:(isset($_GET['l'])?$_GET['l']:null));
	$q = (isset($_POST['q'])?$_POST['q']:(isset($_GET['q'])?$_GET['q']:null));
	$p = (isset($_POST['p'])?$_POST['p']:(isset($_GET['p'])?$_GET['p']:null));

	$l = preg_replace('#\v#', '', $l);

	$p = floatval($p);

	if(is_array($q)){
		$QteArticle = [];
		foreach($q as $contenu){
			$QteArticle[] = intval($contenu);
		}
	} else {
		$q = intval($q);
	}

}

if(!$erreur) {

	switch($action) {

		case "ajout":
			ajouterArticle($l,$q,$p);
			break;

		case "suppression":
			supprimerArticle($l);
			break;

		case "refresh":
			for($i = 0;$i<count($QteArticle);$i++) {
				modifierQTeArticle($_SESSION['panier']['slugProduit'][$i], round($QteArticle[$i]));
			}
			break;
	}

}

?>

<form method="post" action="">
	<table width="400">
		<tr>
			<td colspan="4">Votre panier</td>
		</tr>
		<tr>
			<td>Libellé produit</td>
			<td>Prix unitaire</td>
			<td>Quantité</td>
			<td>TVA</td>
			<td>Action</td>
		</tr>
		<?php

			if(isset($_GET['deletepanier']) && $_GET['deletepanier'] == true){
				supprimerPanier();
			}

			if(creationPanier($db)) {
				$nbProduits = count($_SESSION['panier']['libelleProduit']);

				if($nbProduits <= 0) {
					echo'<br/><p style="font-size:20px; color:#fd7a01;">Oops, panier vide !</p>';
				} else {

				$total = MontantGlobal();
				$totaltva = MontantGlobalTVA();
				$shipping = CalculFraisPorts();

				//TEST PAYPAL

				$paypal = new Paypal();

				$params = array(
				 	'RETURNURL' => 'http://127.0.0.1/Boutique/process.php',
				 	'CANCELURL' => 'http://127.0.0.1/Boutique/cancel.php',
				 	'PAYMENTREQUEST_0_AMT' => $totaltva + $shipping,
				 	'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR',
				 	'PAYMENTREQUEST_0_SHIPPINGAMT' => $shipping,
				 	'PAYMENTREQUEST_0_ITEMAMT' => $totaltva
				 );

				 $response = $paypal->request('SetExpressCheckout', $params);

				 if($response) {
				 	$paypal = 'https://sandbox.paypal.com/webscr?cmd=_express-checkout&useraction=commit&token=' . $response['TOKEN'];
				 } else {
				 	var_dump($paypal->errors);
				 	die('Erreur Paypal');
				 }

				 //FIN TEST PAYPAL

				for($i = 0; $i<$nbProduits; $i++) {

					?>

					<tr>

						<td><br/><?php echo $_SESSION['panier']['libelleProduit'][$i]; ?></td>
						<td><br/><?php echo $_SESSION['panier']['prixProduit'][$i];?></td>
						<td><br/><input name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i]; ?>" size="5"/></td>
						<td><br/><?php echo $_SESSION['panier']['tva']." %"; ?></td>
						<td><br/><a href="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]); ?>">X</a></td>

					</tr>
					<?php } ?>
					<tr>

						<td colspan="2"><br/>
							<p>Total : <?php echo $total." €"; ?></p><br/>
							<p>Total avec TVA : <?php echo $totaltva." €"; ?></p>
							<p>Calcul des frais de port : <?php echo $shipping." €"; ?></p>
	<?php if(isset($_SESSION['user_id'])){ ?><a href="<?php echo $paypal; ?>">Payer la commande</a><?php }else{?><h4 style="color:red;">Vous devez être connecté pour payer votre commande. <a href="connect.php">Se connecter</a></h4><?php } ?>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<input type="submit" value="rafraichir"/>
							<input type="hidden" name="action" value="refresh"/>
							<a href="?deletepanier=true">Supprimer le panier</a>
						</td>
					</tr>

					<?php
			}

		}

		?>
	</table>
</form>

</div>

<?php
require_once('includes/sidebar.php');
?>

</section>
</div>

<?php
require_once('includes/footer.php');
?>