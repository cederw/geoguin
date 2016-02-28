var catvengerApp = angular.module('catvenger', []);

catvengerApp.controller("CatCtrl", ['$scope', function($scope) {
	$scope.displayAbout = false;
	$(function() {
		$("#catarea").height($(document).height());
		getLocation();
	});

	$scope.openNotif = function() {
		$("#notifications").modal();
	}

	$scope.clearNotif = function() {
		$("#money-title").empty().html("No notifications");
		$("#money").empty().html("Check back later.");
	}

	//get the location for the user
	function getLocation() {
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(getCats);
	    } else { 
	        console.log("Geolocation is not supported by this browser.");
	    }
	}
	function getCats(position) {
	    $.ajax("catService.php?lat=" + position.coords.latitude 
		  		+ "&lon=" + position.coords.longitude + "&userid="+$("#userID").val())
		.done(function( data ) {
			showCats(data);
		})
		.fail(function(x) {
			console.log(x);
		});
	}

	function showCats(json) {
		var area = $("#cats");
		for (var i = 0; i < json.cats.length; i++) {
			var thisCat = json.cats[i];
			if (thisCat.url.match(/\.png/)) {
				var img = $("<img>").attr("src", thisCat.url)
						.attr("alt", "a cat")
						.attr("catName", thisCat.name)
						.attr("catDesc", thisCat.desc)
						.addClass("cat")
						// .hover(
						//   function() {
						//     $( this ).attr("src", this.src.replace(/\.png/, "")+'_hang.png');
						//   }, function() {
						//     $( this ).attr("src", this.src.replace(/_hang\.png/, ".png"));
						//   }
						// )
						// .click(function() {
						// 	   	$scope.catName = $(this).attr("catName");
						// 		$scope.catDesc = $(this).attr("catDesc");
						// 		$scope.displayAbout = true;
						// 		$scope.$apply();
						// })
						// .on("taphold", function(){
						//  	console.log($(this).hasClass(".ui-draggable-dragging") );
				  //           if (!$(this).hasClass(".ui-draggable-dragging") ) {
			   //              	$scope.catName = $(this).attr("catName");
						// 		$scope.catDesc = $(this).attr("catDesc");
						// 		$scope.$apply();
						// 		$("#catModal").modal();
				  //           } 
			   //      	})
						// .dblclick(function(){
						//  	console.log($(this).hasClass(".ui-draggable-dragging") );
				  //           if (!$(this).hasClass(".ui-draggable-dragging") ) {
			   //              	$scope.catName = $(this).attr("catName");
						// 		$scope.catDesc = $(this).attr("catDesc");
						// 		$scope.$apply();
						// 		$("#catModal").modal();
				  //           } 
			   //      	})
						.draggable({ containment: "#catarea", scroll: false,
								start: function() {
						   			$(this).attr("src", this.src.replace(/\.png/, "")+'_hang.png');

								 	$scope.catName = $(this).attr("catName");
									$scope.catDesc = $(this).attr("catDesc");
									$scope.displayAbout = true;
									$scope.$apply();
								}, stop: function (helper, ui) {
						    		$(this).attr("src", this.src.replace(/_hang\.png/, ".png"));
								}});
				area.append(img);
			}
		}

		if (json.new) {
			newCat(json);
		}

		if (json.money) {
			newMoney(json);
		}
	}

	// function catClicked(e) {
	// 	console.log(e);
	// 	$scope.catName = $(this).attr("catName");
	// 	$scope.catDesc = $(this).attr("catDesc");
	// 	$scope.$apply();
	// 	$("#catModal").modal();
	// }

	function newMoney(json) {
		$("#money-title").html("You got new money!");
		var list = $("<ul>");
		for (var i = 0; i < json.money.length; i++) {
			var name = json.money[i].name;
			var amount = json.money[i].amount;
		}
	}

	function newCat(json) {
		var thisCat = json.new;
		$scope.catName = thisCat.name;
		$scope.catDesc = thisCat.desc;
		$scope.catSrc = thisCat.url;
		$scope.$apply();

		$("#newCatModal").modal();
	
		$scope.$apply();
		console.log("there was a new cat");
	}
}]);
