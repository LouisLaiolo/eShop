<div id="right">
	<h3>Top des ventes</h3>
	<ul>
	<?php
		$req = $db->query('SELECT * FROM products ORDER BY RAND() LIMIT 6')->fetchAll(PDO::FETCH_OBJ);
		foreach ($req as $p):
	?>
		<li>
		    <div class="img">
		    	<a href="boutique.php?show=<?= htmlspecialchars($p->slug); ?>"><img alt="" src="imgs/<?= htmlspecialchars($p->slug); ?>.jpg"></a>
		    </div> <!-- afficher l'image du produit -->
		    <div class="info">
			    <a class="title"  href="boutique.php?show=<?= htmlspecialchars($p->slug); ?>"><?= htmlspecialchars($p->title); ?></a> <!-- afficher nom du produit -->
			    <div class="price">
			    	<span class="st"></span><strong><?= htmlspecialchars($p->price); ?>€</strong> <!-- afficher prix du produit -->
			    </div>
		    </div>
		</li>
		<?php endforeach; ?>
	</ul>
</div>