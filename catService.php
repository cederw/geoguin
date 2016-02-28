<?php
	echo "test";
	$userID = $_GET['userid'];
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
/*
	$dbh = new PDO('mysql:host=localhost;port=3306;dbname=cederw_cats', 'cederw_cats', 'cats2!', array( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));

    $stmt = $dbh->prepare("SELECT c.name, c.desc, c.url FROM cat c JOIN user u ON c.userID = u.id WHERE u.id = ".$userID);
	// insert one row	
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	 foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }

     $stmt = $dbh->prepare("SELECT c.name, c.desc, c.url FROM cat c  WHERE (".$lat." BETWEEN lat - 0.00001 AND lat + 0.00001) AND (".$lon." BETWEEN lon - 0.00001 AND lon + 0.00001)");
	// insert one row	
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	 foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
	//sql all cats who have visted the user, check if any have timed out, and remove them
	//sql all cats who live near the coords
	//return an array of the cats who meet the params

	*/
?>
