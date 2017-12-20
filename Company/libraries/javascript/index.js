$(window).on('load', function() { 

  //Läser in all  befinlig data och sätter dem på rätt plats. 
//    document.getElementById("welcome-message").innerHTML = "Visar nu " +  Companies.Company[0].Name;
document.body.style.backgroundImage = "url('../images/"+ Foretagssida.foretag[0].Background +"')";
document.getElementById('Dis_phone').innerHTML  = Foretagssida.foretag[0].Telefon;
document.getElementById('Dis_adress').innerHTML = Foretagssida.foretag[0].Adress;
document.getElementById('Dis_email').innerHTML  = Foretagssida.foretag[0].Postnr;
document.getElementById('iconName').innerHTML   = '<img src="../../images/'+ Companies.Company[0].Icon +'" style="height: auto; width: 200px;">';
document.getElementById('iconName').innerHTML   += '<p style="text-align:center; font-size: 24pt;">'+ Companies.Company[0].Name +'</p>';

document.getElementById('banner').style.backgroundImage = "url('../../images/"+Foretagssida.foretag[0].Banner+"')";

 

//alert(Offers.offer[0].Image);

});

$(window).on('load', function() { 

 
   s = "";
  if(Offers.offer == undefined){

      s += "<p>Företaget har inga erbjudanden.</p>";
      return;
  }

 
    s += '<h3>Senaste erbjudandet</h3>'; 
    s += '<img src= " ../images/'+ Offers.offer[0].Image+'" style="height: 200px; width: 100%;">';	
    s += '<a href="../UseOffer/?Offer='+ Offers.offer[0].ID +'"><p  style="text-align: center; font-size: 16pt; text-decoration: underline;">'+ Offers.offer[0].Caption +'</p></a>';


  document.getElementById("latest_offer").innerHTML = s;



});

$(window).on('load', function() { 

	var s = "";


	if(Post.post != undefined){
        
        var y = "";
	    y    += "<h3 style='color: black;'>"+ Post.post[0].Caption +"</h3>";
		y    += "<p style='color: black;' >"+ Post.post[0].Message + "</p>";
		y    += "<small style='color: black;' font-size: 8pt;'>Uppdaterad "+ Post.post[0].Posted +"</small>";

		document.getElementById("CompanyPost").innerHTML = y;
	}

	if(Offers.status == "NoOffers"){

		s = "<h2>Företaget har för tillfället inga erbjudanden.</h2>";	
		document.getElementById("all_offers").innerHTML = s;
		return;
	}


	for(var i = 0; i < Offers.offer.length; i++){

    s += '<div class="col-md-4">';
    s += '<img src= " ../images/'+ Offers.offer[i].Image+'" style="height: 200px; width: 100%;">';	
    s += '<a href="../UseOffer/?Offer='+ Offers.offer[i].ID +'"><p style="text-align: center; font-size: 16pt; text-decoration: underline;">'+ Offers.offer[i].Caption +'</p></a>';
    s += '</div>';
   
   document.getElementById("all_offers").innerHTML = s;
}

	});
