<?php if(isDirektor()) { ?>
	<a href="index.php?page=subjects&amp;action=add" class="btn btn-default">
	<i class="fa fa-plus"></i> Добави предмет </a></br>	

	</br>
	<ul class="list-group">

<?php
foreach ($subjects as $subject) : ?>
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-10"><?=$subject['ime'];?></div>

				<div class="col-md-1 ">
					<a href="index.php?page=subjects&amp;action=edit&amp;ID_predmet=<?=$subject['ID_predmet']; ?>" 
					   class="btn btn-warning btn-xs "> Редактирай
					</a>
				</div>
				
				<div class="col-md-1 ">
					<a href="index.php?page=subjects&amp;action=delete&amp;ID_predmet=<?=$subject['ID_predmet']; ?>" 
					   class="btn btn-xs btn-danger "> Изтрий
					</a>			
				</div>
				
			</div>
		</li>			
<?php	endforeach;?>
	</ul>

<?php } elseif(isTeacher() || isStudent() || !isLogged()){?>
		
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<ul class="list-group">
				<li class="list-group-item disabled">
					<div class="row">
						<div class="col-sm-4">Предмет</div>
					</div>
				</li>			
<?php
foreach ($subjects as $subject) : ?>
				<li class="list-group-item">
					<div class="row">
						<div class="col-sm-10"><?=$subject['ime'];?></div>				
					</div>
				</li>			
<?php	endforeach;?>
			</ul>
		</div>
	</div>
<?php } ?>	