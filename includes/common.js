function escapeSpecialChars(jsonString) {

    return jsonString.replace(/\n/g, "\\n")
        .replace(/\r/g, "\\r")
        .replace(/\t/g, "\\t")
        .replace(/\f/g, "\\f");

}

$(window).on('load', function() {
    var s = "";
    s += '<li class="nav-item" style="top: 10px; width: 100px;">';
    s += '<button type="button" data-toggle="modal" onclick="fetch_notifications()" data-target="#notification_modal" class="btn btn-primary">Händelser <span class="badge" id="notification_num"></span></button>'; 
    s += '</li>';

    document.getElementById("userNavCon").innerHTML += s;

    var instring = '{"user_id" : "' + user_id + '" }';

    var object  = JSON.parse(instring);
    $.getJSON("../ajax/read_unseen_offers.php", object)
        .done(function(data) {
            unseen_offers_success(data);
        })
        .fail(function() {
            alert("Ett fel med notifikationerna har inträffat. Vänligen kontakta administratör om problemet kvarstår.");
        })
        .always(function() {
        })

});

setInterval(function() { 
    var instring = '{"user_id" : "' + user_id + '" }';

    var object  = JSON.parse(instring);
    $.getJSON("../ajax/read_unseen_offers.php", object)
        .done(function(data) {
            unseen_offers_success(data);
        })
        .fail(function() {
            alert("Ett fel med notifikationerna har inträffat. Vänligen kontakta administratör om problemet kvarstår.");
        })
        .always(function() {
        })
}, 3000);


function unseen_offers_success(response){
    
    document.getElementById("notification_num").innerHTML = response.length;
    var s = "";
    
    for(var i = 0; i < response.length; i++){
	    for(var y = 0; y < Companies.company.length; y++){

	        if(Companies.company[y].ID == response[i].CompanyID){
		    s += '<a href="../UseOffer/?Offer='+ response[i].ID +'">';
		    s += '<div class="panel panel-default">';
		    s += '<div class="panel-body">';
		    s += '<div claSs="col-md-4">';
		    s += '<img src="../images/'+ Companies.company[y].Icon +'" style="width: 50px; height: 50px;">';
		    s += '</div>';
		    s += '<div class="col-md-8">';
		    s += '<p style="margin-top: 15px;">'+ Companies.company[y].Name +' har lagt upp ett nytt erbjudande!</p>';
		    s += '</div>';
		    s += '</div>';
		    s += '</div>';
		    s += '</a>';
	    }	    
	}
}
    
    if(response.length == 0) {
        s += "<h3>Du har inga notifikationer för tillfället.</h3>";   
    }
    document.getElementById("notification_body").innerHTML = s;
}

function fetch_notifications() {
    
var instring = '{"user_id" : "' + user_id + '" }';

    var object  = JSON.parse(instring);

    $.getJSON("../ajax/read_unseen_offers.php", object)
        .done(function(data) {
            unseen_offers_success(data);
        })
        .fail(function() {
            alert("Nö könstigt hände");
        })
        .always(function() {
        })


}


	     
