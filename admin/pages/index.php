<?php 
if (Login::loggedIn(Login::$admin_login)){
	Check::redirect(Login::$dashboard_admin);
}

$form = new Form();
$validation = new Valid($form);

// Login form
if($form->isPost('login_email')){ // if email has been posted
	$admin = new Admin();
	if($admin->isUser(
			$form->getPost('login_email'), 
			$form->getPost('login_password')
		)
	){
		Login::adminLogin($admin->admin_id, URL::getRedirectURL());
	} else {
		$validation->addErrors('login');
	}
}

// Creating a password for the admin
//echo Login::encrypt('islam');

	require_once('template/header.php');
	require_once('template/navigation.php');
	require_once('template/sidebar.php');
	?>
	
<div class="log_reg">
<h2>Login</h2>	

<form action="" method="post">
	<table class="table_login">
		<tr>
			<th><label for="login_email">Login:</label></th>
			<td>
				<?php echo $validation->validate('login'); ?>
				<input type="text" name="login_email" 
					   id="login_email" class="ship_input" 
					   value="" />
			</td>
		</tr>
		<tr>
			<th><label for="login_password">Password:</label></th>
			<td>
				<input type="password" name="login_password" 
					   id="login_password" class="ship_input" 
					   value="" />
			</td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td>
				<label for="login_button" class="login_button">
					<input type="submit" id="login_button"
						   class="log_reg_btn" value="Login" />
				</label>
			</td>
		</tr>
	</table>
</form>
</div>
	
<?php require_once('template/footer.php'); ?>