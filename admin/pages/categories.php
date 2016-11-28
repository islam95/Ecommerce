<?php
Login::noAccessAdmin();

$action = URL::getParameter('action');

switch($action){
	
	case 'add':
	require_once('categories/add.php');
	break;
	
	case 'add-success':
	require_once('categories/add-success.php');
	break;
	
	case 'add-failed':
	require_once('categories/add-failed.php');
	break;
	
	case 'edit':
	require_once('categories/edit.php');
	break;
	
	case 'edit-success':
	require_once('categories/edit-success.php');
	break;
	
	case 'edit-failed':
	require_once('categories/edit-failed.php');
	break;
	
	case 'remove':
	require_once('categories/remove.php');
	break;
	
	default:
	require_once('categories/list.php');
	
}



