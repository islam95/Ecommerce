<?php 

$newCompany = new Company();
$business = $newCompany->getCompany();

if(!empty($business)){
	
	$form = new Form();
	$validation = new Valid($form);
	
	if($form->isPost('name')){
		$validation->expected = array(
			'name',
			'address',
			'phone',
			'email',
			'website'
		);
		
		$validation->required = array(
			'name',
			'address',
			'phone',
			'email'
		);
		
		$validation->spec_field = array(
			'email' => 'email'
		);
		
		$fields = $form->getPostArray($validation->expected);
		
		if($validation->isValid()){
			if($newCompany->updateCompany($fields)){
				Check::redirect(URL::getURL(array('action', 'id')).'&action=update-success');
			} else {
				Check::redirect(URL::getURL(array('action', 'id')).'&action=update-failed');
			}
		}
		
	}
	
	require_once('template/header.php');
	require_once('template/navigation.php');
	require_once('template/sidebar.php');

?>

	<div id="order">
		<h3>Business</h3>
		
		<form name="business" action="" method="post">
			<table>
				<tr>
					<th>
						<label for="name">Name: <span>*</span></label>
					</th>
					<td>
						<?php echo $validation->validate('name'); ?>
						<input type="text" name="name" 
						id="name" class="ship_input" 
						value="<?php echo $form->textField('name', $business['name']); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="address">Address: <span>*</span></label>
					</th>
					<td class="business_textarea">
						<?php echo $validation->validate('address'); ?>
						<textarea name="address" id="address" cols="" rows="">
						<?php echo $form->textField('address', $business['address']); ?>
						</textarea>
					</td>
				</tr>
				<tr>
					<th>
						<label for="phone">Telephone: <span>*</span></label>
					</th>
					<td>
						<?php echo $validation->validate('phone'); ?>
						<input type="text" name="phone" 
						id="phone" class="ship_input" 
						value="<?php echo $form->textField('phone', $business['phone']); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="email">Email: <span>*</span></label>
					</th>
					<td>
						<?php echo $validation->validate('email'); ?>						<input type="text" name="email" 
						id="email" class="ship_input" 
						value="<?php echo $form->textField('email', $business['email']); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="website">Website: </label>
					</th>
					<td>
						
						<input type="text" name="website" 
						id="website" class="ship_input" 
						value="<?php echo $form->textField('website', $business['website']); ?>" />
					</td>
				</tr>				
				<tr>
					<td colspan="2">
						<label for="update_business">
						<input type="submit" id="update_business" class="update_customer" value="Update" />
						</label>
					</td>
				</tr>
			</table>
		</form>
	</div>

<?php 
	require_once('template/footer.php');
} 
?>