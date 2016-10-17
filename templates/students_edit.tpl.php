<?php  if (isDirektor()){?>
<h3>Редактирай данните на ученик</h3>
 <form role="form" action="" method="POST">

  <div class="form-group">
    <label for="exampleInputEmail1">Име на ученика</label>
    <input name="name_stud" 
           value="<?=isset($_POST['name_stud']) ? $_POST['name_stud'] : $student['uchenik'] ?>" 
           type="text" 
           class="form-control" 
           id="exampleInputEmail1" 
           placeholder="Име Презиме Фамилия" />
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Потребителско име на ученика</label>
    <input name="user_name"  
           value="<?=isset($_POST['user_name']) ? $_POST['user_name'] : $student['username'] ?>" 
           type="text" 
           class="form-control" 
           id="exampleInputEmail1" 
           placeholder="Номер на ученика" />
  </div>  

  <div class="form-group">
    <label for="exampleInputPassword1">Парола на ученика</label>
    <input name="password" 
           type="password" 
           class="form-control" 
           id="exampleInputPassword1" 
           placeholder="ЕГН на ученика" />
  </div>

  <button name="subm_stud_edit" type="submit" class="btn btn-default">Редакция</button>
</form>
<br />
<?php }elseif(isStudent()){?>

<h3>Профил</h3>
<br />
 <form role="form" action="" method="POST">

  <div class="form-group">
    <label for="exampleInputEmail1">Име</label>
    <h4><?=$student['uchenik'];?></h4>
    
  </div>
  <br />
  <div class="form-group">
    <label for="exampleInputEmail1">Потребителско име </label>
    <h4><?=$student['username'];?></h4>
  </div>  
  <br />

</form>
<?php  }?>
<br />