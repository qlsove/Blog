<?php 

function connectDB()
	{
	$mongo = new MongoClient(); 
	$collection = $mongo ->first->blog;
		
	return $collection;
	}

	 // or connect to external DB:
	 //$conn = new MongoClient("mongodb://qlsove:123qwASD@ds061518.mongolab.com:61518/first");
	 //$db = $conn;
	 //$collection = $conn->blog; 
?>