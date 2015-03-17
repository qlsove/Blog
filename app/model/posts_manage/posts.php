<?php 

function viewPost ($POST, $GET, $categories, $links, $target_dir)
	{				
	$collection = connectDB(); 
		if( isset($GET['id']) || isset($GET['tag']) || isset($POST['searchData']) )   
			{
				if(isset($GET['id']) ) 
					{
					$id=(int)$GET['id'];
					$check = $categories[($id)-1];
					$criteria = array('category'=>$check);
					} 

				else
					{
						if(isset($GET['tag'])) 
							{
							$a=$GET['tag'];
							}

						else
							{
							$a=$POST['searchData'];
							} 

					$regex=new MongoRegex('/$a/');
					$criteria = array('$or' => array(array('name'=> array('$regex' =>$a)), array('tags'=> array('$regex' =>$a)), array('body'=> array('$regex' =>$a))));
					echo 'Результати пошуку: "'. $a.'"<br><br>';
					}

			$search = $collection-> find($criteria)-> sort(array("time" => 1));
			}

		else
			{
			$search = $collection-> find()-> sort(array("time" => 1));
			}
			 
		  
		if($search->count(true))
			{
				foreach($search as $post)
					{
					echo '<div class="post-content"><h2 class="blog-title">'.htmlspecialchars($post['name']).'</h2>';
						echo '<div class="blog-text">';
							if (isset($post['path']) and $post['path'] !='images/' and file_exists($post['path']))     
								{
								$size = getimagesize($post['path']);	
								echo '<p><img src="'.$post['path'].'"'.($size[0]>=$size[1]?' width':' height' ).'="400" align="left" vspace="10" hspace="10">';
								}
							else echo '<p>';
							
						echo htmlspecialchars($post['body']).'</div></p>';
							echo'<div class="blog-footer" >';
							echo 'Розділ:  ';
							echo '<a href="index.php?id='.(array_search($post['category'], $categories)+1).'"  style="text-decoration: none;">'.$links[(array_search($post['category'], $categories))+1].'</a><br>';

								if ($post['tags']!='')
									{
									$tag = $post['tags']; 
									$tags= explode(" " , $tag);
									echo 'Теги: ';
									
										foreach($tags as $item)
											{
											echo '<a href="index.php?tag='.$item.'" style="text-decoration: none;">#'.$item.'</a>  ';
											}
									}
								else
									{
									echo 'Тегів не вказано';
									}

							$a=$post['id']->getTimestamp();
							echo '<br><br>Створено: '.date('d/m/Y H:i:s', $post['time']).'<br>';        
								if($a!=$post['time'])
									{
									echo 'Оновлено: '.date('d/m/Y H:i:s', $a).'<br>';
									}

							echo '</div>';
					echo '</div>'; 	    
					}
			}

		else
			{
			echo 'Записів не знайдено</div>';
			}
	}

  
?> 
