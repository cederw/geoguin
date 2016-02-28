<!DOCTYPE html>
<?php
	include("mysql_connect.php");
	$userID = $_GET['userid'];
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	$dbh = getDB();

	$stmt = "UPDATE cat SET userID=NULL, timeout=NULL WHERE timeout < NOW()";
	$dbh->query($stmt);	

    $stmt = "SELECT c.id, c.name, c.desc, c.url FROM cat c JOIN user u ON c.userID = u.id WHERE u.id = ".$userID;
	// insert one row	
	foreach ($dbh->query($stmt) as $row) {
		//echo $row['name'];
		$customer2[] = $row;
	}

     $stmt = "SELECT c.id, c.name, c.desc, c.url FROM cat c  WHERE (".$lat." BETWEEN lat - 0.00001 AND lat + 0.00001) AND (".$lon." BETWEEN lon - 0.00001 AND lon + 0.00001) AND userID IS NULL";
	// insert one row	
     foreach ($dbh->query($stmt) as $row) {
		//echo $row['name'];
		$customer[] = $row;
	}

	$struct = array("Cats" => $customer);
	if(count($struct['Cats']>0)){
		$k = array_rand($struct['Cats']);
		$v = $struct['Cats'][$k];
		$stmt = "UPDATE cat SET userID=".$userID.", timeout=NOW() + INTERVAL 6 HOUR WHERE id = ".$v['id'];
		$dbh->query($stmt);	
		$customer2[] = $v;
	}

	$struct2 = array("Cat" => $customer2);
	print json_encode($struct2)
	

	//select a random cat from the array
	//check cat out to user
	//return json of the cat

//print json_encode($struct);

	//return an array of the cats who meet the params

	
?>
