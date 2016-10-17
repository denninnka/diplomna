<?php
$errors =array();
if(isStudent()){  
	$sql = 'SELECT po.* , t.ime as ime_test, te.ime as ime_prepodavatel, pr.ime as ime_predmet
	FROM Polojeni po
	LEFT JOIN Test t ON (t.ID_test = po.ID_test) 
	LEFT JOIN Prepodavateli te ON ( te.ID_prepodavatel = t.ID_prepodavatel )
	lEFT JOIN Predmeti pr ON( t.ID_predmet = pr.ID_predmet)
	WHERE po.ID_uchenik = '.$_SESSION['ID_uchenik'] .' AND po.proveren= 1'; 
}  else {
$sql = 'SELECT po.* , t.ime as ime_test, te.ime as ime_prepodavatel, st.uchenik as ime_uchenik
	
	FROM Polojeni po
	LEFT JOIN Test t ON (t.ID_test = po.ID_test) 
	LEFT JOIN Prepodavateli te ON ( te.ID_prepodavatel = t.ID_prepodavatel )
	LEFT JOIN Uchenici st ON (po.ID_uchenik = st.ID_uchenik)
	WHERE t.ID_prepodavatel = '.$_SESSION['ID_prepodavatel']; 
}
$res=  mysql_query($sql) OR die(mysql_error());
$tests = array();
while($row = mysql_fetch_assoc($res)){
	$sql1 = 'SELECT v.*, po.otgovor
			FROM Vuprosi v
			LEFT JOIN Polojeni_vuprosi po ON (po.ID_vuprosi = v.ID_vuprosi )
			WHERE po.ID_polojen = '.$row['ID_polojen'];
			$res1 = mysql_query($sql1);
		$verni = array();
		$greshni = array();	

	while ($row1 = mysql_fetch_assoc($res1)) {
		if($row1['pravilen'] == $row1['otgovor']){
			$verni[] = $row1;
		} else {
			$greshni[] = $row1;
		}
	}

	$row['greshni'] = $greshni;
	$row['uspeh'] = ((count($verni) /  mysql_num_rows($res1))*100 );
	$row['ocenka'] = ocenka($row['uspeh']);

	$tests[] =$row;
}

if(isset($_POST['submit_recenz'])){
	if ($_POST['recenzia']=='') 
	$errors[]='Трябва да напишете рецензия!';

	if(count($errors)==0){
		$sql='UPDATE Polojeni SET 
		recenzia = \''.$_POST['recenzia'].'\' ,
		proveren = 1
		WHERE ID_polojen= '.$_POST['ID_polojen'];
	}
	if (mysql_query($sql)===false) {
		$errors=mysql_error();
	}
	elseif (!count($errors)) {
		$_SESSION['success'] = 'Успешнo изпратена рецензия';
			header('Location: index.php?page=tests&action=filled');
	}
}

	if(isStudent()){  
		render('tests_filled_students',array('tests'=>$tests));
	}  else {
		render('tests_filled_teachers',array('tests'=>$tests));
	}