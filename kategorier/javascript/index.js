var pageNum = 1;
var stop = false;
var OnlyFavs = "No";
var exclude = new Array();
var display_favs = false;
var allowedOffers = [];

$(window).on('load', function() { 

    //Puts all avaliable categories in the select country element. 
    
    var s = "";

    s += '<li class="nav-item">';
    s += '<a id="display_favs" onclick="display_favorites()"><span id="glyph_star" class="glyphicon glyphicon-star-empty"></span></a>';
    s += '</li>';
    s += '<li class="nav-item" style="top: 10px; width: 100px;">';
    s += '<select class="form-control selectpicker" data-live-search="true" id="pick_Category" style="width: 50px;"  onchange="get_offers(this.value)"></select>';
    s += '</li>';
    s += '<li class="nav-item" style="top: 10px; width: 100px;">';
    s += '<select class="form-control selectpicker" data-live-search="true" id="pick_CS" style="width: 50px;" style=  onchange="fetch_categories(this.value)"></select>';
    s += '</li>';
    
    document.getElementById("userNavCon").innerHTML += s;

    var s = "";
    var instring = '{"pageNum": "' + pageNum + '", "OnlyFavs": "'+ OnlyFavs+'"}';
    
    var objekt = JSON.parse(instring);
    
    $.getJSON("ajax/fetch_offers.php", objekt)
        .done(function(data) {
            fetch_offer_success(data);
        })
        .fail(function() {
            fetch_offer_error();
        })
        .always(function() {
            
        });

    for (var i = 0; i < kommun.CS.length; i++) {
	
	s += "<option value='"+ kommun.CS[i].ID +"'";
	
	if(kommun.CS[i].ID == CS)
	    s += "selected";
	
	s += '>'+ kommun.CS[i].CityState +'</option>';
	
    }

    document.getElementById("pick_CS").innerHTML = s;

    var s = "";

   s += "<option value='-1'>Visa alla</option>";

   for(var i = 0; i < Categories.Category.length; i++){

   		s += "<option value='"+ Categories.Category[i].CatgoryID +"'>"+ Categories.Category[i].Caption +"</option>";
   }
   document.getElementById("pick_Category").innerHTML = s;

});


function get_offers(val) {
  
	var instring = '{"Category": "'+ val +'"}';

	var objekt = JSON.parse(instring);

	$.getJSON("ajax/get_offers.php", objekt)
            .done(function(data) {
		get_offers_success(data);
            })
            .fail(function() {
		get_offers_error();
            })
            .always(function() {
		
            });		

}

function get_offers_success(response){

    var s = "";
	if(response.status == "NoOffers"){
		s += "<h1>Det finns inga erbjudanden enligt valda kriterier</h1>";
	}
	if(response.status == "NoCompanies"){
		s += "<h1>Det finns inga företag enligt valda kriterier</h1>"; 
	}
	if(response.status == "Error"){
		s += "<h1>Ett fel har inträffat. vänligen kontakta support om problemet kvarstår.</h1>";
	}

	if(response.status == "OK"){
		if(allowedOffers.length > 0)
			allowedOffers.length = 0;

		for(var i = 0; i < response.offers.length; i++){

			allowedOffers[allowedOffers.length] = response.offers[i].ID;
		}
	  
	}
	document.getElementById("main_con").innerHTML = s;
}

function start() {
	pageNum = 1;
    var instring = '{"pageNum": "' + pageNum + '", "OnlyFavs": "'+ OnlyFavs+'"';
	if(allowedOffers.length > 0) {
      instring += ', "AllowedOffers": ['+ allowedOffers +']';
	}
	instring += '}';
    
  

    var objekt = JSON.parse(instring);

    $.getJSON("ajax/fetch_offers.php", objekt)
        .done(function(data) {
            start_success(data);
        })
        .fail(function() {
            start_error();
        })
        .always(function() {
            
        });
}

