<?php
$objProducts = new Products();
$cats = $objProducts->getCategories();
	
$objCompany = new Company();
$company = $objCompany->getCompany();

$q = URL::getParameter('q'); // search parameter
if(!empty($q)){
	stripcslashes($q);
	//Check::redirect("?page=search");
}

?>
<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<title><?php echo $company['name']; ?></title>
	<meta name="Author" content="Islam Dudaev" />
	<meta name="description" content="Khizir online shop for clothing." />
	<meta name="keywords" content="online shop, online store, khizir store, khizir shop" />
	<link href="css/main.css" rel="stylesheet" type="text/css">
	<link href="css/buttons.css" rel="stylesheet" type="text/css">
</head>
	
<body>
	<div id="mainWrapper">
		<header>
			<!-- This contains Logo and links -->
			<div id="logo">
				<a href="?page=index">
					<img src="images/logo.gif" alt="<?php echo $company['name']; ?>" />
				</a>
			</div>

			<!-- Search field -->
			<div id="search">
				<form action="" method="get">
					<?php echo URL::getSearchParams(array('q', Paging::$paging)); ?>
					<!-- Javascript used for deleting the search text in search field when user types in. -->
					<input type="text" name="q" id="q" value="Search for more products" 
					onfocus="
					if(this.value == 'Search for more products'){
						this.value = '';
					}" 
					onblur="
					if(this.value == ''){
						this.value = 'Search for more products';
					}" />
				</form>
			</div>

			<div id="headerLinks">
				<?php
					// if user logged in
					if(Login::loggedIn(Login::$user_login)){
						echo '<div id="logged_as">Hi <strong>';
						echo Login::getUserName(Session::getSession(Login::$user_login));
						echo '</strong> | <a href="?page=orders" '.Check::getActive(array('page' => 'orders')).'>My orders</a>';
						echo ' | <a href="?page=logout">Logout</a></div>';
					} else{
						echo '<div id="logged_as"><a href="?page=login">Login/Register</a></div>';
					}
					?>
				<!--	
				<a href="?page=basket" title="CartImg">
					<img src="images/basket.png" alt="Basket" class="imgBasket" />
				</a>
				-->
			</div>
		</header>
