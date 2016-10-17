<?php
/**
* @var $tpl_name Name of the template
* @var $tpl_values Values assigned to temlate
*/
function render($tpl_name,$tpl_values = array()){
	foreach ($tpl_values as $key => $value) {
		$$key = $value;
	}

	if(file_exists('templates/'.$tpl_name.'.tpl.php')){
		include_once('templates/'.$tpl_name.'.tpl.php');
	}
}
function isDirektor() {
	return isset($_SESSION['direktor']) AND $_SESSION['direktor'];
}
function isTeacher(){
	return isset($_SESSION['ID_prepodavatel']) AND $_SESSION['ID_prepodavatel']>0;
}
function isStudent(){
	return isset($_SESSION['ID_uchenik']) AND $_SESSION['ID_uchenik']>0;
}

function isLogged(){
	return isset($_SESSION['is_logged']) AND $_SESSION['is_logged'];
}


function hasFilledTest($id_test){
	if(isDirektor() || isTeacher() || !isLogged()) return false; 


	$sql = 'SELECT ID_test
	FROM Polojeni 
	WHERE ID_test ='. (int)$id_test.' AND ID_uchenik = '.$_SESSION['ID_uchenik'];
	$res = mysql_query($sql);
	if($res === false ){
		echo mysql_error(); 
		return false;
	}

	if (mysql_num_rows($res) ==0 )
		return false;

	return true;

}

function ocenka($procent){
	if($procent <= 20 ){ 
		return 2;
	}
	elseif($procent <=40){
		return 3;
	} elseif ($procent <= 60) {
		return 4;
	} elseif ($procent <=80) {
		return 5;
	} else {
		return 6;
	}
}