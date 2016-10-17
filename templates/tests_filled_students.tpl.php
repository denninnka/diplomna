<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <?php
foreach ($tests as $test) : ?>

<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?=$test['ID_polojen'];?>">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$test['ID_polojen'];?>" aria-expanded="true" aria-controls="collapse<?=$test['ID_polojen'];?>">
         <?=$test['data'];?> &nbsp&nbsp<?=$test['ime_test'];?> &nbsp&nbsp<?=$test['ime_predmet'];?>
        </a>
      </h4>
    </div>

    <div id="collapse<?=$test['ID_polojen'];?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?=$test['ID_polojen'];?>">
      <div class="panel-body">

        <form class="form-horizontal" action="" method="POST">
          <div class="form-group">
            <label class="col-sm-2 control-label">Дата : </label>
              <div class="col-sm-10">
                <h4><?=$test['data'];?></h4>
    		      </div>
          </div>
          <div class="form-group">
  		      <label class="col-sm-2 control-label">Преподавател : </label>
    		      <div class="col-sm-10">
                <h4><?=$test['ime_prepodavatel'];?></h4>
    		      </div>
          </div>

          <div class="form-group">
  		      <label class="col-sm-2 control-label">Предмет : </label>
    		      <div class="col-sm-10">
                <h4><?=$test['ime_predmet'];?></h4>
    		      </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Име на теста :</label>
              <div class="col-sm-10">
                <h4><?=$test['ime_test'];?></h4>
              </div>
          </div>

          <div class="form-group">
  		      <label class="col-sm-2 control-label">Успех в % :</label>
    		      <div class="col-sm-10">
                <h4><?=$test['uspeh'];?>%</h4>
    		      </div>
          </div>

          <div class="form-group">
  		      <label class="col-sm-2 control-label">Оценка :</label>
    		      <div class="col-sm-10">
      		      <h4>
                <?php
                if($test['ocenka']==2){
                  echo "Слаб";
                }
                elseif ($test['ocenka']==3) {
                  echo "Среден";
                }
                elseif ($test['ocenka']==4) {
                  echo "Добър";
                }
                elseif ($test['ocenka']==5) {
                  echo "Много добър";
                }
                elseif ($test['ocenka']==6) {
                  echo "Отличен";
                }
                ?>
                <?=$test['ocenka'];?>
                </h4>
    		      </div>
          </div>

          <div class="form-group">
          <label class="col-sm-2 control-label">Сгрешени въпроси</label>
            <div class="col-sm-10">
              <ul class="list-group">
                <?php foreach ($test['greshni'] as $q) { ?>
                <li class="list-group-item ">
                  <div class="row">
                    <div class="col-sm-12 text-center">
                      <?=$q['vupros']?> 
                    </div>
                  </div>
                </li>

                <li class="list-group-item ">
                  <div class="row">
                    <div class="col-sm-6 text-danger text-center">
                      Грешен отговор: <?=$q['otgovor'.$q['otgovor']]; ?> 
                    </div>
                    <div class="col-sm-6 text-success text-center">
                      Верен отговор: <?=$q['otgovor'.$q['pravilen']]; ?> 
                    </div>
                  </div>
                </li>
                 <?php }?>
              </ul>
            </div>
          </div>

          <div class="form-group">
          <label class="col-sm-2 control-label">Рецензия : </label>
            <div class="col-sm-10">
              <textarea <?php 
              if(isset($_POST['recenzia']) ? $_POST['recenzia'] : $test['recenzia']){ ?>disabled <?php } ?> class="form-control" rows="3" name="recenzia"><?php 
              if(isset($_POST['recenzia']) ? $_POST['recenzia'] : $test['recenzia']) echo $test['recenzia'] ; 
              ?></textarea>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach;?>
</div>