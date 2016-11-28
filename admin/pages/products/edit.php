<?php 

$id = URL::getParameter('id');
if(!empty($id)){	

	$newProducts = new Products();
	$product = $newProducts->getProduct($id);
	
	if(!empty($product)){
		
		$categories = $newProducts->getCategories();
		$form = new Form();
		$validation = new Valid($form);
		
		$newColours = new Colour();
		$colours = $newColours->getColours();
		
		$newSize = new Size();
		$sizeNumbers = $newSize->getSizeNumbers();
		$sizeLetters = $newSize->getSizeLetters();
		
		if($form->isPost('name')) {
			
			$validation->expected = array(
				'category',
				'name',
				'description',
				'price',
				'brand',
				'colour',
				'size_letter',
				'size_number'
			);
			
			$validation->required = array(
				'category',
				'name',
				'description',
				'price'
			);
			
			if($validation->isValid()){
				
				if($newProducts->updateProduct($validation->post, $id)){
					$upload = new Upload();
					
					if($upload->upload(PRODUCTS_PATH)){
						// removing the old image if the new one is uploaded
						if(is_file(PRODUCTS_PATH.DIR_SEP.$product['image'])){
							unlink(PRODUCTS_PATH.DIR_SEP.$product['image']); 
						}
						
						$newProducts->updateProduct(array('image' => $upload->names[0]), $id);
						Check::redirect(URL::getURL(array('action', 'id')).'&action=edit-success');
					} else {
						Check::redirect(URL::getURL(array('action', 'id')).'&action=edit-no-image');
					}
				} else {
					Check::redirect(URL::getURL(array('action', 'id')).'&action=edit-failed');
				}
			}
			
		}
		
		require_once('template/header.php'); 
		require_once('template/navigation.php'); 
		require_once('template/sidebar.php'); 
		?>
		
	<h2>Edit product</h2>
	
	<form class="addProduct" action="" method="post" enctype="multipart/form-data">
		<table>
			<tr>
				<th><label for="category">Category:<span>*</span> </label></th>
				<td>
					<?php echo $validation->validate('category'); ?>
					<select name="category" id="category" class="">
						<option value=""></option>
						<?php if(!empty($categories)) { ?>
							<?php foreach($categories as $cat) { ?>
							<option value="<?php echo $cat['id']; ?>"
							<?php echo $form->selectField('category', $cat['id'], $product['category']); ?>>
							<?php echo Check::encodeHTML($cat['name']); ?>
							</option>
							<?php } ?>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="name">Name:<span>*</span> </label></th>
				<td>
					<?php echo $validation->validate('name'); ?>
					<input type="text" name="name" id="name" 
						value="<?php echo $form->textField('name', $product['name']); ?>" class="" />
				</td>
			</tr>
			<tr>
				<th><label for="description">Description:</label></th>
				<td>
					<?php echo $validation->validate('description'); ?>
					<textarea name="description" id="description" cols="" rows="">
					<?php echo $form->textField('description', $product['desciption']); ?></textarea>
				</td>
			</tr>
			<tr>
				<th><label for="price">Price:<span>*</span> </label></th>
				<td>
					<?php echo $validation->validate('price'); ?>
					<input type="text" name="price" id="price" 
						value="<?php echo $form->textField('price', $product['price']); ?>" />
				</td>
			</tr>
			<tr>
				<th><label for="brand">Brand: </label></th>
				<td>
					<?php echo $validation->validate('brand'); ?>
					<input type="text" name="brand" id="brand" 
						value="<?php echo $form->textField('brand', $product['brand']); ?>" class="" />
				</td>
			</tr>
			<tr>
				<th><label for="colour">Colour: </label></th>
				<td>
					<?php echo $validation->validate('colour'); ?>
					<select name="colour" id="colour" class="">
						<option value=""></option>
						<?php if(!empty($colours)) { ?>
							<?php foreach($colours as $colour) { ?>
							<option value="<?php echo $colour['id']; ?>"
							<?php echo $form->selectField('colour', $colour['id'], $product['colour']); ?>>
							<?php echo Check::encodeHTML($colour['colour']); ?>
							</option>
							<?php } ?>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th>Size: </th>
				<td>
					<?php echo $validation->validate('size_number'); ?>
					<select name="size_number" id="size_number" class="">
						<option value=""></option>
						<?php if(!empty($sizeNumbers)) { ?>
							<?php foreach($sizeNumbers as $size) { ?>
							<option value="<?php echo $size['id']; ?>"
							<?php echo $form->selectField('size_number', $size['id'], $product['size_number']); ?>>
							<?php echo Check::encodeHTML($size['size_number']); ?>
							</option>
							<?php } ?>
						<?php } ?>
					</select>
					or
					<?php echo $validation->validate('size_letter'); ?>
					<select name="size_letter" id="size_letter" class="">
						<option value=""></option>
						<?php if(!empty($sizeLetters)) { ?>
							<?php foreach($sizeLetters as $size) { ?>
							<option value="<?php echo $size['id']; ?>"
							<?php echo $form->selectField('size_letter', $size['id'], $product['size_letter']); ?>>
							<?php echo Check::encodeHTML($size['size_letter']); ?>
							</option>
							<?php } ?>
						<?php } ?>
					</select>
				</td>
			</tr>
			<tr>
				<th><label for="image">Image:</label></th>
				<td>
					<?php echo $validation->validate('image'); ?>
					<input type="file" name="image" id="image" size="30" />
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td>
					<label for="btn" class="">
						<input type="submit" id="btn" class="add_product" style="float: left; margin:11px 0px 50px 0px;" value="Edit" />
					</label>
				</td>
			</tr>
		</table>
	</form>
<?php 
		require_once('template/footer.php');
	} 
}
?>