function start_success(response){

	console.log(response);
return;
    if(response.status == "Error")
	alert("Ett fel inträffade.");

    if(response.status == "NoSubs"){
	document.getElementById("main_con").innerHTML = "<h1>Det finns inga inlägg att visa. Ändra dina filtreringar och försök igen.</h1>";
    }

    if(response.status == "Done")
	stop = true;

    if(response.status == "OK"){
	if(pageNum == parseInt(response.page)){
	    return;
	}

	pageNum = response.page;

	var name;
	var Icon;
	var check = true;

	

	if(likes.status == "Error"){
  	    var check = false;
	}
	
	for(var i = 0; i < response.offer.length; i++){
	    var likebtn = '<a id="btn_'+ response.offer[i].ID +'" onclick="Like('+ response.offer[i].ID +')"><span class="glyphicon glyphicon-thumbs-up"></span>Gilla</a>';
	    if(check == true){
    		for(var y = 0; y < likes.like.length; y++){
    		    
      		    if(response.offer[i].ID == likes.like[y].PostID){
      			likebtn = '<button class="btn btn-default" id="btn_'+ response.offer[i].ID +'" onclick="Like('+ response.offer[i].ID +')" style="color: green;"><span class="glyphicon glyphicon-thumbs-up"></span>Gilla</button>';
      		    }
		}
	    }
	    
	    var split = response.likes[0].split(",");
	    
	    for(var y = 0; y < Companies.company.length; y++){
		
		if(response.offer[i].CompanyID == Companies.company[y].ID){
      		    name = Companies.company[y].Name;
      		    Icon = Companies.company[y].Icon
		}
		
		var s = "";
		
		s += '<div class="panel panel-default">';
		s += '<div class="panel-heading">';
		s += '<a href="/Company/?id='+ response.offer[i].CompanyID +'" target="_blank"><img src="/images/'+ Icon +'" style="width: 40px; height: 40px;">';
		s += '<p style="display: inline; font-size: 12pt;">'+ name +'</p></a>';
		s += '<p style=" float:right;">'+ response.offer[i].Uploaded +'</p>'; 
		s += '</div>';
		s += '<div class="panel-body">';
		s += '<p style="font-size: 12pt;">'+ response.offer[i].Caption +'</p>';
		s += '<img src="/images/'+ response.offer[i].Image +'" style="width: 100%;">';
		s += '<p style="font-size: 12pt; text-align: center;">'+ response.offer[i].ShortDes +'</p>';
		s += '</div>';
		s += '<div class="panel-footer">';

		s += likebtn
		s += '<p style="display: inline;">'+ split[i] +' likes</p>';
		s += '<a class="btn btn-default btn_fav'+ response.offer[i].CompanyID+'"  value="'+ response.offer[i].CompanyID +'" onclick="Favorise('+ response.offer[i].ID +')"><span class="glyphicon glyphicon-star-empty"></span>Favorisera</a>';
		s += '<a href="/UseOffer/?Offer='+ response.offer[i].ID +'"><button class="btn btn-success" style="margin-left: 5px;" >Gå till erbjudande</button>';
		s += '</div>';
		s += '</div>';

		s += "<input type='hidden' id='CompanyID"+ response.offer[i].ID +"' value='"+ response.offer[i].CompanyID +"'>";
		s += "<input type='hidden' id='OfferID"+ response.offer[i].ID +"' value='"+ response.offer[i].ID +"'>";

	    }

	    document.getElementById("main_con").innerHTML = s;
	
	}
	init_read_favs();
    }
}


function init(){

    var instring = '{"pageNum": "' + pageNum + '", "OnlyFavs": "'+ OnlyFavs+'"}';

    var objekt = JSON.parse(instring);

    $.getJSON("ajax/fetch_offers.php", objekt)
        .done(function(data) {
            fetch_offer_success(data);
        })
        .fail(function() {
            fetch_offer_error();
        })
        .always(function() {
            
        });    
}

function display_favorites() {
    
    //If the user has activated the "show favorite companies" function, the if statement below does the opposit, which is showing the normal news feed.
    if(display_favs == true){
	document.getElementById("glyph_star").style.color = "grey";
	init();
	display_favs = false;
	return;
    }else{
	document.getElementById("glyph_star").style.color = "yellow";
    }
    var instring = '{"user_id" : "' + user_id + '" }';
    
    var object  = JSON.parse(instring);
    
    $.getJSON("ajax/display_favs.php", object)
        .done(function(data) {
            display_favorites_success(data);
        })
        .fail(function() {
            display_favorites_error();
        })
        .always(function() { 
        });
}

