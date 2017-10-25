$(document).ready(function() {
  document.getElementById("btn-container").innerHTML = "Använd erbjudande";
  var s = "";
  if (MyOffer.offer[0].Used == 1) {
    s += '<button class="btn btn-lg btn-default pagination-centered" style="text-align: center;" id="btn_Used">Du har redan använt erbjudandet.</button>';
    document.getElementById("btn-container").innerHTML = s
    return;
  }
  if (Dagens < Offers.offer[0].StartDate) {
    s += '<button  class="btn btn-lg btn-danger pagination-centered" id="btn_NotStarted" style="text-align: center;">Erbjudandet har inte påbörjats</button>';
    document.getElementById("btn-container").innerHTML = s
    return;
  }
  if (Dagens > Offers.offer[0].DueDate) {
    s += '<button  class="btn btn-lg btn-danger pagination-centered" style="text-align: center;" id="btn_Due" style="text-align: center;">Erbjudandet har gått ut</button>';
    document.getElementById("btn-container").innerHTML = s
    return;
  }
  s += '<button class="btn btn-lg btn-success pagination-centered" style="text-align: center;" id="btn_Use" onclick="UseOffer()"  data-toggle="modal" data-target="#myModal">Använd erbjudandet</button>';
  document.getElementById("btn-container").innerHTML = s;
});

function UseOffer() {
  var s = "";
  s += "<p style='text-align: center;'>Användare: " + User.user[0].Fname + "</p>";
  s += "<p style='text-align: center;'>Användar id: " + User.user[0].ID + "</p>";
  s += "<p style='text-align: center;'>Erbjudande: " + Offers.offer[0].Caption + "</p>";
  s += "<p style='text-align: center;'>Startdatum: " + Offers.offer[0].StartDate + "</p>";
  s += "<p style='text-align: center;'>Slutdatum: " + Offers.offer[0].DueDate + "</p>";
  s += "<div class='col-md-5 col-xs-5'></div>";
  s += "<div id='btn_use'><button class='btn btn-lg btn-success' style='margin-top: 20px;' onclick='Update_MyOffer()'>Använd</button></div>";
  document.getElementById("UseOffer_con").innerHTML = s;
}
$(document).ready(function() {
  document.getElementById("p_StartDate").innerHTML += Offers.offer[0].StartDate;
  document.getElementById("p_DueDate").innerHTML += Offers.offer[0].DueDate;
  if (MyOffer.offer[0].Used == 0) {
    document.getElementById("p_Used").innerHTML += "Nej";
  } else {
    document.getElementById("p_Used").innerHTML += "Ja";
  }
  document.getElementById("main_jumb").innerHTML += "<h2 style='font-size: 14pt;'>" + Offers.offer[0].Caption + "</h2>";
  document.getElementById("main_jumb").innerHTML += "<img style='max-width: 500px;max-heigth: 500px;' src='../images/" + Offers.offer[0].Image + "'>";
  document.getElementById("main_jumb").innerHTML += "<p style='font-size: 12pt;'>" + Offers.offer[0].ShortDes + "</p>";
});

function Update_MyOffer() {
  var OfferID = Offers.offer[0].ID;
  var UserID = User.user[0].ID;
  var instring = '{"Offer": "' + OfferID + '", "User": "' + UserID + '"}';
  var objekt = JSON.parse(instring);
  $.getJSON("ajax/Update_MyOffer.php", objekt)
    .done(function(data) {
      Update_MyOffer_success(data);
    })
    .fail(function() {
      Update_MyOffer_error();
    })
    .always(function() {
    });
}

function Update_MyOffer_success(response) {
  if(response.status == "OK") {
     document.getElementById("btn-container").innerHTML = '<button class="btn btn-lg btn-default pagination-centered" style="text-align: center;" id="btn_Used">Du har redan använt erbjudandet.</button>';
     document.getElementById("p_Used").innerHTML = "Använd: Ja";
     document.getElementById("btn_use").innerHTML = "<button class='btn btn-lg btn-danger' style='margin-top: 20px;'>Erbjudande använt</button>"
  }
  if (response.status == "Error") {
    alert("Ett fel har inträffat. Om problemet kvarstår vänligen kontakta support");
  }
}

function Update_MyOffer_error() {
  alert("Ett allvarligt fel har inträffat. Om problemet kvarstår vänligen kontakta support");
}
