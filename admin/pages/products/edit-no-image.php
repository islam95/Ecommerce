<?php
	
$url = URL::getURL(array('action', 'id'));

require_once('template/header.php');
require_once('template/navigation.php'); 
require_once('template/sidebar.php'); 

?>

<h2>Edit product - Successful</h2>

<p>The product has been edited successfully without changing the image!<br>
	
<a href="<?php echo $url; ?>">Go back to the list of products.</a></p>

<?php require_once('template/footer.php'); ?>