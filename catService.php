<!DOCTYPE html>
<?php
	$userID = $_GET['userid'];
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	$dbh = new PDO('mysql:host=localhost;port=3306;dbname=cederw_cats', 'cederw_cats', 'cats2!', array( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));


	$stmt = "UPDATE cat SET userID=NULL, timeout=NULL WHERE timeout < NOW()";
	$dbh->query($stmt);	

    $stmt = "SELECT c.name, c.desc, c.url FROM cat c JOIN user u ON c.userID = u.id WHERE u.id = ".$userID;
	// insert one row	
	foreach ($dbh->query($stmt) as $row) {
		//echo $row['name'];
		$customer[] = $row;
	}

     $stmt = "SELECT c.name, c.desc, c.url FROM cat c  WHERE (".$lat." BETWEEN lat - 0.00001 AND lat + 0.00001) AND (".$lon." BETWEEN lon - 0.00001 AND lon + 0.00001) AND userID IS NULL";
	// insert one row	
     foreach ($dbh->query($stmt) as $row) {
		//echo $row['name'];
		$customer[] = $row;
	}

	$struct = array("Cats" => $customer);
print json_encode($struct);

	//return an array of the cats who meet the params

	
?>
