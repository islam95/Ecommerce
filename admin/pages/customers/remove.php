<?php 
$id = URL::getParameter('id');

if(!empty($id)){

	$newUser = new User();
	$user = $newUser->getUser($id);
	
	if(!empty($user)){
		
		$newOrder = new Order();
		$orders = $newOrder->getUserOrders($id);
		
		if(empty($orders)){
		
			$yes = URL::getURL().'&amp;remove=1';
			$no = 'javascript:history.go(-1)';
			
			$remove = URL::getParameter('remove');
			
			if(!empty($remove)){
				$newUser->removeUser($id);
				Check::redirect(URL::getURL(array('action', 'id', 'remove', 'srch', Paging::$paging)));		
			}
			
			require_once('template/header.php');
			require_once('template/navigation.php'); 
			require_once('template/sidebar.php'); 
?>

<h2>Remove customer</h2>

<p>Are you sure you want to remove customer <strong><?php echo $user['first_name']." ".$user['last_name']; ?></strong>?
<br><br>
	
<a href="<?php echo $yes; ?>">Yes</a> | <a href="<?php echo $no; ?>">No</a>
</p>

<?php 
			require_once('template/footer.php'); 
		}
	}	
}
?>