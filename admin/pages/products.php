<?php
Login::noAccessAdmin();

$action = URL::getParameter('action');

switch($action){
	
	case 'add':
	require_once('products/add.php');
	break;
	
	case 'add-success':
	require_once('products/add-success.php');
	break;
	
	case 'add-failed':
	require_once('products/add-failed.php');
	break;
	
	case 'add-no-image':
	require_once('products/add-no-image.php');
	break;
	
	case 'edit':
	require_once('products/edit.php');
	break;
	
	case 'edit-success':
	require_once('products/edit-success.php');
	break;
	
	case 'edit-failed':
	require_once('products/edit-failed.php');
	break;
	
	case 'edit-no-image':
	require_once('products/edit-no-image.php');
	break;
	
	case 'remove':
	require_once('products/remove.php');
	break;
	
	default:
	require_once('products/list.php');
	
}



