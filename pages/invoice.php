<?php
Login::noAccess();

$id = URL::getParameter('id');

if(!empty($id)) {
	$newOrder = new Order();
	$order = $newOrder->getOrder($id);
	
	if(!empty($order) && Session::getSession(Login::$user_login) == $order['user']){
		$items = $newOrder->getOrderItems($id);
		
		$newProducts = new Products();
		
		$newUser = new User();
		$user = $newUser->getUser($order['user']);
		
		$newCompany = new Company();
		$company = $newCompany->getCompany();
		
		$newBasket = new Basket();
?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Invoice</title>
		<meta name="Author" content="Islam Dudaev" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="css/invoice.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id="invoice">
			<h1>Invoice</h1>
			<!-- This div will be on the left side - user info -->
			<div class="user_info">		
				<p><strong>To:</strong>
				<?php echo $user['first_name']." ".$user['last_name']; ?><br>
				<?php echo $user['address_1']; ?><br>
				<?php echo !empty($user['address_2']) ? $user['address_2'].'<br>' : null; ?>
				<?php echo $user['city']; ?><br>
				<?php echo $user['county']; ?><br>
				<?php echo $user['post_code']; ?><br>
				<?php echo $user['country']; ?>
				</p>		
			</div>
			<!-- This div will be on the right side - business info -->
			<div class="company_info">
				<p><strong><?php echo $company['name']; ?></strong><br>
				<!-- replacing new line tags with <br /> tags -->
				<?php echo nl2br($company['address']); ?><br>
				<?php echo $company['phone']; ?><br>
				<?php echo $company['email']; ?><br>
				<?php echo $company['website']; ?>
				</p>
			</div>
			<!-- non-breakable space -->
			<div class="space">&nbps;</div>
			
			<h3>Order &#35;: <?php echo $id; ?></h3>
			<table>
				<tr>
					<th>Product</th>
					<th class="right">Qty</th>
					<th class="right price">Price</th>
				</tr>
			<?php foreach($items as $item) { ?>
				<tr>
					<td>
					<?php
						$product = $newProducts->getProduct($item['product']);
						echo $product['name'];
					?>
					</td>
					<td class="right"><?php echo $item['qty']; ?></td>
					<td class="right">
						&pound;<?php echo number_format($newBasket->priceByQty($item['price'], $item['qty']), 2); ?>
					</td>
				</tr>
			<?php } ?>
				<tr>
					<td colspan="2" class="dashed"><strong>Total:</strong></td>
					<td class="right dashed">
						<strong>&pound;<?php echo number_format($order['total'], 2); ?></strong>
					</td>
				</tr>
			</table>
			<!-- non-breakable space -->
			<div class="space dashed">&nbps;</div>
			<!-- Link to print the invoice -->
			<p><a href="#" onclick="window.print(); return false;">Print invoice</a></p>
		</div>
	</body>
</html>

<?php 
	} 
} ?>