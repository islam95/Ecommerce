<?php
	
$url = URL::getURL(array('action', 'id'));

require_once('template/header.php');
require_once('template/navigation.php'); 
require_once('template/sidebar.php'); 

?>

<h2>Update business - Successful</h2>

<p>Business has been updated successfully!<br>
	
<a href="<?php echo $url; ?>">Go back to the business record.</a></p>

<?php require_once('template/footer.php'); ?>