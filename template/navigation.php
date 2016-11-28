<nav>
	<!-- This contains main navigation bar of the website -->
	<ul>
		<li><a href="?page=index" <?php echo Check::getActive(array('page' => 'index')); ?>>HOME</a>
		</li>
		<li><a href="?page=about" <?php echo Check::getActive(array('page' => 'about')); ?>>ABOUT</a>
		</li>
		<li><a href="?page=delivery" <?php echo Check::getActive(array('page' => 'delivery')); ?>>DELIVERY</a>
		</li>
		<li><a href="?page=contact" <?php echo Check::getActive(array('page' => 'contact')); ?>>CONTACT</a>
		</li>
	</ul>
</nav>