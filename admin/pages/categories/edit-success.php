<?php
	
$url = URL::getURL(array('action', 'id'));

require_once('template/header.php');
require_once('template/navigation.php'); 
require_once('template/sidebar.php'); 

?>

<h2>Edit category - Successful</h2>

<p>The category has been edited successfully!<br>
	
<a href="<?php echo $url; ?>">Go back to the list of categories.</a></p>

<?php require_once('template/footer.php'); ?>