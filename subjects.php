<?php
$list_subjects = 'list_subjects';
if (isset($_GET['action'])) {
	$list_subjects = $_GET['action'];
}
switch($list_subjects){ 
 default: 
  $file = 'subjects_list.php';
  break;

  case 'add':
  $file = 'subjects_add.php';
  break;

  case 'delete':
  $file = 'subjects_delete.php';
  break;

  case 'edit':
  $file = 'subjects_edit.php';
  break;
}


require_once($file);