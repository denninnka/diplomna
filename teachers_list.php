<?php
$res = mysql_query('SELECT * FROM Prepodavateli ');

$teachers = array();

while($row = mysql_fetch_assoc($res)){
	$res2 = mysql_query('SELECT *
	FROM Predmeti s
	LEFT JOIN  Predpodavateli_predmeti st ON ( s.ID_predmet = st.ID_predmet )
	WHERE st.ID_prepodavatel = '.$row['ID_prepodavatel']);
	$Predmeti = array();
	while ($row2 = mysql_fetch_assoc($res2)) {
		$Predmeti[] = $row2['ime'];
	}
	
	$row['predmeti'] = $Predmeti;
	$teachers[] = $row;

}

render('teachers_list', array('teachers'=>$teachers));
