<h3>Добави нов предмет</h3>
 <form role="form" action="" method="POST">

  <div class="form-group">
    <label for="exampleInputEmail1">Учебен предмет</label>
    <input name="ime"  
    	   value="<?=isset($_POST['ime']) ? $_POST['ime'] : ''?>" 
    	   type="text" 
    	   class="form-control" 
    	   id="exampleInputEmail1" 
    	   placeholder="Име на учебният предмет">
  </div>

  <button name="subm_add_subj" type="submit" class="btn btn-default">Добави</button>
</form>