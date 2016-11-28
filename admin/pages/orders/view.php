<?php 

$id = URL::getParameter('id');
if(!empty($id)){	

	$newOrder = new Order();
	$order = $newOrder->getOrder($id);
	
	if(!empty($order)){
		
		$form = new Form();
		$validation = new Valid($form);
		
		$newUser = new User();
		$user = $newUser->getUser($order['user']);
		
		$newProducts = new Products();
		$products = $newOrder->getOrderItems($id);
		
		$status = $newOrder->getStatuses();
		
		if($form->isPost('status')) {
			
			$validation->expected = array('status', 'notes');
			$validation->required = array('status');
			
			$fields = $form->getPostArray($validation->expected);
			
			if($validation->isValid()){
				
				if($newOrder->updateOrder($id, $fields)){
					Check::redirect(URL::getURL(array('action', 'id')).'&action=edit-success');
				} else {
					Check::redirect(URL::getURL(array('action', 'id')).'&action=edit-failed');
				}
			}	
		}
		require_once('template/header.php'); 
		require_once('template/navigation.php'); 
		require_once('template/sidebar.php'); 
		?>
		
	<h3>View Order</h3>
	
	<form action="" method="post">
	<div class="admin_table view_order">
		<table>
			<tr>
				<th>Date:</th>
				<td colspan="4"><?php echo Check::setDate(2, $order['date']); ?></td>
			</tr>
			<tr>
				<th>Order #:</th>
				<td colspan="4"><?php echo $order['id']; ?></td>
			</tr>
			
			<?php if(!empty($products)){ ?>
				<tr>
					<th rowspan="<?php echo count($products)+1; ?>">Products:</th>
					<td>id</td>
					<td>Product</td>
					<td class="t_right">Qty</td>
					<td class="t_right">Amount</td>
				</tr>
				<?php foreach($products as $product) { 
						$item = $newProducts->getProduct($product['product']);
				?>
						<tr>
							<td><?php echo $item['id']; ?></td>
							<td><?php echo Check::encodeHTML($item['name']); ?></td>
							<td class="t_right"><?php echo $product['qty']; ?></td>
							<td class="t_right">&pound;<?php echo number_format(($product['price'] * $product['qty']), 2); ?></td>
						</tr>
				<?php } ?>
			
			<?php } ?>
			
			<tr>
				<th>Total:</th>
				<td colspan="4" class="t_right"><strong>&pound;<?php echo number_format($order['total'], 2); ?></strong></td>
			</tr>
			<tr>
				<th>Customer:</th>
				<td colspan="4">
					<?php 
					echo Check::encodeHTML($user['first_name']." ".$user['last_name']).'<br>';
					echo Check::encodeHTML($user['address_1']).'<br>';
					echo Check::encodeHTML($user['address_2']).'<br>';
					echo Check::encodeHTML($user['city']).'<br>';
					echo Check::encodeHTML($user['post_code']).'<br>';
					echo Check::encodeHTML($user['country']).'<br>';
					echo '<a href="mailto:'.$user['email'].'">'.$user['email'].'</a>';	
					?>
				</td>
			</tr>
			<tr>
				<th>Payment:</th>
				<td colspan="4">
					<?php 
						echo !empty($order['payment_status']) ? 
						Check::encodeHTML($order['payment_status']) : 
						"Pending";
					?>
				</td>
			</tr>
			<tr>
				<th><label for="status">Order status:</label></th>
				<td colspan="4">
					<?php 
						$validation->validate('status');
						if(!empty($status)){ ?>
						<select name="status" id="status" class="">
							<?php foreach($status as $s){ ?>
							<option value="<?php echo $s['id']; ?>" 
							<?php echo $form->selectField('status', $s['id'], $order['status']); ?>>
							<?php echo Check::encodeHTML($s['name']); ?></option>
							<?php } ?>
						</select>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<th><label for="notes">Notes:</label></th>
				<td colspan="4" class="no_border">
					<textarea name="notes" id="notes" cols="" rows="" class="">
						<?php echo $form->textField('notes', $order['notes']); ?>
					</textarea>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td colspan="4" class="no_border">
					<div class="float_r">
						<a href="<?php echo URL::getURL(array('action')).'&action=invoice'; ?>" class="invoice_orders" 
							target="_blank">Invoice</a>
					</div>
					
					<div class="float_l">
						<a href="<?php echo URL::getURL(array('action', 'id')); ?>" class="back_order">Go back</a>
					</div>
					
					<label for="update_orders" class="float_l">
						<input type="submit" id="update_orders" class="update_orders" value="Update" />
					</label>
				</td>
			</tr>
		</table>
	</div>
	</form>
<?php 
		require_once('template/footer.php');
	} 
}
?>



