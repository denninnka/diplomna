<?php
session_start();
require 'config.php';

$p = 'home';
if(isset($_GET['page']))
  $p = $_GET['page'];

switch($p){ 
  default :
    $page = 'home.php';
   break;

   case 'login_prepodavatel' :
    $page = 'login_prepodavatel.php';
   break;

   case 'login_students' :
    $page = 'login_students.php';
   break;

   case 'logout':
    session_destroy();
    $_SESSION = array();
    $page = 'logout.php';
   break;

   case 'teachers':
   $page='teachers.php';
   break;

   case 'subjects':
   $page='subjects.php';
   break;

   case 'students':
   $page='students.php';
   break;

   case 'tests' :
   $page='tests.php';
   break;

   case 'questions':
   $page='questions.php';
   break;

   case 'fill_test':
   $page='fill_test.php';
   break;
}

require_once 'header.php';
require_once $page;
require_once 'footer.php';

?>