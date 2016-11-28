<?php 
	$newProducts = new Products();
	$categories = $newProducts->getCategories();
	
	$paging = new Paging($categories, 10);
	$rows = $paging->getRecords();
	$records = count($categories);
	
	require_once('template/header.php');
	require_once('template/navigation.php');
	require_once('template/sidebar.php');
?>

<h3>Categories</h3>

<p class="records"><?php echo "Categories: ".$records; ?></p>

<?php if(!empty($rows)){ ?>
<a class="add_product" href="?page=categories&amp;action=add">+ Add category</a>
<div class="admin_table">
	<table>
		<thead>
			<tr>
				<th>Category</th>
				<th class="t_right">Edit</th>
				<th class="t_right">Remove</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($rows as $category) { ?>
			<tr>
				<td><?php echo Check::encodeHTML($category['name']); ?></td>
				<td class="t_right"><a href="?page=categories&amp;action=edit&amp;id=<?php echo $category['id']; ?>">Edit</a></td>
				<td class="t_right"><a href="?page=categories&amp;action=remove&amp;id=<?php echo $category['id']; ?>">Remove</a></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>

<?php 
	echo $paging->getPaging();

	} else{ ?>
	
		<p>There are currently no categories.</p>
<?php	
	} ?>

<?php	require_once('template/footer.php'); ?>


