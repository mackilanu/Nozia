$(document).ready(function() {
    document.getElementById("txt_Username").value  = User.info[0].Username;
    document.getElementById("txt_Firstname").value = User.info[0].Fname;
    document.getElementById("txt_Email").value     = User.info[0].Email;
    document.getElementById("txt_Bday").value      = User.info[0].BirthDay;



    if(User.info[0].Gender == 1){

    	document.getElementById("txt_Gender").value = "Man";
    }

   if(User.info[0].Gender == 2){

    	document.getElementById("txt_Gender").value = "Kvinna";
    }

      if(User.info[0].Gender == 3){

    	document.getElementById("txt_Gender").value = "Övrigt";
    }

    document.getElementById("txt_Registered").value = User.info[0].RegisteredDate;



});


function check_Email(){

    var Email = document.getElementById("txt_Email");

 

    if(Email.value == User.info[0].Email){

	alert("Formuläret är oförändrat");
	return;
    }

    var instring  = '{"Email": "'+ Email.value +'"}';
    var objekt    = JSON.parse(instring);

             $.getJSON("ajax/check_Email.php", objekt)
        .done(function(data) {
       check_Email_success(data);
  })
        .fail(function() {
         check_Email_error();
  })
        .always(function() {

  });

}

function check_Email_success(response){

    if(response.status  == "OK"){
        alert("Den valda Email-adressen finns redan i vår databas. Vänligen ange en ny och försök igen.");
	
    }


    if(response.status == "Error"){

        alert("Ett oförutsett fel har inträffat. Om problemet kvartsår, vänligen kontakta administratör.");
    }

    if(response.status == "InUse"){

	update_Email();
    }

}

function check_Email_error(){

    alert("Ett allvarligtt fel har inträffat. Om problemet kvartsår, vänligen kontakta administratör.");

}


function update_Email(){

    var Email = document.getElementById("txt_Email").value;

    var instring  = '{"Email": "'+ Email +'"}';
    var objekt    = JSON.parse(instring);

             $.getJSON("ajax/update_Email.php", objekt)
        .done(function(data) {
       update_Email_success(data);
  })
        .fail(function() {
         update_Email_error();
  })
        .always(function() {

  });   
    

}

function update_Email_success(response){

    if(response.status == "OK"){

	alert("Ändring genomförd.");
    }

    if(response.status == "Error"){

	alert("Ett fel har inträffat. Vänligen kontakta support ifall problemet kvarstår.");
    }

}

function update_Email_error(){

    alert("Ett allvarligt fel har inträffat. Om problemet kvarstår, vänligen kontakta support.");

}

function change_pw(){

    var currentPw  = document.getElementById("pw_current");
    var newPw      = document.getElementById("pw_new");
    var newPwAgain = document.getElementById("pw_newAgain");



    //Checks if the textboxes has been filled.

    if(currentPw.value == ""){
        alert("Du måste fylla i ditt nuvarande lösenord.");
         document.getElementById("pw_current").focus();
        return;
    }

    if(newPw.value == ""){
       alert("Du måste fylla i ditt nya lösenord.");
       document.getElementById("pw_new").focus();
       return;
    }

    if(newPwAgain.value == ""){
        alert("Du måste fylla i ditt nya lösenord igen.");
        document.getElementById("pw_newAgain").focus();
        return;
    }

    //Checks if the new password have enough characters.

    if(newPw.value.length < 8){
        alert("Det nya lösenordet måste innehålla minst 8 tecken.");
        newPwAgain.value = "";
        newPw.focus();
        return;
    }

    if(newPw.value != newPwAgain.value){
        alert("De ifyllda lösenorden stämmer inte överrens med varann.");
        return;
    }


    var instring  = '{"currentPw": "'+ currentPw.value +'"}';
    var objekt    = JSON.parse(instring);

             $.getJSON("ajax/check_currentPw.php", objekt)
        .done(function(data) {
       check_currentPw_success(data);
  })
        .fail(function() {
         check_currentPw_error();
  })
        .always(function() {

  });

}

function check_currentPw_success(response){

    if(response.status == "OK"){
        insert_newPw()
      
    }

    if(response.status == "Error"){
        alert("Ett fel har inträffat. Vänligen försök igen. Om problemet kvarstår vänligen kontakta support.");
    }
    if(response.status == "WrongPw"){

        alert("Du har angett fel nuvarande lösenord.");
    }
}

function check_currentPw_error(){
    alert("Ett allvarligt fel har inträffat. Om problemet kvarstår, vänligen kontakta support.");
}


function insert_newPw(){

    var newPw = document.getElementById("pw_new").value;


    var instring  = '{"newPw": "'+ newPw +'"}';
    var objekt    = JSON.parse(instring);

             $.getJSON("ajax/insert_newPw.php", objekt)
        .done(function(data) {
       insert_newPw_success(data);
  })
        .fail(function() {
         insert_newPw_error();
  })
        .always(function() {

  });


}


function insert_newPw_success(response){

    if(response.status == "OK"){
        alert("Klart!");
    }

    if(response.status == "Error"){
       alert("Ett fel har inträffat. Vänligen försök igen. Om problemet kvarstår vänligen kontakta support.");
    }
}

function insert_newPw_error(){
    alert("Ett allvarligt fel har inträffat. Om problemet kvarstår, vänligen kontakta support.");
}



