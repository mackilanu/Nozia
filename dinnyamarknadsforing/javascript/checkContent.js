// var InputData = {
// };


// function registerUser() {


			
// 		$.post("register.php",
// 			{
// 				 data: InputData   
				 
// 			},
// 			function(info) {

// 					//$("#success_alert p").html("hej");
// 					alert(info);
				
// 			});
// 	}else{
// 		alert("Det gick inte att validera formuläret.");
// 	}




// Make sure the given information is correct
// function validateContent() {
// 	var userValidated = false;
  
// 	var password1 = $("#password").val();
// 	var password2 = $("#re-password").val();

// 	if(password1 == "")
// 		alertmsg("Du måste fylla i ett lösenord!");

// 	else if (password1 == password2) {
// 		userValidated = true;
// 	} else {
// 		alert("Sorry, the passwords doesn't match...");
// 	}

// 	if (userValidated) {
// 		InputData.username = $("#username").val();
// 		InputData.firstname = $("#firstname").val();
// 		InputData.lastname = $("#lastname").val();


// 	InputData.email = $("#email").val();

// 		InputData.day = $("#day").val();
// 		InputData.month = $("#month").val();
// 		InputData.year = $("#year").val();

// 		InputData.gender = $("#gender").val();

// 		InputData.password = $("#password").val();
// 		InputData.citystate = $("#citystate").val()

// 		// alert("User info:\nusername:" + username + "\nfirstname: " + firstname + "\nlastname: " + lastname +
// 		// 	"\nemail: " + email + "\nday: " + day + "\nmonth: " + month + "\nyear: " + year + "\ngender" +
// 		// 	gender + "\npassword: " + password);
// 	}

// 	return userValidated;
// }

// Make sure the day is correctly formated
// $("#day").on("change", function() {
// 	day = $("#day").val().toString();

// 	if (day.length < 2) {
// 		day = "0" + day;
// 		$("#day").val(day);
// 	}

// 	else if (day.length > 2) {
// 		$("#day").val("").focus();
// 		alert("Ogiltigt format");
// 	}
// });

// // Make sure the month is correctly formated
// $("#month").on("change", function() {
// 	month = $("#month").val().toString();

// 	if (month.length < 2) {
// 		month = "0" + month;
// 		$("#month").val(month);
// 	}

// 	else if (month.length > 2) {
// 		$("#month").val("");
// 		alert("Ogiltigt format");
// 	}
// });

// // Make sure the year is correctly formated
// $("#year").on("change", function() {
// 	var currentYear = (new Date).getFullYear();
// 	currentYear = currentYear.toString().substr(2);

// 	// alert("The current year is: " + currentYear);

// 	year = $("#year").val().toString();

// 	if (year.length == 2) {
// 		if ($("#year").val() < Number(currentYear))
// 			$("#year").val("20" + year);

// 		else
// 			$("#year").val("19" + year);
// 	}

// 	else if (year.length < 4 || year.length > 4) {
// 		$("#year").val("").focus();
// 		alert("Ogiltigt format");
// 	}
// });

alert("Check content is here!");

function checkpassword(){
	var password1 = $("#password").val();
	
	if(password1.length < 8){
		 document.getElementById(checkpassword).style.display = 'visible';
	}
}