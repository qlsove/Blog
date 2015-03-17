<?php

function deletePost ($GET)
	{	 
	$collection = connectDB();

	$id=(string)$GET['delId']; 
	$nid=new MongoId($id);
	$criteria = array('_id'=> $nid); 
	
	$search = $collection-> findOne($criteria);

		if (isset($search['path']) and $search['path'] !='images/' and file_exists($search['path'])) 
			{	
			unlink($search['path']);	
			}
    $collection->remove($criteria);

    header( 'Location: /index.php?adm=1', true); 
	}

?>

