$(function() {
	var neko = $("#neko");
	neko.mousedown(nekoDown);
	neko.mouseup(nekoUp);
	neko.mousemove(nekoMove);

	getLocation();
});

// Called when the mouse button is pressed down on a rectangle.
// Begins dragging of that rectangle
function nekoDown(event) {
	var neko = $("#neko");
	neko.attr("prevX", event.clientX);
	neko.attr("prevY", event.clientY);
	neko.attr("dragging", 1);
}

// Called when the mouse cursor moves around on a rectangle.
// If this is done while the mouse button is held down, drags a rectangle.
function nekoMove(event) {
	var neko = $(this);
	var area = $("#area");
	if(neko.attr("dragging") == 1) {
		var dy = event.clientY - neko.attr("prevY");
		var dx = event.clientX - neko.attr("prevX");
		var oldX = parseInt(neko.position().left);
		var oldY = parseInt(neko.position().top);
		neko.css({"top": oldY + dy + "px", "left": oldX + dx + "px"});
		neko.attr("prevX", event.clientX);
		neko.attr("prevY", event.clientY);
		neko.attr("src", "penguin_hang.jpg");
	} else {
		neko.attr("src", "penguin.jpg");

	}
}

// Called when the mouse button is released on a rectangle.
// Stops any rectangle-dragging action that is in progress.
function nekoUp() {
	$("#neko").attr("dragging", 0);
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
    $.ajax({
	  url: "catservice.php?lat="+position.coords.latitude+"&lon="+position.coords.longitude+"&userid="+userID,	  
	})
	  .done(function( data ) {
	      console.log( data );
	    
	});
}

