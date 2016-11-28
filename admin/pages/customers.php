<?php
Login::noAccessAdmin();

$action = URL::getParameter('action');

switch($action){
		
	case 'update':
	require_once('customers/update.php');
	break;
	
	case 'update-success':
	require_once('customers/update-success.php');
	break;
	
	case 'update-failed':
	require_once('customers/update-failed.php');
	break;
	
	case 'remove':
	require_once('customers/remove.php');
	break;
	
	default:
	require_once('customers/list.php');
	
}

