<?php
require_once('includes/header.php');

if(isset($_GET['show'])){ //Afficher le descriptif/détails d'un produit
		$product = htmlentities($_GET['show']);

		$select = $db->prepare("SELECT * FROM products WHERE slug='$product'");
		$select->execute();	
		$s = $select->fetch(PDO::FETCH_OBJ);

		$alerteRe = $s->title;
		$description = $s->description;
		$description_finale = wordwrap($description,100,'<br />', false);
?>
<div id="main"><!-- sous partie du main -->
	<section id="content">
		<div id="left">
			<?php echo "<h3>$alerteRe</h3>" ?>
			<br/>
			<div style="text-align:center;">
				<img src="imgs/<?php echo $s->slug; ?>.jpg"/>
				<br/><br/>
				<h3>Description</h3>
				<br/>
				<p><?php echo $description_finale; ?></p>
				<br/><br/>
				<h3>Achat</h3>
				<br/>
				<div class="wrap">
					<div class='element'>
						<button type="button" class="button2">En stock : <?php echo $s->stock; ?></button>
					</div> 
					<?php if ($s->stock>0){ ?>
						<span id="myLink"><a href="panier.php?action=ajout&amp;l=<?php echo $s->slug; ?>&amp;q=1&amp;p=<?php echo $s->price; ?>">Ajouter au panier</a></span>
					<?php }else{echo'<h5 style="color:red;">Stock épuisé !</h5>';} ?>
				</div>
			</div>
			<br/>
		</div>
		<?php require_once('includes/sidebar.php'); ?>
	</section>
</div>

<?php 
require_once('includes/footer.php');

	}else if(isset($_GET['category'])){ //reprise du bloc php initial
        $category_slug = $_GET['category'];
        $select = $db->query("SELECT name FROM category WHERE slug = '$category_slug'");
        $results = $select->fetch(PDO::FETCH_OBJ);
        $category = addslashes($results->name);
        $alerteRe = "Catégorie - $category";
        $select = $db->prepare("SELECT * FROM products WHERE category ='$category'");
        $select->execute();
?>

<div id="main"><!-- sous partie du main -->
	<section id="content">
		<div id="left">
			<?php
		    	echo "<h3>$alerteRe</h3>";
		        while($s = $select->fetch(PDO::FETCH_OBJ)){
		            $lenght = 75;
		            $description = $s->description;
		            $new_description = substr($description, 0, $lenght)."...";
		            $description_finale = wordwrap($new_description, 50, '<br />', false);
		    ?>
		    <ul>
		        <li>
		            <div class="img">
		            	<a href="?show=<?php echo $s->slug; ?>"><img src="imgs/<?php echo $s->slug; ?>.jpg"/></a>
		            </div>
		            <div class="info">
			            <a class="title" href="boutique.php?show=<?= htmlspecialchars($s->slug); ?>"><?= htmlspecialchars($s->title); ?></a> <!-- afficher nom du produit -->
			            <p style="height: 50px; overflow: hidden;"><?= htmlspecialchars($s->description); ?></p> <!-- afficher description du produit -->
			            <div class="price">
			            <span class="st">Notre prix :</span><strong><?= htmlspecialchars($s->price); ?>€</strong> <!-- afficher prix du produit -->
			            </div>
			            <div class="actions">
				            <a href="boutique.php?show=<?= htmlspecialchars($s->slug); ?>">Details</a>
				            <a href="panier.php?action=ajout&l=<?= htmlspecialchars($s->slug); ?>&q=1&p=<?= htmlspecialchars($s->price); ?>">Ajouter au panier</a>
			            </div>
		            </div>
		        </li>
		        <?php
		        } //fin du while
		    } //fin du else if
		    ?>
		    </ul>
		</div>
		<?php require_once('includes/sidebar.php'); ?>
	</section>
</div>
<?php require_once('includes/footer.php'); ?>