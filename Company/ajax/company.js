
function removeFile(){

var conf = confirm("Är du säker?");

if(conf == true){
 var value = $('#Remove').val();
 console.log(value);
 SendData(value);
}

   
}

function SendData(value){

	    var instring  = '{"file": "' + value  +'"}';

    var objekt = JSON.parse(instring);
      

    $.getJSON("ajax/RemoveFile.php", objekt)
        .done(function(data) {
            console.log(data);
	    SendData_success(data);
	})
        .fail(function() {
        SendData_fail();
	})
        .always(function() {

	});

}


function SendData_success(response){

	if(response.status == "Error"){

		alert("Det gick inte att ta bort filen, kontakta administratör om felet kvartår.");
	}

	if(response.status == "NotDeleted"){
		alert("Det gick inte att ta bort bilden, vänlifen kontakta administratör.");
	}
}

function SendData_fail(){
	alert("Ett problem med att ta bort filen har inträffat. Kontakta administratör om felet kvarstår.");

}