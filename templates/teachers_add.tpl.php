 <h3>Добави нов преподавател</h3>
 <form role="form" action="" method="POST">

  <div class="form-group">
    <label for="exampleInputEmail1">Потребителско име</label>
    <input 
    name="username"  
    value="<?=isset($_POST['username']) ? $_POST['username'] : ''?>" 
    type="text" 
    class="form-control" 
    id="exampleInputEmail1" 
    placeholder="Потребителско име на преподавател">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Име</label>
    <input 
    name="ime" 
    value="<?=isset($_POST['ime']) ? $_POST['ime'] : ''?>" 
    type="text" 
    class="form-control" 
    id="exampleInputEmail1" 
    placeholder="Име на преподавател">
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Парола</label>
    <input 
    name="password" 
    type="password" 
    class="form-control" 
    id="exampleInputPassword1" 
    placeholder="Парола на преподавател">
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Предмет</label> <br />       
    <?php foreach ($predmeti as $pr) : ?> 
          <input 
          type="checkbox" 
          name="ID_predmet[<?=$pr['ID_predmet'];?>]" 
          value="<?=$pr['ID_predmet'];?>" 
          <?php if(isset($_POST['ID_predmet'][(int)$pr['ID_predmet']]) ) echo 'checked'; ?> />
           <?=$pr['ime'];?> <br />
    <?php endforeach; ?>    
  </div>

  <button name="submitadd" type="submit" class="btn btn-default">Добави</button>
</form>