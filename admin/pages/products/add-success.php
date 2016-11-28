<?php
	
$url = URL::getURL(array('action', 'id'));

require_once('template/header.php');
require_once('template/navigation.php'); 
require_once('template/sidebar.php'); 

?>

<h2>New product - Successful</h2>

<p>New product has been added successfully!<br>
	
<a href="<?php echo $url; ?>">Go back to the list of products.</a></p>

<?php require_once('template/footer.php'); ?>