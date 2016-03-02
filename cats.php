<?php 

	session_start();
	if (!isset($_SESSION["user"]) || !isset($_SESSION["userID"])) {
		session_destroy();
		header("Location: index.php");
	} 
	$user = $_SESSION["user"];
	$userID = $_SESSION["userID"];
	$money = $_SESSION["money"];

	include("nav.php");

?>

<!DOCTYPE html>
<html ng-app="catvenger">
	<head>
		<?php include("head.php"); ?>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="catvengerApp.js"></script>
	</head>

	<body ng-controller="CatCtrl">
		<?php nav(true, true); ?>

		<div class="container" id="cat-container">
			<input type="hidden" id="userID" value="<?=$userID?>">
			<input type="hidden" id="user" value="<?=$user?>">
			<input type="hidden" id="moneyfield" value="<?=$money?>">

			<div id="catarea">
				<div id="cats"></div>
				<div ng-show="displayAbout" id="about-cat">
					<p>{{catName}}</p>
					<p>{{catDesc}}</p>
				</div>
			</div>

			<div class="container">

			  <div class="modal fade" id="newCatModal" role="dialog">
			    <div class="modal-dialog">
			    
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">You got a new cat!</h4>
			        </div>
			        <div class="modal-body">
			        	<div>
				        	<img ng-src="{{catSrc}}" alt="a new friend" class="modal-cat" />
							<p>Meet {{catName}}. {{catDesc}}</p>
						</div>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			      
			    </div>
			  </div>
			</div>

			<div class="container">
			  <div class="modal fade" id="notifications" role="dialog">
			    <div class="modal-dialog">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title" id="money-title">No notifications</h4>
			        </div>
			        <div class="modal-body">
			        	<div id="money">
			        	Check back later.
						</div>
			        </div>
			        <div class="modal-footer">
			          <button type="button" ng-click="clearNotif()" class="btn btn-default" data-dismiss="modal">Close</button>
			        </div>
			      </div>
			      
			    </div>
			  </div>
			</div>
		</div>
	</body>
<html>
