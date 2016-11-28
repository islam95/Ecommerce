<?php 
	
	$newUser = new User();
	$newOrder = new Order();
	$srch = URL::getParameter('srch');
	
	if(!empty($srch)){
		$users = $newUser->getUsers($srch);
		$empty = 'Sorry, we were unable to find what you were looking for.';
	} else {
		$users = $newUser->getUsers();
		$empty = 'There are currently no records.';
	}
	$paging = new Paging($users, 10);
	$rows = $paging->getRecords();
	$records = count($users);
	
	require_once('template/header.php');
	require_once('template/navigation.php');
	require_once('template/sidebar.php');
?>

<h3>Customers</h3>

<form action="" method="get">
	<?php echo URL::getSearchParams(array('srch', Paging::$paging)); ?>
	<table>
		<tr>
			<th><label for="srch">Name:</label></th>
			<td>
				<input type="text" name="srch" id="srch" value="<?php echo stripcslashes($srch); ?>" class="srch" />
			</td>
			<td>
				<label for="add_btn" class="">
				<input type="submit" id="add_btn" class="search_btn" value="Search" />
				</label>
			</td>
		</tr>
	</table>
</form>

<p class="records"><?php echo "Customers: ".$records; ?></p>

<?php if (!empty($rows)){ ?>
<div class="admin_table">
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th class="t_right">Update</th>
				<th class="t_right">Remove</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($rows as $user) { ?>
			<tr>
				<td><?php echo Check::encodeHTML($user['last_name']." ".$user['first_name']); ?></td>
				<td class="t_right"><a href="?page=customers&amp;action=update&amp;id=<?php echo $user['id']; ?>">Update</a></td>
				<td class="t_right">
				<?php 
					$orders = $newOrder->getUserOrders($user['id']);
					if(empty($orders)){ ?>
						<a href="?page=customers&amp;action=remove&amp;id=<?php echo $user['id']; ?>">Remove</a>
				<?php } else{ ?>
						<span class="inactive">Remove</span>
				<?php }	?>
				</td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<?php 
	echo $paging->getPaging();

	} else{
		echo '<p class="empty">'.$empty.'</p>';
	}

	require_once('template/footer.php'); 
?>
	
	