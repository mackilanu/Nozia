$(window).on('load', function() {
 
    document.getElementById("email").value = Email;
    document.getElementById("name").value = Name;
});

function submit_contact() {

    var name    = document.getElementById("name").value;
    var email   = document.getElementById("email").value;
    var subject = document.getElementById("subject").value;
    var message = document.getElementById("message").value;

    if(!check_string(32 ,name)) {
	alert("Namnet är för långt. Vänligen ange ett kortare.");
	return;
    }

     if(!check_string(64 ,email)) {
	alert("Email-adressen är för lång. Vänligen ange ett kortare.");
	return;
     }

     if(!check_string(32 ,subject)) {
	alert("Ämnet är för långt. Vänligen ange ett kortare.");
	return;
     }

    var instring = '{"name": "' + name + '", "email": "'+ email +'", "subject": "'+ subject +'", "message": "'+ message +'"}';
  
    var  objekt = JSON.parse(instring);

    var JSONstring = JSON.stringify(objekt).replace(/'/g, "\\'");
    
    $.getJSON("ajax/submit_form.php", objekt)
        .done(function(data) {
            submit_contact_success(data);
        })
        .fail(function() {
            submit_contact_error();
        })
        .always(function() {

        });
}

function submit_contact_success(response) {

    if(response.status == "OK") {

	var s = "";
	
	s += '<div class="alert alert-success">';
	s += 'Tack för ditt meddelande! Vi tittar nu på din fråga och återkommer inom kort.';
	s += ' </div>';

	document.getElementById("main").innerHTML = s;
    }

    if(response.status == "Error") {
	alert("Ett fel inträffade. Om problemet kvarstår vänligen kontakta administratör.");
    }
}

function  submit_contact_error() {

    alert("Ett allvarligt fel inträffade. Om problemet kvarstår vänligen kontakta administratör.");
}

function check_string(len, val) {
    
    if(val.length > len)
	return false;
    return true;
}
