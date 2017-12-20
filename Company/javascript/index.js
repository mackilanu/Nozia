$(window).on('load', function() {
    var sponsor = "";
    if(Sponsors != undefined){
    if(Sponsors.status == "OK"){
	for(var i = 0; i < Sponsors.sponsor.length; i++){
	sponsor += '<div class="col-md-4 col-xs-6">';
	sponsor += '<a href="'+ Sponsors.sponsor[i].URL +'"><img src="/images/'+ Sponsors.sponsor[i].Image +'" style="width: 100px; height: 100px; margin-top: 10px;">';
	sponsor += '<h3>'+ Sponsors.sponsor[i].Title +'</h3>';
	sponsor += ' </div>';
	
	document.getElementById("sponsors_div").innerHTML = sponsor;
	}
    }
    }

    //Läser in all  befinlig data och sätter dem på rätt plats. 
    //    document.getElementById("welcome-message").innerHTML = "Visar nu " +  Companies.Company[0].Name;
    document.body.style.backgroundColor = ""+ Foretagssida.foretag[0].BackgroundColor +"";
    document.getElementById('Dis_phone').innerHTML  = '<span class="glyphicon glyphicon-earphone  style="margin-right: 5px;"></span>' +Foretagssida.foretag[0].Telefon;
    document.getElementById('Dis_adress').innerHTML =  '<span class="glyphicon glyphicon-map-marker  style="margin-right: 5px;"></span>' + Foretagssida.foretag[0].Adress;
    document.getElementById('Dis_email').innerHTML  = '<span class="glyphicon glyphicon-envelope" style="margin-right: 5px;"></span>' +Foretagssida.foretag[0].Postnr;
    document.getElementById('iconName').innerHTML   = '<img src="../../images/'+ Companies.Company[0].Icon +'" style="height: auto; width: 200px;">';
    document.getElementById('iconName').innerHTML   += '<p style="text-align:center; font-size: 24pt;">'+ Companies.Company[0].Name +'</p>';
    document.getElementById("CompanyNav").style.backgroundColor = Foretagssida.foretag[0].NavbarColor;
//   document.getElementById('banner').style.backgroundImage = "url('../../images/"+Foretagssida.foretag[0].Banner+"')";

});

$(window).on('load', function() {
    
    var s = "";
    s += "<ul>";

    if(files != undefined){
    if(files.status == "OK"){
	for(var i = 0; i < files.file.length; i++){

	    s += "<li><a href='../images/"+ files.file[i].URL +"'>"+ files.file[i].Caption +"</a></li>";
    }
    }
    }
    s += "</ul>";

    document.getElementById("Files").innerHTML += s;
    if(fav.status == "not_fav"){
	var s = "";

	s += '<button type="button" class="btn btn-default btn-lg" onclick="favorise_company()">';
        s += '<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Favorisera';
	s += '</button>';

	document.getElementById("fav_btn").innerHTML = s;
    }else{
	
	var s = "";

	s += '<button type="button" class="btn btn-success btn-lg" onclick="favorise_company()">';
        s += '<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Favoriserad';
	s += '</button>';

	document.getElementById("fav_btn").innerHTML = s;
    }
    
    var s = "";
    if(Offers.offer == undefined){

	s += "<p>Företaget har inga erbjudanden.</p>";
	return;
    }

   
    	
    if(Offers.status == "OK"){
	for(var i = 0; i < Offers.offer.length; i++){
	var likebtn = '<button class="btn btn-default" onclick="Like('+ Offers.offer[i].ID +')"><span class="glyphicon glyphicon-thumbs-up" id="'+ Offers.offer[i].ID +'"></span>Gilla</button>';

	s += '<div class="panel panel-default">';
	s += '<div class="panel-heading">';
	s += '<a href="/Company/?id='+ Offers.offer[i].CompanyID +'"><img src="/images/'+ Companies.Company[0].Icon +'" style="width: 40px; height: 40px;">';
	s += '<a href="/Company/?id='+ Offers.offer[i].CompanyID +'">';
 	s += '<p style="display: inline; font-size: 12pt;">'+ Companies.Company[0].Name +'</p></a>';
	s += '<p style=" float:right;">'+ Offers.offer[i].Uploaded +'</p>';
	
	s += '</div>';
	
	s += '<div class="panel-body">';
	s += '<p style="font-size: 12pt;">'+ Offers.offer[i].Caption +'</p>';
	s += '<img src="/images/'+ Offers.offer[i].Image +'" style="width: 100%;">';
	s += '<p style="font-size: 12pt; text-align: center;">'+ Offers.offer[i].ShortDes +'</p>';
	s += '</div>';
	
	s += '<div class="panel-footer">';
	s += likebtn
	s += '<p style="display: inline;">'+ Offers.likes[i] +' likes</p>';
	s += '<a href="/UseOffer/?Offer='+ Offers.offer[i].ID +'"><button class="btn btn-success" style="margin-left: 5px;" >Gå till erbjudande</button>';
	s += '</div>';


	
	s += '</div>';
	}
    

    document.getElementById("Offers").innerHTML = s;
    }


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



});


function favorise_company(){
    var Company_id = Company;

    var instring = '{"company_id" : "' + Company_id + '" }';

    var object  = JSON.parse(instring);

    $.getJSON("ajax/favorise.php", object)
        .done(function(data) {
            favorise_company_success(data);
        })
        .fail(function() {
            favorise_company_error();
        })
        .always(function() {
        });
}

function favorise_company_success(response){
    console.log(response);
    if(response.status == "OK"){
	var s = "";

	s += '<button type="button" class="btn btn-success btn-lg" onclick="favorise_company()">';
        s += '<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Favoriserad';
	s += '</button>';

	document.getElementById("fav_btn").innerHTML = s;
    }

    if(response.status == "Removed_fav"){
	var s = "";
	
	s += '<button type="button" class="btn btn-default btn-lg" onclick="favorise_company()">';
        s += '<span class="glyphicon glyphicon-star" aria-hidden="true"></span> Favorisera';
	s += '</button>';
	
	document.getElementById("fav_btn").innerHTML = s;
    }

    if(response.status == "Error"){
	alert("Ett fel inträffade. Om problemet kvarstår vänligen kontakta administratör.");
    }
}

function favorise_company_error(){
    alert("Ett allvarligt fel inträffade. Om problemet kvarstår vänligen kontakta administratör.");
} 

function Like(i){

   
    var Company_id = Company;
    var Offer   = document.getElementById("OfferID" + i).value;

    var instring = '{"User": "' + User + '", "Company": "'+ Company +'", "Offer": "'+ Offer +'"}';

    var objekt = JSON.parse(instring);

    $.getJSON("ajax/like.php", objekt)
        .done(function(data) {
            Like_success(data);
        })
        .fail(function() {
            Like_error();
        })
        .always(function() {

        });
}

function Like_success(response){

    if(response.status == "OK"){
	if(response.type == "add")
	    document.getElementById("btn_"+ response.Offer).style.color = "green";
        if(response.type == "remove")
            document.getElementById("btn_"+ response.Offer).style.color = "black";

    }
    if(response.status == "Error"){
	alert("Ett fel har inträffat, om problemet kvarstår vänligen kontakta support.");
    }
}

function Like_error(){
    alert("Ett allvarligt fel har inträffat, om problemet kvarstår vänligen kontakta support.");
}
