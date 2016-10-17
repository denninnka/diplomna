<h3>Редактирай предмета</h3>
 <form role="form" action="" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Име</label>
    <input name="ime_subj" 
    	   value="<?=isset($_POST['ime_subj']) ? $_POST['ime_subj'] : $subject['ime'] ?>" 
    	   type="text" 
    	   class="form-control" 
    	   id="exampleInputEmail1" 
    	   placeholder="Име на предмета">
  </div>

  <button name="subm_subj_edit" type="submit" class="btn btn-default">Редакция</button>
</form>