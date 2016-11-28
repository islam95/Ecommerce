<?php 
$id = URL::getParameter('id');

if (!empty($id)) {

	$newProducts = new Products();
	$product = $newProducts->getProduct($id);
	
	if (!empty($product)) {
		
		$yes = URL::getURL().'&amp;remove=1';
		$no = 'javascript:history.go(-1)';
		
		$remove = URL::getParameter('remove');
		
		if (!empty($remove)) {
			
			$newProducts->removeProduct($id);
			Check::redirect(URL::getURL(array('action', 'id', 'remove', 'srch', Paging::$paging)));		
		}
		
		require_once('template/header.php');
		require_once('template/navigation.php'); 
		require_once('template/sidebar.php'); 
?>

<h2>Remove product</h2>

<p>Are you sure you want to remove this product?
<br><br>
	
<a href="<?php echo $yes; ?>">Yes</a> | <a href="<?php echo $no; ?>">No</a>
</p>

<?php 
		require_once('template/footer.php'); 
	}	
}
?>