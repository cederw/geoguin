<?php 

	session_start();
	$user = $_SESSION["user"];
	if (!isset($_SESSION["user"])) {
		session_destroy();
		header("Location: index.php");
	}
	$userID = $_SESSION["userID"];

	include("nav.php");

?>

<!DOCTYPE html>
<html ng-app="catvenger">
	<head>
		<?php include("head.php"); ?>
		<script type="text/javascript" src="catvengerApp.js"></script>
	</head>

	<body ng-controller="CatCtrl">
		<?php nav(true, true); ?>

		<div class="container" id="cat-container">
			<input type="hidden" id="userID" value="<?=$userID?>">

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
			          <h4 class="modal-title" id="money-title"></h4>
			        </div>
			        <div class="modal-body">
			        	<div id="money">
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
