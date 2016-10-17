<h3>Създай тест</h3>
<form role="form" action="" method="POST">

  <div class="form-group">
    <label for="exampleInputEmail1">Име на теста</label>
    <input 
    name="test_name"  
    value="<?=isset($_POST['username']) ? $_POST['username'] : ''?>" 
    type="text" 
    class="form-control" 
    id="exampleInputEmail1" 
    placeholder="Име на теста">
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Предмет</label> <br />       
    <?php foreach ($predmeti as $pr) : ?> 
          <input type="radio" name="ID_predmet" value="<?=$pr['ID_predmet'];?>" 
          <?php if(isset($_POST['ID_predmet']) AND $_POST['ID_predmet'] == $pr['ID_predmet'] ) echo 'checked'; ?> />
          <?=$pr['ime'];?> <br />
    <?php endforeach; ?>    
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Ниво</label> <br />       
          <input type="radio" name="level" value="1" 
          <?php if(isset($_POST['level']) AND $_POST['level'] == 1 ) echo 'checked'; ?> /> Лесен<br />
          <input type="radio" name="level" value="2" 
          <?php if(isset($_POST['level']) AND $_POST['level'] == 2 ) echo 'checked'; ?> />Среден<br />
          <input type="radio" name="level" value="3" 
          <?php if(isset($_POST['level']) AND $_POST['level'] == 3 ) echo 'checked'; ?> />Труден<br />
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Брой въпроси</label> <br />       
          <input type="radio" name="count_question" value="10" 
          <?php if(isset($_POST['count_question']) AND $_POST['count_question'] == 10 ) echo 'checked'; ?> /> 10<br />
          <input type="radio" name="count_question" value="15" 
          <?php if(isset($_POST['count_question']) AND $_POST['count_question'] == 15 ) echo 'checked'; ?> />15<br />
          <input type="radio" name="count_question" value="20" 
          <?php if(isset($_POST['count_question']) AND $_POST['count_question'] == 20 ) echo 'checked'; ?> />20<br />
  </div>

   

  <button name="subm_add_test" type="submit" class="btn btn-default">Добави</button>
</form>