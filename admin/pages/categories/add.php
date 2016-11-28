<?php 
$form = new Form();
$validation = new Valid($form);

if($form->isPost('name')) {
	
	$validation->expected = array('name');
	$validation->required = array('name');
	
	$newProducts = new Products();
	
	if($newProducts->sameCategory($form->getPost('name'))){
		$validation->addErrors('category_exists');
	}
	
	if($validation->isValid()) {
		
		if($newProducts->addCategory($form->getPost('name'))) {
			Check::redirect(URL::getURL(array('action', 'id')).'&action=add-success');
		} else {
			Check::redirect(URL::getURL(array('action', 'id')).'&action=add-failed');
		}
	}
	
}

require_once('template/header.php'); 
require_once('template/navigation.php'); 
require_once('template/sidebar.php'); 
?>

<h2>New category</h2>

<form name="addProduct" action="" method="post" class="addProduct">
	<table>
		<tr>
			<th><label for="name">Name:<span>*</span> </label></th>
			<td>
				<?php 
					echo $validation->validate('name'); 
					echo $validation->validate('category_exists'); 
				?>
				<input type="text" name="name" id="name" 
					value="<?php echo $form->textField('name'); ?>" />
			</td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td>
				<label for="btn" class="">
					<input type="submit" id="btn" class="add_product" value="Add"  style="float: left; margin:11px 0px 50px 0px;" />
				</label>
			</td>
		</tr>
	</table>
</form>


<?php require_once('template/footer.php'); ?>



