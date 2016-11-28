<?php 
	
	$newProducts = new Products();
	$srch = URL::getParameter('srch');
	
	if(!empty($srch)){
		$products = $newProducts->getAllProducts($srch);
		$empty = 'Sorry, we were unable to find what you were looking for.';
	} else {
		$products = $newProducts->getAllProducts();
		$empty = 'There are currently no records.';
	}
	$paging = new Paging($products, 10);
	$rows = $paging->getRecords();
	$records = count($products);
	
	require_once('template/header.php');
	require_once('template/navigation.php');
	require_once('template/sidebar.php');
?>

<h3>Products</h3>

<form action="" method="get">
	<?php echo URL::getSearchParams(array('srch', Paging::$paging)); ?>
	<table>
		<tr>
			<th><label for="srch">Product:</label></th>
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

<div class="space">&nbps;</div>
<p class="records"><?php echo "Products: ".$records; ?></p>

<?php if (!empty($rows)){ ?>
<a class="add_product" href="?page=products&amp;action=add">+ Add product</a>
<div class="admin_table">
	<table>
		<thead>
			<tr>
				<th class="id">Id</th>
				<th>Product</th>
				<th class="t_right">Edit</th>
				<th class="t_right">Remove</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($rows as $product) { ?>
			<tr>
				<td><?php echo $product['id']; ?></td>
				<td><?php echo Check::encodeHTML($product['name']); ?></td>
				<td class="t_right"><a href="?page=products&amp;action=edit&amp;id=<?php echo $product['id']; ?>">Edit</a></td>
				<td class="t_right"><a href="?page=products&amp;action=remove&amp;id=<?php echo $product['id']; ?>">Remove</a></td>
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
	
	