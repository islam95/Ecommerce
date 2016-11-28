<div id="content">
	<div class="sidebar">
		<!-- This adds a sidebar -->
		<div id="menubar">
			<div class="menu">
				<?php if(Login::loggedIn(Login::$admin_login)) { ?>
				<h1>Menu</h1>
				<hr>
				<ul>
					<li><a href="?page=products" 
						<?php echo Check::getActive(array('page' => 'products'));
							?>>Products</a>
					</li>
					<li><a href="?page=categories" 
						<?php echo Check::getActive(array('page' => 'categories'));
							?>>Categories</a>
					</li>
					<li><a href="?page=orders" 
						<?php echo Check::getActive(array('page' => 'orders'));
							?>>Orders</a>
					</li>
					<li><a href="?page=customers" 
						<?php echo Check::getActive(array('page' => 'customers'));
							?>>Customers</a>
					</li>
					<li><a href="?page=business" 
						<?php echo Check::getActive(array('page' => 'business'));
							?>>Business</a>
					</li>
				</ul>
				<?php } else {?>
							&nbsp;
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="mainContent">