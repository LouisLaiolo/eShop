<?php
require_once('includes/header.php');
require_once('includes/functions_panier.php');
?>

<div id="main"><!-- sous partie du main -->
	<section id="content">
		<div id="left">
			<?php
				$erreur = false;
				$alerteRe = '<h3>Panier</h3>';
				$action = (isset($_POST['action'])?$_POST['action']:(isset($_GET['action'])?$_GET['action']:null));
				var_dump($action);
				if($action!==null) {
					if(!in_array($action, ['ajout', 'suppression', 'Rafraichir', 'Vider'])) 
						$erreur = true;

					$l = (isset($_POST['l'])?$_POST['l']:(isset($_GET['l'])?$_GET['l']:null));
					$q = (isset($_POST['q'])?$_POST['q']:(isset($_GET['q'])?$_GET['q']:null));
					$p = (isset($_POST['p'])?$_POST['p']:(isset($_GET['p'])?$_GET['p']:null));

					$l = preg_replace('#\v#', '', $l);
					$p = floatval($p);

					if(is_array($q)){
						$QteArticle = [];
						foreach($q as $contenu)
							$QteArticle[] = intval($contenu);
					} else 
						$q = intval($q);
				}
				if(!$erreur) {
					switch($action) {
						case "ajout":
							ajouterArticle($l,$q,$p);
							break;
						case "suppression":
							supprimerArticle($l);
							break;
						case "Rafraichir":
							for($i = 0;$i<count($QteArticle);$i++)
								modifierQTeArticle($_SESSION['panier']['slugProduit'][$i], round($QteArticle[$i])); 
							break;
						case "Vider":
							supprimerPanier();
							$alerteRe = '<h3>Panier - <span style="color:#fd7a01;">vide</span></h3>';
							break;
					}
				}
				if(creationPanier($db)) {
					$nbProduits = count($_SESSION['panier']['libelleProduit']);
					if($nbProduits <= 0) {
						$alerteRe = '<h3>Panier - <span style="color:#fd7a01;">vide</span></h3>';
						$total = 0;
						$totaltva = 0;
						$shipping = 0;
					}
				}
			?>
			<form method="post">
				<table width="400">
					<?php echo $alerteRe; ?>
					<tr>
						<td><strong>Libellé produit</strong></td>
						<td><strong>Prix unitaire</strong></td>
						<td><strong>Quantité</strong></td>
						<td><strong>TVA</strong></td>
						<td><strong>Action</strong></td>
					</tr>
					<?php
						if(creationPanier($db)) {
							$nbProduits = count($_SESSION['panier']['libelleProduit']);
							if($nbProduits > 0) {
								$total = MontantGlobal();
								$totaltva = MontantGlobalTVA();
								$shipping = CalculFraisPorts();
								for($i = 0; $i<$nbProduits; $i++) {
					?>
									<tr>
										<td><?php echo $_SESSION['panier']['libelleProduit'][$i]; ?></td>
										<td><?php echo $_SESSION['panier']['prixProduit'][$i];?></td>
										<td><input name="q[]" value="<?php echo $_SESSION['panier']['qteProduit'][$i]; ?>" size="1"/></td>
										<td><?php echo $_SESSION['panier']['tva']." %"; ?></td>
										<td><a href="panier.php?action=suppression&amp;l=<?php echo rawurlencode($_SESSION['panier']['libelleProduit'][$i]); ?>">X</a></td>
									</tr>
									<?php 
								} 
							?>
								<?php 
							} else { 
						?>
									<tr>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>
								<?php
								}
							} 
						?>
				</table>
				<table>
					<h3>Total</h3>
					<tr>
						<td><strong>Montant</strong></td>
						<td><strong>Montant avec TVA</strong></td>
						<td><strong>Calcul des frais de port</strong></td>
					</tr>
					<tr>
						<td><?php echo $total." €"; ?></td>
						<td><?php echo $totaltva." €"; ?></td>
						<td><?php echo $shipping." €"; ?></td>
					</tr>
				</table>
				<br/>
				<div class="wrap">
						<input type="submit" name="action" value="Rafraichir"/>
						<input type="submit" name="action" value="Vider"/>
				</div>
			</form>
		</div>
		<?php require_once('includes/sidebar.php'); ?>
	</section>
</div>

<?php require_once('includes/footer.php'); ?>