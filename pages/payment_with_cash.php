<?php
	
$session = Session::getSession('basket'); 

$newOrder = new Order();
$newOrder->createOrder();
$newOrder->cashStatus();

//Clear the basket.
Session::clear('basket');

require_once('header.php');
require_once('offerSection.php');
require_once('navigation.php');
require_once('sidebar.php'); 
?>

<h1>Thank you!</h1>
<p>Thank you for your order.</p>
<p>Please, prepare the cash on delivery.</p>

<?php require_once('footer.php'); ?>