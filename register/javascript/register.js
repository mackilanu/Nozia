var checkusername   = false;
var checkfirstname  = false;
var checkemail      = false;
var checkday        = false;
var checkmonth      = false;
var checkyear       = false;
var checkgender     = false;
var checkpassword   = false;
var checkrepassword = false;
var checkcountry    = false;
var checkCitystate  = false;
var checked         = false;

$( document ).ready(function() {
    document.getElementById("register").disabled = true;
    
});


initialize();

function initialize(){
    
    
    $.getJSON("register/ajax/fetchcountry.php")
        .done(function(data) {
	    initialize_success(data);
	})
        .fail(function() {
            initialize_error();
	})
        .always(function() {

	});

}

function runScript(e) {
    if (e.keyCode == 13) {
        login();
        return false;
    }
}



function fetchCS(){
    $.getJSON("register/ajax/fetchCS.php")
        .done(function(data) {
	    fetchCS_success(data);
	})
        .fail(function() {
	    initialize_error();
	})
        .always(function() {

	});
    
}

function resetPw(){

    var email = document.getElementById("txt_email").value;

    var instring  = '{"Email": "' + email +'"}';    
    var objekt    = JSON.parse(instring);

    $.getJSON("register/ajax/resetPw.php", objekt)
        .done(function(data) {
            resetPw_success(data);
	})
        .fail(function() {
            resetPw_error();
	})
        .always(function() {

	});	


}

function resetPw_success(response){

    if(response.status == "InsertError"){

	alert("Ett fel har inträffat. Vänligen kontakta administratör om problemet kvarstår.");
    }
    
    alert("Om email-adressen finns i vår databas så har ett mail skickats ut till adressen med instruktioner för att komma åt ditt konto igen.");
    
}

function resetPw_error(){
    alert("Ett allvarligt fel har inträffat. Vänligen kontakta administratör om problemet kvarstår.");
}



function fetchCS_success(response){

    if(response.status = "OK"){
        var country = document.getElementById("country");
        var id = $(country).children(":selected").attr("id");
        var x = document.getElementById("citystate");
        $("#citystate").empty();
        for(var i = 0; i <= response.CS.length; i++){
            if(id == response.CS[i].Country){
		
		var option = document.createElement("option");
		option.setAttribute("value", response.CS[i].ID); 
                
		option.text = response.CS[i].CityState;
		x.add(option);
		
            }
        }
    }

    if(response.status == "Error"){
        alert("Något gick snett. "+response.status);
    }

}


function initialize_success(response){
    if(response.status = "OK"){

        var x = document.getElementById("country");
        for(var i = 0; i < response.country.length; i++){
            var option = document.createElement("option");
            option.setAttribute("id", response.country[i].id); 
            option.text = response.country[i].Country;
            x.add(option);
        }
    }

    if(response.status == "Error"){
        alert("Något gick snett. "+response.status);
    }
}

function initialize_error(){
    alert("Ett allvarligt fel har inträffat, om felet kvartsår vänligen kontakta administratör");
}

function checkUsername(value){
    
    if(value.length < 6){
	
   	alert("Användarnamnet måste innehålla minst 6 tecken.");
   	document.getElementById("Username").value = "";
   	document.getElementById("Username").focus(); 

    }else{
	var instring  = '{"username": "' + value +'"}';    
	var objekt    = JSON.parse(instring);

	$.getJSON("register/ajax/checkUsername.php", objekt)
            .done(function(data) {
		checkUsername_success(data);
	    })
            .fail(function() {
		checkUsername_error();
	    })
            .always(function() {

	    });
    }
}

function register(){

    var Uname   = document.getElementById("Username").value;
    var Fname   = document.getElementById("firstname").value;
    var Email   = document.getElementById("email").value;
    var Day     = document.getElementById("day")
    var Month   = document.getElementById("month");
    var Year    = document.getElementById("year");
    
    var Gender  = document.getElementById("gender").value;
    var Country = document.getElementById("country").value;
    var CS      = document.getElementById("citystate").value;
    var Pword   = document.getElementById("pword").value;

    //Adds 0 to day if the value is under 10
    if(day[day.selectedIndex].value < 10)
	day[day.selectedIndex].value = "0"+day[day.selectedIndex].value;

    var Bday   = year[year.selectedIndex].value + "-" + month[month.selectedIndex].value + "-" + day[day.selectedIndex].value;  

    var instring  = '{"username": "' + Uname +'",'; 
    instring += '"Fname": "'    + Fname +'",';
    instring += '"Email": "'    + Email +'",';
    instring += '"Bday": "'     + Bday +'",';
    instring += '"Gender": "'   + Gender +'",';
    instring += '"Country": "'  + Country +'",';
    instring += '"CS": "'       + CS +'",';
    instring += '"Password": "' + Pword +'"}';

    var objekt = JSON.parse(instring);

    console.log(objekt);


    $.getJSON("register/ajax/register.php", objekt)
        .done(function(data) {
	    register_success(data);
	})
        .fail(function() {
            register_fail(data);
	})
        .always(function() {

	});


}

