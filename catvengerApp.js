var catvengerApp = angular.module('catvenger', []);

catvengerApp.controller("CatCtrl", ['$scope', function($scope) {
	
	$(function() {
		
		getLocation();
	});

	// Called when the mouse button is pressed down on a rectangle.
	// Begins dragging of that rectangle
	// function nekoDown(event) {
	// 	var neko = $(this);
	// 	neko.attr("prevX", event.clientX);
	// 	neko.attr("prevY", event.clientY);
	// 	neko.attr("dragging", 1);
	// }

	// Called when the mouse cursor moves around on a rectangle.
	// If this is done while the mouse button is held down, drags a rectangle.
	// function nekoMove(event) {
	// 	var neko = $(this);
	// 	var area = $("#catarea");
	// 	if(neko.attr("dragging") == 1) {
	// 		var dy = event.clientY - neko.attr("prevY");
	// 		var dx = event.clientX - neko.attr("prevX");
	// 		var oldX = parseInt(neko.position().left);
	// 		var oldY = parseInt(neko.position().top);
	// 		neko.css({"top": oldY + dy + "px", "left": oldX + dx + "px"});
	// 		neko.attr("prevX", event.clientX);
	// 		neko.attr("prevY", event.clientY);
	// 		console.log("top: " + (oldY + dy));
	// 		//neko.attr("src", "penguin_hang.jpg");
	// 	} else {
	// 		//neko.attr("src", "penguin.jpg");
	// 	}
	// }

	// Called when the mouse button is released on a rectangle.
	// Stops any rectangle-dragging action that is in progress.
	// function nekoUp() {
	// 	var neko = $(this);
	// 	neko.attr("dragging", 0);
	// }

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
			console.log("fail: " + x);
		});
	}

	function showCats(json) {
		var area = $("#catarea");
		for (var i = 0; i < json.cats.length; i++) {
			var thisCat = json.cats[i];
			if (thisCat.url.match(/\.jpg/)) {
				var img = $("<img>").attr("src", thisCat.url)
						.attr("alt", "a cat")
						.addClass("cat")
						.hover(
						  function() {
						    $( this ).attr("src", this.src.substring(0,this.src.length-4)+'_hang.jpg');
						  }, function() {
						    $( this ).attr("src", this.src.substring(0,this.src.length-9)+'.jpg');
						  }
						)
						.dblclick(function() {
							catClicked(thisCat);
						})
						//.mousedown(nekoDown)
						//.mouseup(nekoUp)
						//.mousemove(nekoMove)
						.addClass("ui-widget-content ui-draggable")
						.draggable();
				area.append(img);
			}
		}

		if (json.new) {
			newCat(json);
		}
	}

	function catClicked(thisCat) {
		$scope.catName = thisCat.name;
		$scope.catDesc = thisCat.desc;
		$scope.$apply();
		$("#modalBtn").click();
	}

	function newCat(json) {
		console.log("there was a new cat");
		console.log(json.new);
	}



}]);
