<?php

function insertPost ($POST, $GET, $FILES)
	{
	$collection = connectDB();
	
	$tempId=new MongoId();
	$tempTime=$tempId->getTimestamp();

	$target_dir = "images/";
	$target_file = $target_dir.basename($FILES["file"]["name"]);  
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION) ;

		/*if(null !== (basename($FILES["file"]["name"])) && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )  
			{
			header( 'Location: /index.php?err=2', true);
			}
		else
			{*/

	move_uploaded_file($FILES["file"]["tmp_name"], $target_file);
	$info = pathinfo($FILES["file"]["name"]);
				
	$data=array('name' => $POST['name'],'body' => $POST['body'],'category' => $POST['category'], 'tags' => $POST['tags'], 'id'=> $tempId, 'time'=> $tempTime, 'path'=> $target_file);
		
				$collection -> insert($data);
	           
				$search = $collection-> findOne(array('id'=> $tempId));
				$time=$search['_id']->getTimestamp();

					
	  		if ($search['path']!==$target_dir)
	  			{
				$new_name = $target_dir.$search['_id'].'.'.$info['extension'];
  				rename($target_file, $new_name);
				$newdata=array('name' => $search['name'],'body' => $search['body'],'category' => $search['category'], 'tags' => $POST['tags'], "id" =>  $search['_id'], 'time'=> $time, 'path'=> $new_name);
				}
			else
				{
				$newdata=array('name' => $search['name'],'body' => $search['body'],'category' => $search['category'], 'tags' => $POST['tags'], "id" =>  $search['_id'], 'time'=> $time, 'path'=> $target_file);
				}
	                
		$collection->update(array('id'=> $tempId), $newdata, array('upsert' => true));
		
		header( 'Location: /index.php?adm=1', true); 
			
			//}
	}	  
 
 
?>