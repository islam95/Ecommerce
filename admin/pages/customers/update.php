<?php 

$id = URL::getParameter('id');

if(!empty($id)){

$theUser = new User();
$user = $theUser->getUser($id);

if(!empty($user)){
	$form = new Form();
	$validation = new Valid($form);
	// If form is submitted
	if ($form->isPost('first_name')) {
		// fields that are expected to receieve
		$validation->expect = array(
			'first_name',
			'last_name',
			'address_1',
			'address_2',
			'city',
			'county',
			'post_code',
			'country',
			'email'
		); 
		// fields that are required to fill in
		$validation->required = array(
			'first_name',
			'last_name',
			'address_1',
			'city',
			'post_code',
			'country',
			'email'
		);
		$validation->spec_field = array('email' => 'email');
		
		$email = $form->getPost('email');
		$same_email = $theUser->getByEmail($email);
		
		if(!empty($same_email) && $same_email['id'] != $user['id']){
			$validation->addErrors('same_email');
		}
		
		if($validation->isValid()) {
			if($theUser->updateUser($validation->post, $user['id'])){
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
		<h3>Update customer</h3>
		
		<form name="order" action="" method="post">
			<table>
				<tr>
					<th>
						<label for="first_name">First name: <span>*</span></label>
					</th>
					<td>
						<?php echo $validation->validate('first_name'); ?>
						<input type="text" name="first_name" 
						id="first_name" class="ship_input" 
						value="<?php echo $form->textField('first_name', $user['first_name']); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="last_name">Last name: <span>*</span></label>
					</th>
					<td>
						<?php echo $validation->validate('last_name'); ?>
						<input type="text" name="last_name" 
						id="last_name" class="ship_input" 
						value="<?php echo $form->textField('last_name', $user['last_name']); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="address_1">Address 1: <span>*</span></label>
					</th>
					<td>
						<?php echo $validation->validate('address_1'); ?>
						<input type="text" name="address_1" 
						id="address_1" class="ship_input" 
						value="<?php echo $form->textField('address_1', $user['address_1']); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="address_2">Address 2: </label>
					</th>
					<td>
						
						<input type="text" name="address_2" 
						id="address_2" class="ship_input" 
						value="<?php echo $form->textField('address_2', $user['address_2']); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="city">City: <span>*</span></label>
					</th>
					<td>
						<?php echo $validation->validate('city'); ?>
						<input type="text" name="city" 
						id="city" class="ship_input" 
						value="<?php echo $form->textField('city', $user['city']); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="county">County: </label>
					</th>
					<td>
						
						<input type="text" name="county" 
						id="county" class="ship_input" 
						value="<?php echo $form->textField('county', $user['county']); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="post_code">Postcode: <span>*</span></label>
					</th>
					<td>
						<?php echo $validation->validate('post_code'); ?>
						<input type="text" name="post_code" 
						id="post_code" class="ship_input" 
						value="<?php echo $form->textField('post_code', $user['post_code']); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="country">Country: <span>*</span></label>
					</th>
					<td>
						<?php echo $validation->validate('country'); ?>
						<input type="text" name="country" 
						id="country" class="ship_input" 
						value="<?php echo $form->textField('country', $user['country']); ?>" />
					</td>
				</tr>
				<tr>
					<th>
						<label for="email">Email: <span>*</span></label>
					</th>
					<td>
						<?php echo $validation->validate('email'); ?>
						<?php echo $validation->validate('same_email'); ?>
						<input type="text" name="email" 
						id="email" class="ship_input" 
						value="<?php echo $form->textField('email', $user['email']); ?>" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<label for="update_customer">
						<input type="submit" id="update_customer" class="update_customer" value="Update" />
						</label>
					</td>
				</tr>
			</table>
		</form>
	</div>

<?php
	require_once('template/footer.php'); 
	
	}
} 
	
?>