<?php
	
$url = URL::getURL(array('action', 'id'));

require_once('template/header.php');
require_once('template/navigation.php'); 
require_once('template/sidebar.php'); 

?>

<h2>Update customer - Successful</h2>

<p>The customer record has been updated successfully!<br>
	
<a href="<?php echo $url; ?>">Go back to the list of customers.</a></p>

<?php require_once('template/footer.php'); ?>