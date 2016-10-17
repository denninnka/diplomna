<?php
$list_fill_test = 'list_fill_test';
if (isset($_GET['action'])) {
	$list_fill_test = $_GET['action'];
}
switch($list_tests){ 
 default: 
  $file = 'fill_test_page.php';
  break;
}

 require_once($file);