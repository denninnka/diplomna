<?php
$errors = array();
$subject = false;

if(!isDirektor())
    $errors[] = 'Нямате право да изтриете предмет';
  elseif (!isset($_GET['ID_predmet'])) 
    $errors[] = 'Не сте избрали предмет!';
  elseif ((int)$_GET['ID_predmet']==0)  
    $errors[] = 'Невалиден предмет';
  
if(!count($errors)) {

  $res = mysql_query('SELECT * FROM Predmeti WHERE ID_predmet = \''.(int)$_GET['ID_predmet'].'\'');
  if($res==false){
    $errors[] = mysql_error();
  }elseif (mysql_num_rows($res)==0) {
    $errors[]= 'Не съществува такъв предмет';
  } else {
    $subject = mysql_fetch_assoc($res);
  } 
}

if(!count($errors) AND isset($_POST['subm_subj_edit'])) { 
  if($_POST['ime_subj']=='')
    $errors[] = 'Името на предмета е задължително';

  if(count($errors)==0){    
        $sql = 'UPDATE Predmeti SET 
        ime = \''.$_POST['ime_subj'].'\'
        WHERE ID_predmet= '.(int)$_GET['ID_predmet'];
      
      if(mysql_query($sql)===false){
        $errors[] = mysql_error();
      } else {

        $_SESSION['success'] = 'Успешна редакция на предмета';
        header('Location: index.php?page=subjects');
      }
  }
}
if(count($errors)>0){
  echo '<div class="alert alert-danger">';
  foreach ($errors as $value) {
    echo '<p>'.$value.'</p>';
  }
  echo '</div>';
}
render('subjects_edit',array('subject'=> $subject));