<?php if(isDirektor()) { ?>
	<a href="index.php?page=teachers&amp;action=add" class="btn btn-default">
	<i class="fa fa-plus"></i> Добави преподавател </a></br>	

	</br>
	<ul class="list-group">
		<li class="list-group-item disabled">
			<div class="row">
				<div class="col-md-3">Преподавател</div>

				<div class="col-md-3">Потребителско име</div>

				<div class="col-md-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Предмет</div>
			</div>
		</li>
	<?php
	foreach ($teachers as $teacher) : ?>
		<li class="list-group-item">
			<div class="row">

				<div class="col-md-3">
					<?=$teacher['ime'];?>
				</div>

				<div class="col-md-3">
					<?=$teacher['user_name'];?>
				</div>

				<div class="col-md-4">
					<ul>
					<?php foreach ($teacher['predmeti'] as $pr) : ?> 
						<li><?=$pr; ?></li>
					<?php endforeach; ?>

					</ul>
				</div>
				
				<div class="col-md-1 ">
					<a href="index.php?page=teachers&amp;action=edit&amp;ID_prepodavatel=<?=$teacher['ID_prepodavatel']; ?>" 
					   class="btn btn-warning btn-xs ">Редактирай</a>
				</div>
				
				<div class="col-md-1 ">
					<a href="index.php?page=teachers&amp;action=delete&amp;ID_prepodavatel=<?=$teacher['ID_prepodavatel']; ?>" 
					   class="btn btn-xs btn-danger ">Изтрий</a>			
				</div>
			</div>
		</li>
	<?php	endforeach;
	?>
	</ul>	

<?php }elseif(isTeacher() || isStudent() || !isLogged()){ ?>
<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
	<ul class="list-group">
		<li class="list-group-item disabled">
			<div class="row">
				<div class="col-sm-6">Преподавател</div>

				<div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Предмет</div>
			</div>
		</li>
	<?php
	foreach ($teachers as $teacher) : ?>
		<li class="list-group-item">
			<div class="row">

				<div class="col-sm-6">
					<?=$teacher['ime'];?>
				</div>

				<div class="col-sm-6">
					<ul>
					<?php foreach ($teacher['predmeti'] as $pr) : ?> 
						<li><?=$pr; ?></li>
					<?php endforeach; ?>

					</ul>
				</div>
			</div>
		</li>
	<?php	endforeach;
	?>
	</ul>
	 </div>
</div>

<?php } ?>

