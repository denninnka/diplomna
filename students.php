<?php
$list_students = 'list_students';
if (isset($_GET['action'])) {
	$list_students = $_GET['action'];
}
switch($list_students){ 
 default: 
  $file = 'students_list.php';
  break;

  case 'add':
  $file = 'students_add.php';
  break;

  case 'delete':
  $file = 'students_delete.php';
  break;

  case 'edit':
  $file = 'students_edit.php';
  break;
}


require_once($file);