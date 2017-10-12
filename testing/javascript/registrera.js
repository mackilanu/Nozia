

initialize();

function initialize(){
             
      
    $.getJSON("ajax/fetchcountry.php")
        .done(function(data) {
       initialize_success(data);
	})
        .fail(function() {
        initialize_error();
	})
        .always(function() {

	});

}

function fetchCS(){
     $.getJSON("ajax/fetchCS.php")
        .done(function(data) {
       fetchCS_success(data);
	})
        .fail(function() {
    initialize_error();
	})
        .always(function() {

	});
      
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
         for(var i = 0; i <= response.country.length; i++){
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