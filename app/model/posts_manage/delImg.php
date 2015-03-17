<?php

function deleteImg ($GET)
	{	 
	$collection = connectDB();

	$id=(string)$GET['delImg']; 
	$nid=new MongoId($id);
	$criteria = array('_id'=> $nid); 
	$newdata = array ('$set' => array("path" =>  "images/"));
	
	$search = $collection-> findOne($criteria);
	$a=$search['_id'];
	
	unlink($search['path']);	

	$collection->update($criteria, $newdata, array('upsert' => true));

  	header( "Location: /index.php?chgId=$a"); 
	}

?>

