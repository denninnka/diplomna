<h3>Попълни и изпари теста</h3><br />

<h4><?=$ime_na_test; ?></h4><br />	
<form role="form" action="" method="POST">
<?php $i=0;?>
<?php
foreach ($questions as $q) : ?>
  <div class="form-group">
    <label for="exampleInputEmail1"><?php $i+=1;  echo $i; ?>
    . <?=$q['vupros']?>
    </label>
    	<div class="radio">
  			<ladel>A)</ladel>
  			<label>
    		<input type="radio" name="optionsRadios[<?=$q['ID_vuprosi'];?>]" id="optionsRadios1" value="1" >
   				<?=$q['otgovor1']?>
 		 	</label>
		</div>

		<div class="radio">
			<ladel>B)</ladel>
  			<label>
    		<input type="radio" name="optionsRadios[<?=$q['ID_vuprosi'];?>]" id="optionsRadios2" value="2">
    			<?=$q['otgovor2']?>
  			</label>
		</div>

		<div class="radio">
			<ladel>C)</ladel>
  			<label>
    		<input type="radio" name="optionsRadios[<?=$q['ID_vuprosi'];?>]" id="optionsRadios3" value="3" >
   				<?=$q['otgovor3']?>
 		 	</label>
		</div>

		<div class="radio">
  			<ladel>D)</ladel>
  			<label>
    		<input type="radio" name="optionsRadios[<?=$q['ID_vuprosi'];?>]" id="optionsRadios4" value="4" >
    			<?=$q['otgovor4']?>
  			</label>
		</div>
		

  </div><br />
 <?php endforeach;?>
  <button name="sbmt_fill_test" type="submit" class="btn btn-default">Изпрати</button>
</form>
