var catvengerApp = angular.module('catvenger', []);

catvengerApp.controller("CatCtrl", ['$scope', function($scope) {
	$scope.displayAbout = false;
	$scope.notif = false;
	$(function() {
		$("#catarea").height($(document).height());
		getLocation();
	});

	$scope.openNotif = function() {
		$("#notifications").modal();
	}

	$scope.clearNotif = function() {
		$scope.notif = false;
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
		var area = $("#catarea");
		for (var i = 0; i < json.cats.length; i++) {
			var thisCat = json.cats[i];
			if (thisCat.url.match(/\.png/)) {
				var img = $("<img>").attr("src", thisCat.url)
						.attr("alt", "a cat")
						.attr("catName", thisCat.name)
						.attr("catDesc", thisCat.desc)
						.addClass("cat")
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
				console.log("height: " + area.height() + ", width: " + area.width());
				var randY = parseInt((area.height() / 2 * 3) * Math.random());
				var randX = parseInt((area.width() / 2 * 3) * Math.random());
				// if (randY < 50) {
				// 	randY += 50;
				// }
				img.css({'top' : randY + 'px'});
				img.css({'left' : randX + 'px'});
				console.log("randY: " + randY + ", randX: " + randX);
			}
		}

		if (json.new) {
			newCat(json);
		}
	}

	function newMoney(json) {
		$scope.notif = true;
		$scope.$apply();

		$("#money-title").html("You got some coins!");
		var list = $("<ul>");
		for (var i = 0; i < json.money.length; i++) {
			var name = json.money[i].name;
			var amount = json.money[i].amount;
			var item = $("<li>").html(name + " gave you " + amount + " coins!");
			list.append(item);
		}
		$("#money").append(list);
	}

	function newCat(json) {
		var thisCat = json.new;
		$scope.catName = thisCat.name;
		$scope.catDesc = thisCat.desc;
		$scope.catSrc = thisCat.url;
		$scope.$apply();

		$("#newCatModal").modal();
	
		console.log("there was a new cat");
	}
}]);