function register_success(response){

    var Fname   = document.getElementById("firstname").value;

    if(response.status == "OK"){
	window.location.href = "http://nozia.se/confirmedmail/?Name="+Fname+"&ch_mail=true&type=1";
    }

    if(response.status == "Error"){
	alert("Ditt konto kunde inte registreras. kontakta administratör om problemet kvarstår.");
    }
}

function register_fail(response){
    
    alert("Ett allvarligt fel har inträffat vid registrering av konto. Kontakta administratör om problemet kvarstår");
}

function checkUsername_success(response){

    if(response.status == "OK"){
	checkusername = true;
	checkIfDone();
    }
    if(response.status == "Exists"){
   	alert("Användarnamnet finns redan");
	checkusername = false;  
	document.getElementById("Username").focus(); 
   	checkIfDone();
    }
}


function checkUsername_error(){
    alert("Ett fel har uppstått. Kontakta administratör om problemet kvarstår.");
}


function check_FirstName(value){

    if(value == ""){
	alert("Fyll i ett förnamn");
	checkfirstname = false;
	document.getElementById("firstname").focus();
	checkIfDone()
    }else{
	checkfirstname = true;
	checkIfDone()
    }
}

function checkEmail(value){

    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var res = re.test(value);

    if(res == true){

	var instring  = '{"email": "' + value +'"}';    
	var objekt    = JSON.parse(instring);

	$.getJSON("register/ajax/checkEmail.php", objekt)
            .done(function(data) {
		checkEmail_success(data);
	    })
            .fail(function() {
		checkEmail_error();
	    })
            .always(function() {

	    });

    }else{
	checkemail = false;
	checkIfDone();
	alert("Fyll i en giltigt email-adress");
	
	document.getElementById("email").focus();
    }
}

function checkEmail_success(response){

    if(response.status == "OK"){
	checkemail = true;
	checkIfDone();
    }

    if(response.status == "Exists"){
   	alert("email-adressen finns redan");
	checkemail = false;  
	document.getElementById("email").focus(); 
   	checkIfDone();
    }

}

function checkEmail_error(){
    alert("Ett fel med databasen har inträffat. Kontakta administratör om problemet kvarstår.");
}

function checkDay(value){

    if(value == "0"){
	alert("Välj en dag");
	checkday = false;
	checkIfDone();
    }else{
	checkday = true;
	checkIfDone();
    }

}

function checkMonth(value){

    if(value == "0"){
	alert("Välj en månad");
	checkmonth = false;
	checkIfDone();
    }else{
	checkmonth = true;
	checkIfDone();
    }
}

function checkYear(value){
    if(value == "0"){
	alert("Välj ett år");
	checkyear = false;
	checkIfDone();
    }else{
	checkyear = true;
	checkIfDone();
	console.log(value);
    }
}

function checkGender(value){
    if(value == "0"){
	alert("Välj ett kön");
	checkgender = false;
	checkIfDone();
    }else{
	checkgender = true;
	checkIfDone();
	console.log(value);
    }
}


function checkCS(value){
    console.log(value);
    if(value == "0"){
	alert("Välj en kommun");
	checkCitystate = false;
	checkIfDone();
    }else{
	checkCitystate = true;
	checkIfDone();
    }
}


function checkPass(value){

    if(value.length < 8){
	alert("Lösenordet måste innerhålla minst 8 tecken!");
	checkpassword = false;
	checkIfDone();
    }else{
	checkpassword = true;
	checkIfDone();
    }
}
function checkRePass(value){
    var pass = document.getElementById("pword").value;

    if(value == pass){
	checkrepassword = true;
	checkIfDone();
    }else{
	checkrepassword = false;
	alert("Lösenorden stämmer inte överrens. Försök igen." + value + pass);

	checkIfDone();
    }
}

function checkchecked() {
   
    var check = document.getElementById("check");
 
    if(check.checked){
	checked = true;
	checkIfDone();
    }
    else{
	checked = false;
        checkIfDone();
    }
}



function checkIfDone(){
    var done = true;

    if(!checkusername)
	done = false;
    
    if(!checkfirstname)
	done = false;
    
    if(!checkemail)
	done = false;
    if(!checkday)
	done = false;
    
    if(!checkmonth)
	done = false;

    if(!checkyear)
	done = false;
    
    if(!checkgender)
	done = false;
    
    if(!checkCitystate)
	done = false;

    if(!checkpassword)
	done = false;
    if(!checked)
	done = false;
    
    if(!checkrepassword)
        done = false;

    if(done){
	document.getElementById("register").disabled = false; 
    }else{
	document.getElementById("register").disabled = true; 
	
    }
}
