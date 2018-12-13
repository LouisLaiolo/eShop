<?php
require_once('includes/header.php');
require_once('includes/sidebar.php');

try{

		$db = new PDO('mysql:host=127.0.0.1;dbname=bd_m314', 'root','code51');
		$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER); // les noms de champs seront en caractères minuscules
		$db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION); // les erreurs lanceront des exceptions
						
	}

	catch(Exception $e){

		die('Une erreur est survenue');

	}

require_once('includes/functions_panier.php');
require_once('includes/paypal.php');

$totaltva = MontantGlobalTVA();
$paypal = new Paypal();
$response = $paypal->request('GetExpressCheckoutDetails', array(
	'TOKEN' => $_GET['token']
));

if($response){

	if($response['CHECKOUTSTATUS'] == 'PaymentActionCompleted'){

		header('Location: error.php');

	}

}else{

	var_dump($paypal->errors);
	die();

}

$response = $paypal->request('DoExpressCheckoutPayment', array(
	'TOKEN' => $_GET['token'],
	'PAYERID' => $_GET['PayerID'],
	'PAYMENTACTION' => 'Sale',
	'PAYMENTREQUEST_0_AMT' => $totaltva,
	'PAYMENTREQUEST_0_CURRENCYCODE' => 'EUR'
));

if($response){

	$response2 = $paypal->request('GetTransactionDetails', array(
		'TRANSACTIONID' => $response['PAYMENTREQUEST_0_TRANSACTIONID']
	));

	$name = $response2['SHIPTONAME'];
	$street = $response2['SHIPTOSTREET'];
	$city = $response2['SHIPTOCITY'];
	$state = $response2['SHIPTOSTATE'];
	$date = $response2['ORDERTIME'];
	$transaction_id = $response2['TRANSACTIONID'];
	$amt = $response2['AMT'];
	$shipping = $response2['FEEAMT'];
	$currency_code = $response2['CURRENCYCODE'];
	$user_id = $_SESSION['user_id'];

	$db->query("INSERT INTO transactions VALUES('', '$name', '$street', '$city', '$state', '$date', '$transaction_id', '$amt', '$shipping', '$currency_code', '$user_id')");


	for($i = 0; $i<count($_SESSION['panier']['libelleProduit']); $i++){
		$product = $_SESSION['panier']['libelleProduit'][$i];
		$quantity = $_SESSION['panier']['qteProduit'][$i];
		$insert = $db->query("INSERT INTO products_transactions VALUES('','$product','$quantity', '$transaction_id')");
		$select = $db->query("SELECT * FROM products WHERE title='$product'");
		$r = $select->fetch(PDO::FETCH_OBJ);
		$stock = $r->stock;
		$stock = $stock-$quantity;
		$update = $db->query("UPDATE products SET stock='$stock' WHERE title='$product'");
	}

	header('Location: success.php');

}else{

	var_dump($paypal->errors);
	die();

}

require_once('includes/footer.php');

?>