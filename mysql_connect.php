<?php
	// user needs to close connection
	function getDB() {

		$db = new PDO(
	    'mysql:host=localhost;
	    dbname=cederw_cats',
	    'cederw_cats',
	    'cats2!');
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    return $db;
	}
?>