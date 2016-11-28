<?php 

$id = URL::getParameter('id');
if(!empty($id)){	

	$newProducts = new Products();
	$category = $newProducts->getCategory($id);
	
	if(!empty($category)){
		
		$form = new Form();
		$validation = new Valid($form);
		
		if($form->isPost('name')) {
			
			$validation->expected = array('name');
			$validation->required = array('name');
			$name = $form->getPost('name');
			
			if($newProducts->sameCategory($name, $id)){
				$validation->addErrors('category_exists');
			}
			
			if($validation->isValid()){
				
				if($newProducts->updateCategory($name, $id)){
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
		
	<h2>Edit category</h2>
	
	<form class="addProduct" action="" method="post">
		<table>
			<tr>
				<th><label for="name">Name:<span>*</span> </label></th>
				<td>
					<?php 
						echo $validation->validate('name'); 
						echo $validation->validate('category_exists'); 
						?>
					<input type="text" name="name" id="name" 
						value="<?php echo $form->textField('name', $category['name']); ?>" class="" />
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td>
					<label for="btn">
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