function display_favorites_success(response) {
 
    display_favs = true;
    
    document.getElementById("display_favs").style.color = "yellow";
    if(response.status == "Error") {
	alert("Ett fel inträffade");
	return;
    }
    
    if(response.status == "no_favs"){
	alert("Du har inga favoritföretag!");
	return;
    }
    //Om allt i ajax-anropet gick bra körs detta
    pageNum = 1;
    stop = false;
    var name;
    var Icon;
    var check = true;
    var likebtn;
    
    if(likes.status == "Error"){
	var check = false;
    }
    
    var s = "";
    for(var i = 0; i < response.favs.length; i++) {
	exclude[exclude.length] = response.favs[i].ID;
	var likebtn = '<a id="btn_'+ response.favs[i].ID +'" onclick="Like('+ response.favs[i].ID +')"><span class="glyphicon glyphicon-thumbs-up"></span>Gilla</a>';
	
        for(var y = 0; y < Companies.company.length; y++){
            
            if(response.favs[i].CompanyID == Companies.company[y].ID){
                name = Companies.company[y].Name;
                Icon = Companies.company[y].Icon;
            }
	}

        if(check == true){
            for(var y = 0; y < likes.like.length; y++){
                
		if(response.favs[i].ID == likes.like[y].PostID){
		    likebtn = '<button class="btn btn-default" id="btn_'+ response.favs[i].ID +'" onclick="Like('+ response.favs[i].ID +')" style="color: green;"><span class="glyphicon glyphicon-thumbs-up"></span>Gilla</button>';
		}
	    }
	}

	var split = response.likes[i];
        
	

	s += '<div class="panel panel-default">';
	s += '<div class="panel-heading">';
	s += '<a href="/Company/?id='+ response.favs[i].CompanyID +'" target="_blank"><img src="/images/'+ Icon +'" style="width: 40px; height: 40px;">';
	s += '<a href="/Company/?id='+ response.favs[i].CompanyID +'" target="_blank">';
 	s += '<p style="display: inline; font-size: 12pt;">'+ name +'</p></a>';
	s += '<p style=" float:right;">'+ response.favs[i].Uploaded +'</p>'; 
	s += '</div>';
	s += '<div class="panel-body">';
	s += '<p style="font-size: 12pt;">'+ response.favs[i].Caption +'</p>';
	s += '<img src="/images/'+ response.favs[i].Image +'" style="width: 100%;">';
	s += '<p style="font-size: 12pt; text-align: center;">'+ response.favs[i].ShortDes +'</p>';
	s += '</div>';
	s += '<div class="panel-footer">';
	s += likebtn
	s += '<p style="display: inline;">'+ split +' likes</p>';
	s += '<a class="btn btn-default btn_fav'+ response.favs[i].CompanyID+'"  value="'+ response.favs[i].CompanyID +'" onclick="Favorise('+ response.favs[i].ID +')"><span class="glyphicon glyphicon-star-empty"></span>Favorisera</a>';
	s += '<a href="/UseOffer/?Offer='+ response.favs[i].ID +'"><button class="btn btn-success" style="margin-left: 5px;" >Gå till erbjudande</button>';
	s += '</div>';
	s += '</div>';
	
	s += "<input type='hidden' id='CompanyID"+ response.favs[i].ID +"' value='"+ response.favs[i].CompanyID +"'>";
	s += "<input type='hidden' id='OfferID"+ response.favs[i].ID +"' value='"+ response.favs[i].ID +"'>";
		
	pageNum = 1;

	document.getElementById("main_con").innerHTML = s;
	
        if(response.favs.length == 1){
            init();    
	}
	
	

	console.log(response);
    }
    console.log(exclude);
}

function display_favorites_error() {
    alert("Ett allvarligt fel inträffade.");
}


function fetch_favs_offers(){
    OnlyFavs = "Yes";
}

function fetch_favs_offers_success(response){

}



