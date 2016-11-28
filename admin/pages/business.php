<?php
Login::noAccessAdmin();

$action = URL::getParameter('action');

switch($action){
		
	case 'update-success':
	require_once('business/update-success.php');
	break;
	
	case 'update-failed':
	require_once('business/update-failed.php');
	break;
	
	default:
	require_once('business/update.php');
	
}