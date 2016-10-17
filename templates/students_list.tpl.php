<?php if(isDirektor()){ ?>
	<a href="index.php?page=students&amp;action=add" class="btn btn-default">
	<i class="fa fa-plus"></i> Добави ученик </a></br>

	</br>
	<ul class="list-group">
<?php
foreach ($students as $student) : ?>
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-5"><?=$student['uchenik'];?></div>

				<div class="col-md-5"><?=$student['username'];?></div>

				<div class="col-md-1 ">
					<a href="index.php?page=students&amp;action=edit&amp;ID_uchenik=<?=$student['ID_uchenik']; ?>" 
					   class="btn btn-warning btn-xs "> Редактирай
					</a>
				</div>
				
				<div class="col-md-1 ">
					<a href="index.php?page=students&amp;action=delete&amp;ID_uchenik=<?=$student['ID_uchenik']; ?>" 
					   class="btn btn-xs btn-danger "> Изтрий
					</a>			
				</div>
			</div>
		</li>
<?php	endforeach;?>
	</ul>
<?php }elseif(isTeacher() || isStudent() || !isLogged()){?>

	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<ul class="list-group">
				<li class="list-group-item disabled">
					<div class="row">
						<div class="col-sm-6">Ученик</div>

						<div class="col-sm-6">Номер на ученика</div>
					</div>
				</li>
			<ul class="list-group">
<?php
foreach ($students as $student) : ?>
		<li class="list-group-item">
			<div class="row">
				<div class="col-sm-6"><?=$student['uchenik'];?></div>

				<div class="col-sm-6"><?=$student['username'];?></div>
			</div>
		</li>
<?php	endforeach;?>
	</ul>

<?php } ?>