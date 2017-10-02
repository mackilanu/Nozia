$(window).on('load', function() {
    document.getElementById("welcome-message").innerHTML = "Välj företag";

    var instring  = '{"CS": "'+ CS +'"}';

    var objekt = JSON.parse(instring);

         $.getJSON("ajax/check_offer_cs.php", objekt)
        .done(function(data) {
       check_offer_cs_success(data);
  })
        .fail(function() {
        check_offer_cs_error();
  })
        .always(function() {

  });


	var s = ""; 
         
	if(Companies.status == "NoCompanies"){

		s += "<h1 style='color: black; text-align:center;'>Hittade inga företag.</h1>";
		document.getElementById("main").innerHTML = s;
		return;
	}
   		

	for(var i = 0; i <= Companies.Company.length; i++){

		
		s += '<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 text-center">';
        s += '<div class="square circle-format">';
        s += '<a href="#"><img src="../../images/'+ Companies.Company[i].Icon +'" class="img-responsive" style="width: 100px; height: 100px;" alt="Company Profile Picture"></a>';
                 
        s += '</div>';
        s +=  '</div>';
        s += '<div style="padding-top: 30px; text-align: center;" class="col-lg-4 col-sm-4 col-md-4 col-xs-4 text-left">';
        s +=  '<h3 class="company-name">'+ Companies.Company[i].Name +'</h3>';
                
        s +=    '</div>';

        s += '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="padding-top: 30px;">';
            
        s +=  '<a href="../Company/?id='+ Companies.Company[i].ID +'"  target="_blank"rel="noopener norefferer"> <input style="height: 50px; width: 50px;"  type="submit" value="visa" class="btn btn-success" id="button"></a>';
        
        s += '</div>';

        s += '<div style="margin: auto; text-align:center;" class="col-lg-12 col-sm-12 col-xs-12"><small  margin-top: 10px;><b><b></small><hr></div>';
      
         document.getElementById("main").innerHTML = s;

	
 
}
});

function check_offer_cs_success(response){

    if(response.status == "OK"){
	//read_Offers(response.OfferCS);
    }

   

}


function  check_offer_cs_error(){

   alert("Ett allvarligt fel har inträffat. Om problemet kvarstår, vänligen kontakta support.");
}


// function read_Offers(response){

 
//     var instring  = '{"Offer": "'+ response +'"}';

//     var objekt = JSON.parse(instring);

//          $.getJSON("ajax/check_offer.php", objekt)
//         .done(function(data) {
//        read_Offers_success(data);
//   })
//         .fail(function() {
//         read_Offers_error();
//   })
//         .always(function() {

//   });
    


// }


// function read_Offers_success(response){

//     if(response.status == "OK"){

// 	alert(response);
//     }
    

// }

// function read_Offers_error(){

//   alert("Ett allvarligt fel har inträffat. Om problemet kvarstår, vänligen kontakta support.");
// }
