<?php
$res = mysql_query('SELECT *
FROM Uchenici ');

$students = array();

while($row = mysql_fetch_assoc($res)){	
	$students[] = $row;
}

render('students_list', array('students'=>$students));