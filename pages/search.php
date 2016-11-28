<?php
	
	require_once('header.php');
	require_once('offerSection.php');
	require_once('navigation.php');
	require_once('sidebar.php');
	
	$newProducts = new Products();
	$q = URL::getParameter('q');
	$cat = URL::getParameter('category');
	$category = $newProducts->getCategory($cat);
	
	if(!empty($q)){
		$products = $newProducts->getAllProducts($q);
		$empty = 'Sorry, we were unable to find what you were looking for.';
	} else {
		$products = $newProducts->getAllProducts();
		$empty = 'There are currently no records.';
	}
	
	$paging = new Paging($products);
	$rows = $paging->getRecords();
	
	
?>

<?php if (!empty($rows)){ ?>

	<div class="productRow">

<?php
	foreach($rows as $product){

		$image = !empty($product['image']) ? $newProducts->path.$product['image'] : 'images/ImageUnavailable.png';	
?>	
		<div class="productInfo">
			<div>
				<a href="?page=product&amp;category=<?php echo $category['id']; ?>&amp;id=<?php echo $product['id']; ?>">
					<img src="<?php echo $image; ?>" alt="<?php echo Check::encodeHtml($product['name'], 1); ?>" />
				</a>
			</div>
			<p class="productContent">
				<a href="?page=product&amp;category=<?php echo $category['id']; ?>&amp;id=<?php echo $product['id']; ?>">
					<?php echo Check::encodeHtml($product['name'], 1); ?>
				</a>
			</p>
			<p class="price">
				<?php echo Products::$currency; echo number_format($product['price'], 2); ?>
			</p>
			<p><?php echo Basket::activeButton($product['id']); ?></p>
		</div>
<?php 
	}
	echo $paging->getPaging();
?>
	</div>
<?php 
	} else {
		echo '<p>'.$empty.'</p>';
	}
?>
<?php require_once('footer.php'); ?>


