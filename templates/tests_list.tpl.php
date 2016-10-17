<?php if(isDirektor() || !isLogged()) { ?>


<div class="row">
	<div class="col-md-10 col-sm-offset-1">
		<ul class="list-group">
			<li class="list-group-item disabled">
				<div class="row">
					<div class="col-md-3">Име на тест</div>

					<div class="col-md-2">Брой въпроси</div>

					<div class="col-md-1">Ниво</div>

					<div class="col-md-3">Предмет</div>

					<div class="col-md-3">Преподавател</div>
				</div>

			</li>
<?php

if(count($test)){ 
	foreach ($test as $t) : ?>
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-3"><?=$t['ime'];?></div>

					<div class="col-md-2"><?=$t['count_question'];?></div>

					<div class="col-md-1">
					<?php
					if($t['level']==1){
						echo "Лесен";
					}
					elseif ($t['level']==2) {
						echo "Среден";
					}
					elseif ($t['level']==3) {
						echo "Труден";
					}
					?>
					</div>

					<div class="col-md-3"><?= $t['predmet_ime'];?></div>

					<div class="col-md-3"><?= $t['prepodavatel_ime'];?></div>
				</div>
			</li>
<?php	endforeach;
} else {
?>
			<li class="list-group-item"><p class="text-warning">Няма тестове</p> </li>
	<?php
}
?>
		</ul>
	</div>
</div>

<?php }elseif(isTeacher()) { ?>
	<a href="index.php?page=tests&amp;action=add" class="btn btn-default">
	<i class="fa fa-plus"></i> Добави тест </a></br>	
</br>
<ul class="list-group">
	<li class="list-group-item disabled">
		<div class="row">
			<div class="col-md-2">Име на тест</div>

			<div class="col-md-2">Брой въпроси</div>

			<div class="col-md-1">Ниво</div>

			<div class="col-md-3">Предмет</div>

			<div class="col-md-2">Преподавател</div>
		</div>

	</li>
<?php

if(count($test)){ 
	foreach ($test as $t) : ?>
	<li class="list-group-item">
		<div class="row">
			<div class="col-md-2"><?=$t['ime'];?></div>

			<div class="col-md-2"><?=$t['count_question'];?></div>

			<div class="col-md-1">
			<?php
			if($t['level']==1){
				echo "Лесен";
			}
			elseif ($t['level']==2) {
				echo "Среден";
			}
			elseif ($t['level']==3) {
				echo "Труден";
			}
			?>
			</div>

			<div class="col-md-3"><?= $t['predmet_ime'];?></div>

			<div class="col-md-3"><?= $t['prepodavatel_ime'];?></div>

			<div class="col-md-1 ">
				<a href="index.php?page=tests&amp;action=delete&amp;ID_test=<?=$t['ID_test']; ?>" 
				   class="btn btn-xs btn-danger "> Изтрий
				</a>			
			</div>
		</div>
	</li>
<?php	endforeach;
} else {
?>
	<li class="list-group-item"><p class="text-warning">Няма тестове</p> </li>
	<?php
}
?>
</ul>

<?php }elseif(isStudent()){ ?>

<ul class="list-group">
	<li class="list-group-item disabled">
		<div class="row">
			<div class="col-md-2">Име на тест</div>

			<div class="col-md-2">Брой въпроси</div>

			<div class="col-md-1">Ниво</div>

			<div class="col-md-3">Предмет</div>

			<div class="col-md-2">Преподавател</div>
		</div>

	</li>
<?php

if(count($test)){ 
	foreach ($test as $t) : ?>
	<li class="list-group-item">
		<div class="row">
			<div class="col-md-2"><?=$t['ime'];?></div>

			<div class="col-md-2"><?=$t['count_question'];?></div>

			<div class="col-md-1">
			<?php
			if($t['level']==1){
				echo "Лесен";
			}
			elseif ($t['level']==2) {
				echo "Среден";
			}
			elseif ($t['level']==3) {
				echo "Труден";
			}
			?>
			</div>

			<div class="col-md-3"><?= $t['predmet_ime'];?></div>

			<div class="col-md-2"><?= $t['prepodavatel_ime'];?></div>

			<div class="col-md-2 ">
			<?php if(!hasFilledTest($t['ID_test'])) : ?>
				<a href="index.php?page=fill_test&amp;action=fill_test&amp;ID_test=<?=$t['ID_test']; ?>" 
				   class="btn btn-xs btn-info pull-right"> Направи тест
				</a>	
				<?php	else : ?>
					<p class="label label-success pull-right"> Попълнен </p>
				<?php endif; ?> 	
			</div>
		</div>
	</li>
<?php	endforeach;
} else {
?>
	<li class="list-group-item"><p class="text-warning">Няма тестове</p> </li>
	<?php
}
?>
</ul>

<?php } ?>
