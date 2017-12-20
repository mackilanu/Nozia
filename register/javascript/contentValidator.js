var userchecked = false;
var userlength  = false;
var emailchecked = false;
var birthdaydatechecked = false;
var birthdayyearchecked = false;
var genderchecked = false;
var citystatechecked = false;
var passchecked = false;

$(document).ready(function() {
	// Make sure the username isn't already in use
	#("#register").disabled = true; 
	$("#username").change(function() {
		var username = $("#username").val();
       
       //Checks if the username is long enough
		if (username.length < 6){
			// $("#usernameLength-alert").show();

			$("#username").css("border", "solid thin red");
			$("#username").val("");
			$("#username").attr("placeholder", "Användarnamnet måste ha minst 6 tecken");

			userlength= false;
			checkIfDone();
		}else{
			$("#username").css("border", "none");

			userlength = true;
			checkIfDone();
			// $("#usernameLength-alert").hide();
		}

		$.post("php/validateUsername.php", 
		{
			username: username
		},
		function(data, status, info) {
			//alert("Data:\n" + data + "\n\nStatus:\n" + status);

			if(data == true){
				// alert("Användarnamnet finns redan!");
				// $("#username-alert").show();

				$("#username").css("border", "solid thin red");
				$("#username").val("");
				$("#username").attr("placeholder", "Användarnamnet är redan upptaget");

				userchecked = false;
				checkIfDone();
			}else{
				// alert("Användarnamnet är ledigt.");

				// $("#username-alert").hide();

				userchecked = true;
				checkIfDone();
			}
		});
	});

    //================
    //New Code 02/10
    //================
     // Make sure the Email-adress isn't already in use
	$("#email").change(function() {
		var email = $("#email").val();
       
		$.post("php/validateEmail.php", 
		{
			email: email
		},
		function(data, status, info) {
			if(data == true){
				//    $("#email-alert").show();

				$("#email").css("border", "solid thin red");
				$("#email").val("");
				$("#email").attr("placeholder", "Den här E-mail adressen är redan upptagen");

				emailchecked = false;
				checkIfDone();
			}else{
				// $("#email-alert").hide();
				emailchecked = true;
				checkIfDone();
			}
		});
	});

	$("#day").change(function() {
		var day = $("#day").val().toString();

		if (day.length < 2) 
			$("#day").val("0" + day);
		
		if (day > 0 && day < 30) {
			birthdaydatechecked = true;
			checkIfDone();
		} else {
			$("#day").css("border", "solid thin red");
			$("#day").val("");
			$("#day").attr("placeholder", "Fel datum");

			birthdaydatechecked = false;
			checkIfDone();
		}
	});

	$("#year").change(function() {
		var year = $("#day").val().toString();
		var currentYear = (new Date).getFullYear().toString();

		currentYear = currentYear.substring(2);

		// Format the given year
		// if (year.length == 2) {
		// 	if (year < currentYear) {
		// 		year = "20" + year;
		// 		$("#year").val(year);
		// 	} else {
		// 		year = "19" + year;
		// 		$("#year").val(year);
		// 	}
		// }
	});

	$("#password").change(function(){
       var password = $("#password").val();

       if(password.length < 8){
		//    $("#pw1-alert").show();

		   $("#password").css("border", "solid thin red");
		   $("#password").val("");
		   $("#password").attr("placeholder", "Lösenordet är för kort");
		//    $("#password").css("border-radius", "10px");
       }else{
		   $("#pw1-alert").hide();

		   $("#password").css("border", "none");
       }
	});

	$("#re-password").on('change', function(){
		var password = $("#password").val();
    	var repassword = $("#re-password").val();

       	if(password != repassword){
       		// $("#pw2-alert").show();

			$("#re-password").css("border", "solid thin red");
			$("#re-password").val("");
			$("#re-password").attr("placeholder", "Lösenorden matchar inte");

		   	// document.getElementById("register").disabled = true;
			checkIfDone();
      	}else{
			//   $("#pw2-alert").hide();
			  
			//   $("#re-password").css("border", "none");
			  
			//   document.getElementById("register").disabled = false; 
       	}
	});

	$("#re-password").on("input", function() {
		var password = $("#password").val();
		var repassword = $("#re-password").val();

		if (password == repassword) {
			// document.getElementById("register").disabled = false;
			passchecked = true;
			checkIfDone();
		}

		else if (passchecked) {
			passchecked = false;
			checkIfDone();
		}
	});
});

// Check if the entire form is correctly inputed
function checkIfDone() {
	var done = true;

	if (!userchecked)
		done = false;

	else if (!userlength)
		done = false;

	else if (!emailchecked)
		done = false;

	else if (!passchecked)
		done = false;

	if (done)
		document.getElementById("register").disabled = false;
	
	else
		document.getElementById("register").disabled = true;
}