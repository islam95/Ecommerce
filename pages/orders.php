<?php
	Login::noAccess();
	
	$newOrder = new Order();
	$orders = $newOrder->getUserOrders(Session::getSession(Login::$user_login));
	
	$newPaging = new Paging($orders, 10);
	$rows = $newPaging->getRecords();
	
	require_once('header.php');
	require_once('offerSection.php');
	require_once('navigation.php');
	require_once('sidebar.php'); 

	if(!empty($rows)){ ?>
	
	<div id="cart">
		<h2>My orders</h2>
		<table>
			<tr class="bold">
				<th>Order &#35;</th>
				<th>Date</th>
				<th>Status</th>
				<th>Total</th>
				<th>Invoice</th>
			</tr>		
			<tr>
				<td colspan="5"><hr /></td>
			</tr>
	<?php foreach($rows as $row){ ?>
			<tr>
				<td><?php echo $row['id']; ?></td>	
				<td><?php echo Check::setDate(1, $row['date']); ?></td>
				<td>
				<?php 
					$status = $newOrder->getStatus($row['status']);
					echo $status['name'];
					?>
				</td>
				<td>
					&pound;<?php echo number_format($row['total'], 2); ?>
				</td>
				<td>
				<?php
					if($row['paypal_status'] == 1 || $row['payment_status'] == 'Cash'){
						echo '<a href="?page=invoice&amp;id=';
						echo $row['id'];
						echo '" target="_blank">Invoice</a>';
					} else{
						echo '<span class="inactive">Invoice</span>';
					}
					?>
				</td>
			</tr>	
			<tr>
				<td colspan="5"><hr /></td>
			</tr>
	<?php } ?>
		</table>
	</div>	
		
	<?php echo $newPaging->getPaging(); ?>
<?php
	} else { ?>
		<h2>My orders</h2>
		<p>Currently, you do not have any orders.</p>	
<?php } ?> 

<?php require_once('footer.php'); ?>



