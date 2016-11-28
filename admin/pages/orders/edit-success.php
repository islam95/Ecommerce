<?php
	
$url = URL::getURL(array('action', 'id'));

require_once('template/header.php');
require_once('template/navigation.php'); 
require_once('template/sidebar.php'); 

?>

<h2>Edit order - Successful</h2>

<p>The order has been edited successfully!<br>
	
<a href="<?php echo $url; ?>">Go back to the list of orders.</a></p>

<?php require_once('template/footer.php'); ?>