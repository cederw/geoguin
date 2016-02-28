var catvengerApp = angular.module('catvenger', []);

catvengerApp.controller("CatCtrl", ['$scope', function($scope) {
	$(function() {
		$("#catarea").height($(document).height());
		getLocation();
	});

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
		var area = $("#catarea");
		for (var i = 0; i < json.cats.length; i++) {
			var thisCat = json.cats[i];
			if (thisCat.url.match(/\.png/)) {
				var img = $("<img>").attr("src", thisCat.url)
						.attr("alt", "a cat")
						.attr("catName", thisCat.name)
						.attr("catDesc", thisCat.desc)
						.addClass("cat")
						.hover(
						  function() {
						    $( this ).attr("src", this.src.replace(/\.png/, "")+'_hang.png');
						  }, function() {
						    $( this ).attr("src", this.src.replace(/_hang\.png/, ".png"));
						  }
						)
						.on("taphold", catClicked)
						.dblclick(catClicked)
					//.addClass("ui-widget-content ui-draggable")
						.draggable({ containment: "#catarea", scroll: false});
				area.append(img);
			}
		}

		if (json.new) {
			newCat(json);
		}
	}

	function catClicked() {
		console.log($(this));
		$scope.catName = $(this).attr("catName");
		$scope.catDesc = $(this).attr("catDesc");
		$scope.$apply();
		$("#catModal").modal();
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
