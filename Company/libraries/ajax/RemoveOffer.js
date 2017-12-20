function RemoveOffer(value){

	    var instring  = '{"ID": "' + value  +'"}';

    var objekt = JSON.parse(instring);

  

  $("#tr"+value).hide();
      

    $.getJSON("ajax/RemoveOffer.php", objekt)
        .done(function(data) {
            console.log(data);
	    RemoveOffer_success(data);
	})
        .fail(function() {
        RemoveOffer_fail();
	})
        .always(function() {

	});	
}

function Check(value){
  var check = confirm("Är du säker?");

  if(check == true){
  	RemoveOffer(value);
  }
}


function RemoveOffer_success(response){

	if(response.status == "OK"){
    $("tr"+response.value).hide();
	}

	if(response.status == "Error"){
       alert("Ett fel har inträffat vid borttagningen. Kontakta administratör om problemet kvarstår.");
	}
}

function RemoveOffer_fail(){

  alert("Ett allvarligt fel har inträffat, kontakta administratör om felet kvarstår.");
}