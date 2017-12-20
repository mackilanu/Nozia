function UseOffer(Myoffer){

	    var instring  = '{"value": "' + Myoffer  +'"}';

    var objekt = JSON.parse(instring);


    $.getJSON("ajax/UseOffer.php", objekt)
        .done(function(data) {
            console.log(data);
	   UseOffer_success(data);
	})
        .fail(function() {
         UseOffer_fail();
	})
        .always(function() {

	});	
}


function UseOffer_success(response){

	if(response.status == "OK"){

		window.location.href = "SubmittedOffer/index.php";
	}

	if(response.status == "Error"){
		alert("Ett allvarligt fel har inträffat. Kontakta administratör om felet kvarstår.");
	}
}

function UseOffer_fail() {
	alert("Ett allvarligt fel har inträffat. Kontakta administratör om felet kvarstår.");
}