function fetch_offer_success(response){
    if(response.status == "Error")
	alert("Ett fel inträffade.");

    if(response.status == "NoSubs"){
	document.getElementById("main_con").innerHTML = "<h1>Det finns inga inlägg att visa. Ändra dina filtreringar och försök igen.</h1>";
    }

    if(response.status == "Done")
	stop = true;

    if(response.status == "OK"){
	if(pageNum == parseInt(response.page)){
	    return;
	}

		document.getElementById("main_con").innerHTML = "";

	pageNum = response.page;

	var name;
	var Icon;
	var check = true;

	

	if(likes.status == "Error"){
  	    var check = false;
	}
	
	for(var i = 0; i < response.offer.length; i++){
	    var likebtn = '<a id="btn_'+ response.offer[i].ID +'" onclick="Like('+ response.offer[i].ID +')"><span class="glyphicon glyphicon-thumbs-up"></span>Gilla</a>';
	    if(check == true){
    		for(var y = 0; y < likes.like.length; y++){
    		    
      		    if(response.offer[i].ID == likes.like[y].PostID){
      			likebtn = '<button class="btn btn-default" id="btn_'+ response.offer[i].ID +'" onclick="Like('+ response.offer[i].ID +')" style="color: green;"><span class="glyphicon glyphicon-thumbs-up"></span>Gilla</button>';
      		    }
		}
	    }
	    
	    var split = response.likes[0].split(",");
	    
	    for(var y = 0; y < Companies.company.length; y++){
		
		if(response.offer[i].CompanyID == Companies.company[y].ID){
      		    name = Companies.company[y].Name;
      		    Icon = Companies.company[y].Icon
		}
		
		var s = "";
		
		s += '<div class="panel panel-default">';
		s += '<div class="panel-heading">';
		s += '<a href="/Company/?id='+ response.offer[i].CompanyID +'" target="_blank"><img src="/images/'+ Icon +'" style="width: 40px; height: 40px;">';
		s += '<p style="display: inline; font-size: 12pt;">'+ name +'</p></a>';
		s += '<p style=" float:right;">'+ response.offer[i].Uploaded +'</p>'; 
		s += '</div>';
		s += '<div class="panel-body">';
		s += '<p style="font-size: 12pt;">'+ response.offer[i].Caption +'</p>';
		s += '<img src="/images/'+ response.offer[i].Image +'" style="width: 100%;">';
		s += '<p style="font-size: 12pt; text-align: center;">'+ response.offer[i].ShortDes +'</p>';
		s += '</div>';
		s += '<div class="panel-footer">';

		s += likebtn
		s += '<p style="display: inline;">'+ split[i] +' likes</p>';
		s += '<a class="btn btn-default btn_fav'+ response.offer[i].CompanyID+'"  value="'+ response.offer[i].CompanyID +'" onclick="Favorise('+ response.offer[i].ID +')"><span class="glyphicon glyphicon-star-empty"></span>Favorisera</a>';
		s += '<a href="/UseOffer/?Offer='+ response.offer[i].ID +'"><button class="btn btn-success" style="margin-left: 5px;" >Gå till erbjudande</button>';
		s += '</div>';
		s += '</div>';

		s += "<input type='hidden' id='CompanyID"+ response.offer[i].ID +"' value='"+ response.offer[i].CompanyID +"'>";
		s += "<input type='hidden' id='OfferID"+ response.offer[i].ID +"' value='"+ response.offer[i].ID +"'>";

	    }
	
	    document.getElementById("main_con").innerHTML += s;
	}
	
	init_read_favs();
    }
}


function init_read_favs(){
    var User = user_id;
    var instring = '{"User": "' + User + '"}';

    var objekt = JSON.parse(instring);

    $.getJSON("ajax/read_favs.php", objekt)
        .done(function(data) {
            init_read_favs_success(data);
        })
        .fail(function() {
            init_read_favs_error();
        })
        .always(function() {
            
        });	

}

function init_read_favs_success(response){
    
    if(response.status == "OK"){
	
        for(var i = 0; i < response.subs.length; i++){       
	    var btns = document.getElementsByClassName("btn_fav"+ response.subs[i].CompanyID);
	    
            for(var y = 0; y < btns.length; y++){
        	btns[y].style.color = "green";
            }
	}

	if(response.status == "Error")
	    alert("Ett fel har inträffat, om problemet kvarstår vänligen kontakta support.");

    }
}

function init_read_favs_error(){
    alert("Ett allvarligt fel har inträffat, om problemet kvarstår vänligen kontakta support.");
}

function Favorise(id){
    var CompanyID = document.getElementById("CompanyID"+ id).value;
    var User      = user_id;

    var instring = '{"User": "' + User + '", "Company": "'+ CompanyID +'"}';

    var objekt = JSON.parse(instring);

    $.getJSON("ajax/favorise.php", objekt)
        .done(function(data) {
            Favorise_success(data);
        })
        .fail(function() {
            Favorise_error();
        })
        .always(function() {
            
        });
}

