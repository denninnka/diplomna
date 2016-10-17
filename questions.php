<?php
$list_questions = 'list_questions';
if (isset($_GET['action'])) {
	$list_questions = $_GET['action'];
}

switch ($list_questions) {
	
	default:
		$file = 'questions_list.php';
		break;

		case 'add':
		$file = 'questions_add.php';
		break;

		case 'delete':
		$file = 'questions_delete.php';
		break;

		case 'edit':
		$file = 'questions_edit.php';
		break;
}

require_once($file);