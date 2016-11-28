<?php
Login::noAccessAdmin();

$action = URL::getParameter('action');

switch($action){
		
	case 'view':
	require_once('orders/view.php');
	break;
	
	case 'edit-success':
	require_once('orders/edit-success.php');
	break;
	
	case 'edit-failed':
	require_once('orders/edit-failed.php');
	break;
	
	case 'remove':
	require_once('orders/remove.php');
	break;
	
	case 'invoice':
	require_once('orders/invoice.php');
	break;
	
	default:
	require_once('orders/list.php');
	
}



