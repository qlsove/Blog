<?php

function admin ($GET, $categories, $links, $target_dir)
	{
	$collection = connectDB();
	$search = $collection-> find()-> sort(array("time" => 1));
		if($search->count(true)):
?>
			<table width="760" border="1" cellspacing="0" >
				<tr id="table-title">
					<th width="400">Назва</th>
					<th width="145">Створено</th>
					<th width="75">Категорія</th>
					<th width="140" colspan="2">Управління</th>
				</tr>
			
		<?php 	
			foreach($search as $post)
				{
		?>
					<tr>
						<th class="cell-title" width="400"> <?=htmlspecialchars($post['name'])?></th>
						<th width="145"> <?=date('d/m/Y H:i:s', $post['time'])?></th>
						<th width="75"> <?=$post['category']?></th>
						<th width="70">  <?='<a href="index.php?delId='.$post['_id'].'"  style="text-decoration: none;">Видалити</a>' ?> </th> </div>
						<th width="70"> <?='<a href="index.php?chgId='.$post['_id'].'" style="text-decoration: none;">Редагувати</a>' ?> </th>
					</tr>

		<?php 
				}
		endif;					
		?>

			</table>             
			
			<div class="add">
				<form name = "newPost" action="index.php" method = "POST"  autocomplete="off" enctype="multipart/form-data">
					<p><textarea wrap="soft"  placeholder="Вкажіть назву статті" style="width: 755px; height: 25px; resize: vertical" name="name" required ></textarea></p>
					<p><textarea wrap="soft" placeholder="Напишіть вміст статті" style="width: 755px; height: 300px; resize: vertical" name="body" required ></textarea></p>
					<p><textarea wrap="soft"  placeholder="Перерахуйте при потребі теги до статті через пробіл" style="width: 755px; height: 25px; resize: vertical" name="tags"></textarea></p>
					<input type="hidden" name="insId" value="1">
					Виберіть категорію:<br>

					<?php
					for ($x=0; $x<=count($categories)-1; $x++) 
					echo '<input type="radio" name=category required value="'.$categories[$x].'">'.$links[$x+1];
					?>

					<p>Виберіть картинку для статті: <br>  
					<input type="file" name="file">
					<p><input type="submit" name="submit"  value="Додати новий пост!" formmethod="post"></p>

				</form>
			</div>

	<?php 	 
	} 
	?> 
 
 