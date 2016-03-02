var catvengerApp = angular.module('catvenger', []);

catvengerApp.controller("CatCtrl", ['$scope', function($scope) {
	$scope.displayAbout = false;
	$scope.notif = false;
	$scope.user = $("#user").val();
	$scope.money = $("#moneyfield").val();

	$(function() {
		$("#catarea").height($(document).height());
		getLocation(getCats);
		updateMoney();
	});

	$scope.openNotif = function() {
		$("#notifications").modal();
	}

	$scope.clearNotif = function() {
		$scope.notif = false;
		$("#money-title").empty().html("No notifications");
		$("#money").empty().html("Check back later.");
	}

	$scope.home = function() {
		//$("#cats").empty();
		getLocation(getNewCat);
	}

	//get the location for the user
	function getLocation(f) {
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(f);
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


	function getNewCat(position) {
	    $.ajax("catService.php?lat=" + position.coords.latitude 
		  		+ "&lon=" + position.coords.longitude + "&userid="+$("#userID").val())
		.done(function( data ) {
			if (data && data != "" && data.new) {
				newCat(data.new);
				var newCatArr = [];
				newCatArr.push(data.new);
				showCat(newCatArr);
				console.log(data.new);
				console.log(newCatArr);
			}
		})
		.fail(function(x) {
			console.log(x);
		});
	}

	function showCat(catArr) {
		var area = $("#cats");
		var catarea = $("#catarea");
		for (var i = 0; i < catArr.length; i++) {
			var thisCat = catArr[i];
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
				var randX = Math.floor((catarea.width() / 3 - 100) * Math.random());
				var randY = Math.floor((catarea.height() / 3 - 100) * Math.random());

				img.css({"top": randY + "px", "left": randX + "px"});
				area.append(img);
			}
		}
	}

	function showCats(json) {
		if (json) {
			if (json.cats) {
				showCat(json.cats);
			}
			if (json.new) {
				newCat(json.new);
				var newCatArr = [];
				newCatArr.push(json.new);
				showCat(newCatArr);
			}
			if (json.money) {
				newMoney(json);
			}
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
		$("#money").empty().append(list);

		updateMoney();
		
	}

	function updateMoney() {
		var userID = $("#userID").val();
		$.ajax("service.php?userID=" + userID + "&mode=money")
		.done(function(data) {
			$scope.money = data;
		})
		.fail(function(x) {
			console.log(x);
		});
	}

	function newCat(thisCat) {
		$scope.catName = thisCat.name;
		$scope.catDesc = thisCat.desc;
		$scope.catSrc = thisCat.url;
		$scope.$apply();
		$("#newCatModal").modal();
	}
}]);
