<?php
$cat = URL::getParameter('category');

$objProducts = new Products();
$category = $objProducts->getCategory($cat);

require_once('header.php');
require_once('offerSection.php');
require_once('navigation.php');
require_once('sidebar.php'); 

if(!empty($q)){
	$products = $objProducts->getAllProducts($q);
	if(empty($products)){
		$empty = 'Sorry, we were unable to find what you were looking for.';
	}
} else {
	$products = $objProducts->getAll();
	if(empty($products)){
		require_once('no_products.php');
	}
}

if(empty($products)){
	echo '<p>'.$empty.'</p>';
	
} else {
	$paging = new Paging($products);
	$products = $paging->getRecords();
		
?>
	<div class="productRow">

<?php
	foreach($products as $product){
		$aCat = $objProducts->getCategory($product['category']);
		
		$image = !empty($product['image']) ? $objProducts->path.$product['image'] : 'images/ImageUnavailable.png';	
?>	
		<div class="productInfo">
			<div>
				<a href="?page=product&amp;category=<?php echo $aCat['id']; ?>&amp;id=<?php echo $product['id']; ?>">
					<img src="<?php echo $image; ?>" alt="<?php echo Check::encodeHtml($product['name'], 1); ?>" />
				</a>
			</div>
			<p class="productContent">
				<a href="?page=product&amp;category=<?php echo $aCat['id']; ?>&amp;id=<?php echo $product['id']; ?>">
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
<?php require_once('footer.php'); 
}
?>






