<?php 

	session_start();
	$user = $_SESSION["user"];
	if (!isset($_SESSION["user"])) {
		session_destroy();
		header("Location: index.php");
	}

	include("common.php");
	open(true);
?>


<div id="catarea">
</div>

<div class="container">

  <div class="modal fade" id="catModal" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">{{catName}}</h4>
        </div>
        <div class="modal-body">
          <p>{{catDesc}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
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
<?php
	close();
?>
