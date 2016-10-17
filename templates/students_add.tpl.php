<h3>Добави нов ученик</h3>
 <form role="form" action="" method="POST">

  <div class="form-group">
    <label for="exampleInputEmail1">Име на ученика</label>
    <input name="uchenik"  
    	     value="<?=isset($_POST['uchenik']) ? $_POST['uchenik'] : ''?>" 
    	     type="text" 
    	     class="form-control" 
    	     id="exampleInputEmail1" 
    	     placeholder="Име Презиме Фамилия" />
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Потребителско име на ученика</label>
    <input name="username"  
    	     value="<?=isset($_POST['username']) ? $_POST['username'] : ''?>" 
    	     type="text" 
    	     class="form-control" 
    	     id="exampleInputEmail1" 
    	     placeholder="Номер на ученикът" />
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Парола на ученика</label>
    <input name="password" 
    	     type="password" 
    	     class="form-control" 
    	     id="exampleInputPassword1" 
    	     placeholder="ЕГН на ученика" />
  </div>

  <button name="subm_add_stud" type="submit" class="btn btn-default">Добави</button>
</form>