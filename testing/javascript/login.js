//Sends the username and password to the php file
function login() {
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	if (username == "") {
		alert("Fyll i ett användarnamn");
	} else if (password == "") {
		alert("Fyll i ett lösenord");
	} else {
		var instring = '{"username": "' + username + '", "password": "' + password + '"}';
		var objekt = JSON.parse(instring);
		$.getJSON("register/ajax/login.php", objekt)
			.done(function(data) {
				login_success(data);
			})
			.fail(function() {
				login_error();
			})
			.always(function() {
			});
	}
}
//This happesn if the response was successful
function login_success(response) {
	//If the input was wrong, this code runs.
	if (response.status == "Error") {
		alert("Du har angett fel uppgifter, Försök igen.");
		document.getElementById("password").value = "";
		document.getElementById("password").focus();
	}
	if (response.status == "NotVerified") {
		alert("Ditt konto är inte verifierat. Vänligen logga in på din email och följ instruktionerna.");
	}
	//if the lofin was successful, this code runs.
	if (response.status == "OK") {
		window.location.href = "kategorier/";
	}
}

function login_error() {
	alert("Ett allvarligt fel har inträffatt. Vänligen kontakta support om problemet kvarstår.");
}