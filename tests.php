<?php
$list_tests = 'list_tests';
if (isset($_GET['action'])) {
	$list_tests = $_GET['action'];
}
switch($list_tests){ 
 default: 
  $file = 'tests_list.php';
  break;

  case 'add':
  $file = 'tests_add.php';
  break;

  case 'delete':
  $file = 'tests_delete.php';
  break;

  case 'edit':
  $file = 'tests_edit.php';
  break;

  case 'filled': 
  $file = 'tests_filled.php';
  break;
  
}

 require_once($file);