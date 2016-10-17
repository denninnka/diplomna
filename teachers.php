<?php

$a = 'list';
if(isset($_GET['action']))
  $a = $_GET['action'];

switch($a){ 
 default: 
  $file = 'teachers_list.php';
  break;

  case 'add':
  $file = 'teachers_add.php';
  break;

  case 'delete':
  $file = 'teachers_delete.php';
  break;

  case 'edit':
  $file = 'teachers_edit.php';
  break;
}

require_once($file);