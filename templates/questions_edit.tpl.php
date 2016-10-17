<h3>Редактирай въпрос</h3>
 <form role="form" action="" method="POST" class="form-horizontal">

  <div class="form-group">
    <label for="exampleInputEmail1">Въпрос</label>
    <input name="question"  
      	   value="<?=isset($_POST['question']) ? $_POST['question'] : $question['vupros']?>" 
    	     type="text" 
    	     class="form-control" 
    	     id="exampleInputEmail1" 
    	     placeholder="Задай въпрос" />
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1" class="control-label ">Отговор А</label>
    
      <div class="input-group">
        <input name="answer1"  
          value="<?=isset($_POST['answer1']) ? $_POST['answer1'] : $question['otgovor1']?>" 
          type="text" 
          class="form-control" 
          id="exampleInputEmail1" 
          placeholder="Въведи отговор" />
        <span class="input-group-addon">
          <label class="">
            <input type="radio" name="veren" value="1" id="option1" autocomplete="off" 
            <?php if($question['pravilen'] == 1 ) echo "checked"; ?> /> Верен отговор  
          </label>
        </span>
      </div>

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1" class="control-label ">Отговор B</label>
    
      <div class="input-group">
        <input name="answer2"  
          value="<?=isset($_POST['answer2']) ? $_POST['answer2'] : $question['otgovor2']?>" 
          type="text" 
          class="form-control" 
          id="exampleInputEmail1" 
          placeholder="Въведи отговор" />
        <span class="input-group-addon">
          <label class="">
            <input type="radio" name="veren"  value="2" id="option2" autocomplete="off" 
            <?php if($question['pravilen'] == 2 ) echo "checked"; ?> /> Верен отговор  
          </label>
        </span>
      </div>

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1" class="control-label ">Отговор С</label>
    
      <div class="input-group">
        <input name="answer3"  
          value="<?=isset($_POST['answer3']) ? $_POST['answer3'] : $question['otgovor3']?>" 
          type="text" 
          class="form-control" 
          id="exampleInputEmail1" 
          placeholder="Въведи отговор" />
        <span class="input-group-addon">
          <label class="">
            <input type="radio" name="veren"  value="3"  id="option3" autocomplete="off" 
            <?php if($question['pravilen'] == 3 ) echo "checked"; ?> /> Верен отговор  
          </label>
        </span>
      </div>

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1" class="control-label ">Отговор D</label>
    
      <div class="input-group">
        <input name="answer4"  
          value="<?=isset($_POST['answer4']) ? $_POST['answer4'] : $question['otgovor4']?>" 
          type="text" 
          class="form-control" 
          id="exampleInputEmail1" 
          placeholder="Въведи отговор" />
        <span class="input-group-addon">
          <label class="">
            <input type="radio" name="veren"  value="4" id="option4" autocomplete="off" 
            <?php if($question['pravilen'] == 4 ) echo "checked"; ?>  /> Верен отговор  
          </label>
        </span>
      </div>

  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Предмет</label> <br />       
    <?php foreach ($predmeti as $pr) : ?> 
          <input type="radio" 
                 name="ID_predmet" 
                 value="<?=$pr['ID_predmet'];?>" 
          <?php if(isset($_POST['ID_predmet']) AND ($_POST['ID_predmet'] == $pr['ID_predmet']) )  echo 'checked';
          elseif($question['ID_predmet'] == $pr['ID_predmet']) echo 'checked';  ?> />
          <?=$pr['ime'];?> <br />
    <?php endforeach; ?>    
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Ниво</label> <br />       
          <input type="radio" name="level" value="1" 
          <?php if(isset($_POST['level']) AND ($_POST['level'] == 1) )  echo 'checked';
          elseif($question['level'] == 1) echo 'checked';  ?> /> Лесен<br />
          <input type="radio" name="level" value="2" 
          <?php if(isset($_POST['level']) AND ($_POST['level'] == 2) )  echo 'checked';
          elseif($question['level'] == 2) echo 'checked';  ?> />Среден<br />
          <input type="radio" name="level" value="3" 
          <?php if(isset($_POST['level']) AND ($_POST['level'] == 3) )  echo 'checked';
          elseif($question['level'] == 3) echo 'checked';  ?> />Труден<br />
  </div>

  <br />

  <div>
    <button name="subm_edit_quest" type="submit" class="btn btn-default">Редактирай</button>
  </div>

  <br />
 </form>