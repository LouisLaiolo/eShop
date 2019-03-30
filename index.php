<?php require_once('includes/header.php'); ?>
<!-- Promo slider -->
<div id="slider">
	<div>
     	<img src="imgs/promo1.png">
   	</div>
   	<div>
     	<img src="imgs/promo3.png">
   	</div>
   	<div>
     	<img src="imgs/promo4.png">
   	</div>
    <div>
     	<img src="imgs/promo5.png">
   </div>
</div>

<div id="main"><!-- sous partie du main -->
	<section id="content">
		<div id="left">
			<h3>Derniers produits</h3>
			<ul>
				<?php
				$ps = $db->query('SELECT * FROM products ORDER BY id DESC LIMIT 6')->fetchAll(PDO::FETCH_OBJ);
				foreach ($ps as $p):
				?>
				<li>
					<!-- afficher l'image du produit -->
				    <div class="img">
				    	<a href="boutique.php?show=<?= htmlspecialchars($p->slug); ?>"><img alt="" src="imgs/<?= htmlspecialchars($p->slug); ?>.jpg"></a>
				    </div> 
				    <div class="info">
					    <a class="title"  href="boutique.php?show=<?= htmlspecialchars($p->slug); ?>"><?= htmlspecialchars($p->title); ?></a> <!-- afficher nom du produit -->
					    <p style="height: 50px;overflow: hidden;"><?= htmlspecialchars($p->description); ?></p> <!-- afficher description du produit -->
					    <div class="price">
					   		<span class="st">Notre prix :</span><strong><?= htmlspecialchars($p->price); ?>€</strong> <!-- afficher prix du produit -->
					    </div>
					    <div class="actions">
					    	<a href="boutique.php?show=<?= htmlspecialchars($p->slug); ?>">Details</a>
					    	<a href="panier.php?action=ajout&l=<?= htmlspecialchars($p->slug); ?>&q=1&p=<?= htmlspecialchars($p->price); ?>">Ajouter au panier</a>
					    </div>
				    </div>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php require_once('includes/sidebar.php'); ?>
	</section>
</div>

<?php require_once('includes/footer.php'); ?>