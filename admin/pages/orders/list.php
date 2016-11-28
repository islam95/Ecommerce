<?php 
	
	$newOrder = new Order();
	$srch = URL::getParameter('srch');
	
	if(!empty($srch)){
		$orders = $newOrder->getOrders($srch);
		$empty = 'Sorry, we were unable to find what you were looking for.';
	} else {
		$orders = $newOrder->getOrders($srch);
		$empty = 'There are currently no records.';
	}
	$paging = new Paging($orders, 10);
	$rows = $paging->getRecords();
	$records = count($orders);
	
	require_once('template/header.php');
	require_once('template/navigation.php');
	require_once('template/sidebar.php');
?>

<h3>Orders</h3>

<form action="" method="get">
	<?php echo URL::getSearchParams(array('srch', Paging::$paging)); ?>
	<table>
		<tr>
			<th><label for="srch">Order #:</label></th>
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

<p class="records"><?php echo "Orders: ".$records; ?></p>

<?php if (!empty($rows)){ ?>
<div class="admin_table">
	<table>
		<thead>
			<tr>
				<th>Id</th>
				<th>Date</th>
				<th>Total</th>
				<th>Status</th>
				<th>Payment</th>
				<th>View</th>
				<th>Remove</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($rows as $order) { ?>
			<tr>
				<td><?php echo $order['id']; ?></td>
				<td><?php echo Check::setDate(1, $order['date']); ?></td>
				<td>&pound;<?php echo number_format($order['total'], 2); ?></td>
				<td>
					<?php
						$status = $newOrder->getStatus($order['status']);
						echo $status['name']; 
						?>
				</td>
				<td>
					<?php 
						echo $order['payment_status'] != null ? 
							$order['payment_status'] : "Pending"; 
						?>
				</td>
				<td><a href="?page=orders&amp;action=view&amp;id=<?php echo $order['id']; ?>">View</a></td>
				<td>
					<?php if($order['status'] == 1){ ?>
							<a href="?page=orders&amp;action=remove&amp;id=<?php echo $order['id']; ?>">Remove</a>
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
	
	