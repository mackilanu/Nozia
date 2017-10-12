$(window).on('load', function() { 
   
       	var instring  = '{"Vid": "' + vid +'"}';

       	var objekt = JSON.parse(instring);

      $.getJSON("ajax/checkVerified.php", objekt)
        .done(function(data) {
       success(data);
	})
        .fail(function() {
        error();
	})
        .always(function() {

	});

});

function success(response){

	if(response.status == "Already"){
		window.location.href = "error.php";
	}

	if(response.status == "NoExists"){
		alert("Ett fel har inträffat. Vänligen kontakta administratör om problemet kvarstår.");

	}

}

function error(){

	alert("Ett allvarligt fel har inträffat. Vänligen kontakta administratör om problemet kvarstår.");
}