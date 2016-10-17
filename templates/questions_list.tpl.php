<?php if(!isDirektor() AND isTeacher()) : ?>
	<a href="index.php?page=questions&amp;action=add" class="btn btn-default">
	<i class="fa fa-plus"></i> Добави въпрос </a></br>	
<?php endif;?>
	</br>
	<ul class="list-group">
		<li class="list-group-item disabled">
			<div class="row">
				<div class="col-md-4">Bъпрос</div>

				<div class="col-md-3">Верем отговор</div>

				<div class="col-md-2">Предмет</div>

				<div class="col-md-1">Ниво</div>
			</div>
		</li>
<?php
if(count($questions)){ 
foreach ($questions as $question) : ?>
		<li class="list-group-item">
			<div class="row">
				<div class="col-md-4"><?=$question['vupros'];?></div>
				
				<div class="col-md-3"><?=$question['otgovor'.$question['pravilen']];?></div>
				
				<div class="col-md-2"><?=$question['ime'];?></div>
				
				<div class="col-md-1">
					<?php
					if($question['level']==1){
						echo "Лесен";
					}
					elseif ($question['level']==2) {
						echo "Среден";
					}
					elseif ($question['level']==3) {
						echo "Труден";
					}
					?>
				</div>
				<div class="col-md-1 ">
				<?php if(!isDirektor() AND isTeacher()) : ?>
					<a href="index.php?page=questions&amp;action=edit&amp;ID_vuprosi=<?=$question['ID_vuprosi']; ?>" 
					   class="btn btn-warning btn-xs "> Редактирай
					</a>
				<?php endif;?>
				</div>
				
				<?php if(!isDirektor() AND isTeacher()): ?>
				<div class="col-md-1 ">
					<a href="index.php?page=questions&amp;action=delete&amp;ID_vuprosi=<?=$question['ID_vuprosi']; ?>" 
					   class="btn btn-xs btn-danger "> Изтрий
					</a>			
				</div>
				<?php endif;?>
			</div>
		</li>			
<?php	endforeach;
} else {
?>
		<li class="list-group-item"><p class="text-warning">Няма дадени въпроси</p> </li>
	<?php
}
?>
	</ul>