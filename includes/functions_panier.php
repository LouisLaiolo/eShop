<?php
function creationPanier() {
   global $db;
   if (!isset($_SESSION['panier'])) {
      $_SESSION['panier']                   = [];
      $_SESSION['panier']['libelleProduit'] = [];
      $_SESSION['panier']['slugProduit']    = [];
      $_SESSION['panier']['qteProduit']     = [];
      $_SESSION['panier']['prixProduit']    = [];
      $_SESSION['panier']['verrou']         = false;
      $select = $db->query("SELECT tva FROM products LIMIT 1");
      $data   = $select->fetch(PDO::FETCH_OBJ);
      $_SESSION['panier']['tva'] = $data->tva;
   }
   return true;
}

function ajouterArticle($slugProduit, $qteProduit, $prixProduit) {
   global $db;
   if (creationPanier() && !isVerrouille()) {
      $s = $db->query("SELECT title FROM products WHERE slug = '$slugProduit'");
      $r = $s->fetch(PDO::FETCH_OBJ);
      $libelleProduit = $r->title;
      $positionProduit = array_search($slugProduit,  $_SESSION['panier']['slugProduit']);
      if ($positionProduit !== false)
         $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
      else {
         array_push( $_SESSION['panier']['libelleProduit'],$libelleProduit);
         array_push( $_SESSION['panier']['slugProduit'],$slugProduit);
         array_push( $_SESSION['panier']['qteProduit'],$qteProduit);
         array_push( $_SESSION['panier']['prixProduit'],$prixProduit);
      }
   } else 
      echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function modifierQTeArticle($slugProduit,$qteProduit){
   //Si le panier existe
   if (creationPanier() && !isVerrouille()){
      //Si la quantité est positive on modifie sinon on supprime l'article
      if ($qteProduit > 0){
         //Recharche du produit dans le panier
         $positionProduit = array_search($slugProduit,  $_SESSION['panier']['slugProduit']);
         if ($positionProduit !== false)
            $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
         else
            supprimerArticle($slugProduit);
      } else
         echo "Un problème est survenu veuillez contacter l'administrateur du site.";
   }
}

function supprimerArticle($slugProduit){
   if (creationPanier() && !isVerrouille()){
      $tmp=[];
      $tmp['libelleProduit'] = [];
      $tmp['slugProduit'] = [];
      $tmp['qteProduit'] = [];
      $tmp['prixProduit'] = [];
      $tmp['verrou'] = $_SESSION['panier']['verrou'];
      $tmp['tva'] = $_SESSION['panier']['tva'];

      for($i = 0; $i < count($_SESSION['panier']['slugProduit']); $i++){
         if ($_SESSION['panier']['slugProduit'][$i] !== $slugProduit){
            array_push( $tmp['libelleProduit'],$_SESSION['panier']['libelleProduit'][$i]);
            array_push( $tmp['slugProduit'],$_SESSION['panier']['slugProduit'][$i]);
            array_push( $tmp['qteProduit'],$_SESSION['panier']['qteProduit'][$i]);
            array_push( $tmp['prixProduit'],$_SESSION['panier']['prixProduit'][$i]);
         }
      }
      $_SESSION['panier'] =  $tmp;
      unset($tmp);
   } else
         echo "Un problème est survenu veuillez contacter l'administrateur du site.";
}

function MontantGlobal(){
   $total = 0;
   for($i = 0; $i < count($_SESSION['panier']['slugProduit']); $i++){
      $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
   }
   return $total;
}

function MontantGlobalTva(){
   $total = 0;
   for($i = 0; $i < count($_SESSION['panier']['slugProduit']); $i++){
      $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
   }
   return $total + $total*$_SESSION['panier']['tva']/100;
}

function supprimerPanier(){
   unset($_SESSION['panier']);
}

function isVerrouille(){
   if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou'])
      return true;
   else
      return false;
}

function compterArticles(){
   if (isset($_SESSION['panier']))
      return count($_SESSION['panier']['slugProduit']);
   else
      return 0;
}

function CalculFraisPorts(){
   global $db;
   $weight_product = 0;
   $shipping = 0;
   for($i = 0; $i < compterArticles(); $i++){
      for($j = 0; $j < $_SESSION['panier']['qteProduit'][$i]; $j++){
         $slug = addslashes($_SESSION['panier']['slugProduit'][$i]);
         $select = $db->query("SELECT weight FROM products WHERE slug='$slug'");
         $result = $select->fetch(PDO::FETCH_OBJ);
         $weight = $result->weight;
         $weight_product += $weight;
      }
   }
   $select2 = $db->query("SELECT * FROM weights WHERE name <= '$weight_product' ORDER BY price DESC");
   $result2 = $select2->fetch(PDO::FETCH_OBJ);
   $shipping = $result2->price;
   return $shipping;
}

?>