function Favorise_success(response){

    if(response.status == "OK"){
        var btns = document.getElementsByClassName("btn_fav"+ response.Company);
	
        for(var i = 0; i < btns.length; i++){
            btns[i].style.color = "green";
        }
    }

    if(response.status == "AlreadyExists")
	alert("Du har redan lagt till företaget!");

    if(response.status == "Error")
        alert("Ett fel har inträffat, om problemet kvarstår vänligen kontakta support.");
}

function Favorise_error(){
    alert("Ett allvarligt fel har inträffat, om problemet kvarstår vänligen kontakta support.");
}

function read_favourites(){

    var User = user_id;
    var instring = '{"User": "' + User + '"}';

    var objekt = JSON.parse(instring);

    $.getJSON("ajax/read_favs.php", objekt)
        .done(function(data) {
            read_favourites_success(data);
        })
        .fail(function() {
            read_favourites_error();
        })
        .always(function() {
            
        });
}

function read_favourites_success(response){

    if(response.status == "OK"){
	var s = "";
	for(var i = 0; i < response.subs.length; i++){
	    for(var y = 0; y < Companies.company.length; y++){

		if(Companies.company[y].ID == response.subs[i].CompanyID){
		    s += '<div class="panel panel-default">';
		    s += '<div class="panel-body">';
		    s += '<a href="/Company/?id='+ Companies.company[y].ID +'" target="_blank"><img src="/images/'+ Companies.company[y].Icon +'" style="width: 50px; height: 50px;">';
		    s += '<p style="display: inline; font-size: 14pt; margin-left: 20px;" >'+Companies.company[y].Name +'</p></a>';
		    s += '<button class="btn btn-danger" style="float: right;" onclick="RemoveFav('+ y +')">Ta bort</button>';
		    s += '</div>';
		    s += '</div>';

		    s += '<input type="hidden" id="Company'+ y +'" value="'+ Companies.company[y].ID  +'">';
		}
	    }
	}

        document.getElementById("modal_favs").innerHTML = s;
        if(response.company.length == 1)
	    init();
    }
    if(response.status == "NoSubs"){
	var s = "";

	s += "<h1>Du har inte några favoritföretag för tillfället.</h1>";

	document.getElementById("modal_favs").innerHTML = s;
    }
    

    if(response.status == "Error")
	alert("Ett fel har inträffat, om problemet kvarstår vänligen kontakta support.");

}

function read_favourites_error(){
    alert("Ett allvarligt fel har inträffat, om problemet kvarstår vänligen kontakta support.");
}

function RemoveFav(y){

    var conf = confirm("Är du säker på att du vill sluta favorisera företaget?");

    if(conf == false)
	return;

    var User = user_id;
    var Company = document.getElementById("Company"+ y).value;

    var instring = '{"User": "' + User + '", "Company": "'+ Company +'"}';

    var objekt = JSON.parse(instring);

    $.getJSON("ajax/Remove_Fav.php", objekt)
        .done(function(data) {
            RemoveFav_success(data);
        })
        .fail(function() {
            RemoveFav_error();
        })
        .always(function() {
            
        });
}

function RemoveFav_success(response){

    if(response.status == "OK")
	read_favourites();
    
    if(response.status == "Error")
    	alert("Ett fel har inträffat, om problemet kvarstår vänligen kontakta support.");
}

function RemoveFav_error(){

    alert("Ett allvarligt fel har inträffat, om problemet kvarstår vänligen kontakta support.");
}
function Like(i){

    var User = user_id;
    var Company = document.getElementById("CompanyID" + i).value;
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


function fetch_offer_error(){
    alert("Ett allvarligt fel har inträffat, vänligen kontakta support om problemet kvarstår.");
}


$( document ).ready(function() {

    $('.selectpicker').selectpicker('refresh');

    var s = "";
    var y = document.getElementById("pick_CS").value;

    for(var i = 0; i < Categories.Category.length; i++){

    	s += '<div class="col-md-4"><a href="/companies/?id='+ y +'&category='+ Categories.Category[i].CatgoryID +'">'+ Categories.Category[i].Caption +'</a></div>'

        document.getElementById("CS").innerHTML = s;

    }

});

function fetch_categories(value){

    var s = "";

    for(var i = 0; i < Categories.Category.length; i++){

    	s += '<div class="col-md-4"><a href="/companies/?id='+ value +'&category='+ Categories.Category[i].CatgoryID +'">'+ Categories.Category[i].Caption +'</a></div>';
        document.getElementById("CS").innerHTML = s;  
    }

}



