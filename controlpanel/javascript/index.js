
function change_navbar() {
    document.getElementById("btn_navbar").style.backgroundColor = "#ff0000";
    document.getElementById("btn_navbar").style.color = "#FFF";

    document.getElementById("btn_icon").style.backgroundColor = "#FFF";
    document.getElementById("btn_icon").style.color = "#2F4F4F";

    document.getElementById("btn_offers").style.backgroundColor = "#FFF";
    document.getElementById("btn_offers").style.color = "#2F4F4F";

    document.getElementById("btn_info").style.backgroundColor = "#FFF";
    document.getElementById("btn_info").style.color = "#2F4F4F";

    document.getElementById("btn_blog").style.backgroundColor = "#FFF";
    document.getElementById("btn_blog").style.color = "#2F4F4F";

    document.getElementById("btn_bg").style.backgroundColor = "#FFF";
    document.getElementById("btn_bg").style.color = "#2F4F4F";

    document.getElementById("btn_files").style.backgroundColor = "#FFF";
    document.getElementById("btn_files").style.color = "#2F4F4F";

    document.getElementById("btn_banner").style.backgroundColor = "#FFF";
    document.getElementById("btn_banner").style.color = "#2F4F4F";

    
    var instring = '{"CompanyID": "' + ID + '"}';
    var objekt = JSON.parse(instring);

    $.getJSON("ajax/get_navbar.php", objekt)
        .done(function(data) {
            get_navbar_success(data);
        })
        .fail(function() {
            get_navbar_error();
        })
        .always(function() {

        });
}

function get_navbar_success(response) {

        var s = "";
   
    s += '<label for="example-color-input" class="col-2 col-form-label">Bakgrundsfärg</label>';
    s += '<div class="col-10">';
    s += '<input class="form-control" type="color" value="'+ response.color +'" id="NavbarColor"><br>';
    s +='</div>';
    s += '<div id="update_Navbar_msg" class="alert alert-success"><strong>Färgen är nu ändrad.</strong></div>';

     s += '<button type="submit" id="Bg_btn" class="btn btn-success" onclick="update_NavbarColor()">Bekräfta</button>';
 
       if(response.status == "Error"){
        alert("Ett fel har inträffat. Vänligen kontakta support om problemet kvarstår.");
        s = "Error";
    }

    document.getElementById("main").innerHTML = s;
    $("#update_Navbar_msg").hide();
}

function get_navbar_error() {

    alert("Ett allvarligt fel har inträffat. Vänligen kontakta support om problemet kvarstår.");
}

function update_NavbarColor() {
    
    var Color = document.getElementById("NavbarColor").value;
    var instring = '{"Color": "' + Color + '", "ID": "'+ ID +'"}';
    var objekt = JSON.parse(instring);

    $.getJSON("ajax/update_navbar.php", objekt)
        .done(function(data) {
            update_navbar_success(data);
        })
        .fail(function() {
            update_navbar_error();
        })
        .always(function() {
	    
        });
}

function update_navbar_success(response) {

    if(response.status == "OK"){
	 $("#update_Navbar_msg").show();
    }

    if(response.status == "Error"){
	 alert("Ett fel har inträffat. Vänligen kontakta support om problemet kvarstår.");
    }
}

function update_navbar_error() {
     alert("Ett allvarligt fel har inträffat. Vänligen kontakta support om problemet kvarstår.");
}

function change_banner() {


    document.getElementById("btn_banner").style.backgroundColor = "#ff0000";
    document.getElementById("btn_banner").style.color = "#FFF";

    document.getElementById("btn_icon").style.backgroundColor = "#FFF";
    document.getElementById("btn_icon").style.color = "#2F4F4F";

    document.getElementById("btn_offers").style.backgroundColor = "#FFF";
    document.getElementById("btn_offers").style.color = "#2F4F4F";

    document.getElementById("btn_info").style.backgroundColor = "#FFF";
    document.getElementById("btn_info").style.color = "#2F4F4F";

    document.getElementById("btn_blog").style.backgroundColor = "#FFF";
    document.getElementById("btn_blog").style.color = "#2F4F4F";

    document.getElementById("btn_bg").style.backgroundColor = "#FFF";
    document.getElementById("btn_bg").style.color = "#2F4F4F";

    document.getElementById("btn_files").style.backgroundColor = "#FFF";
    document.getElementById("btn_files").style.color = "#2F4F4F";

    document.getElementById("btn_navbar").style.backgroundColor = "#FFF";
    document.getElementById("btn_navbar").style.color = "#2F4F4F";

    var s = "";
    s += '<form enctype="multipart/form-data" method="post" action="ajax/uploadbanner.php" id="bannerform">';
    s += '<input name="file" type="file"><br>';
    s += '<input type="submit" id="banner_btn" name="submit" class="btn btn-success" value="Ladda upp" />';
    s += '</form><br>';
    s += '<div id="banner_msg" class="alert alert-success"><strong>Bannern är nu upplagd!</strong></div>';
    s += '<div class="progress" id="bannerbar">';
    s += '<div class="progress-bar progress-bar-striped active" id="bannerprogress" role="progressbar"';
    s += 'aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">';
    s += '<span id="bannerprogressText" class="sr-only">0%</span>';
    s += '</div>';
    s += '</div>';
    s += '<h3 style="color: black;">Nuvarande banner:</h3>';
    s += "<div class='jumbotron' id='banner_image' style='height: 200px; margin-top: 30px;'>";

    s += '</div>';




    document.getElementById("main").innerHTML = s;

    document.getElementById("banner_image").style.backgroundImage = "url('../images/" + Foretagssida.foretag[0].Banner + "')";

    $("#bannerbar").hide();
    $("#banner_msg").hide();

    $(function() {

        $("#bannerform").ajaxForm({

            beforeSend: function() {

                $("#bannerbar").show();
            },
            uploadProgress: function(event, position, total, percentComplete) {

                $("#bannerprogress").width(percentComplete + '%');

            },
            success: function() {
                $("#banner_msg").show();
                $("#bannerbar").hide();
            },
            complete: function(response) {
                if (response.responseText != "Error" || response.responseText != "ToBig") {
                    document.getElementById("banner_image").style.backgroundImage = "url('../images/" + response.responseText + "')";
                    Foretagssida.foretag[0].Banner = "../images/" + response.responseText;
                }

            }

        });



    });
}

function change_background() {


    document.getElementById("btn_bg").style.backgroundColor = "#ff0000";
    document.getElementById("btn_bg").style.color = "#FFF";

    document.getElementById("btn_banner").style.backgroundColor = "#FFF";
    document.getElementById("btn_banner").style.color = "#2F4F4F";

    document.getElementById("btn_offers").style.backgroundColor = "#FFF";
    document.getElementById("btn_offers").style.color = "#2F4F4F";

    document.getElementById("btn_info").style.backgroundColor = "#FFF";
    document.getElementById("btn_info").style.color = "#2F4F4F";

    document.getElementById("btn_blog").style.backgroundColor = "#FFF";
    document.getElementById("btn_blog").style.color = "#2F4F4F";

    document.getElementById("btn_icon").style.backgroundColor = "#FFF";
    document.getElementById("btn_icon").style.color = "#2F4F4F";

    document.getElementById("btn_files").style.backgroundColor = "#FFF";
    document.getElementById("btn_files").style.color = "#2F4F4F";

    document.getElementById("btn_navbar").style.backgroundColor = "#FFF";
    document.getElementById("btn_navbar").style.color = "#2F4F4F";

    var instring = '{"CompanyID": "' + ID + '"}';
    var objekt = JSON.parse(instring);

    $.getJSON("ajax/get_background.php", objekt)
        .done(function(data) {
            get_background_success(data);
        })
        .fail(function() {
            get_background_error();
        })
        .always(function() {

        });
}

function get_background_success(response) {
    var s = "";
   
    s += '<label for="example-color-input" class="col-2 col-form-label">Bakgrundsfärg</label>';
    s += '<div class="col-10">';
    s += '<input class="form-control" type="color" value="'+ response.color +'" id="BgColor"><br>';
    s +='</div>';
    s += '<div id="update_BgColor_msg" class="alert alert-success"><strong>Färgen är nu ändrad.</strong></div>';

     s += '<button type="submit" id="Bg_btn" class="btn btn-success" onclick="update_BgColor()">Bekräfta</button>';
 
       if(response.status == "Error"){
        alert("Ett fel har inträffat. Vänligen kontakta support om problemet kvarstår.");
        s = "Error";
    }

    document.getElementById("main").innerHTML = s;
    $("#update_BgColor_msg").hide();
}
function get_background_error() {

    alert("Ett allvarligt fel har inträffat. Vänligen kontakta support om problemet kvarstår.");
}

function update_BgColor(){

    var BgColor = document.getElementById("BgColor").value;
    var id = ID;
    
    var instring = '{"Color": "' + BgColor + '", "ID": "'+ id +'"}';
    var objekt = JSON.parse(instring);
  
    $.getJSON("ajax/update_BackgroundColor.php", objekt)
        .done(function(data) {
           update_BgColor_success(data);
        })
        .fail(function() {
            update_BgColor_error();
        })
        .always(function() {
	    
        });
}

function update_BgColor_success(response) {

    if(response.status == "OK"){
	 $("#update_BgColor_msg").show();
    }

    if(response.status == "Error"){
	alert("Ett fel inträffade, vänligen kontakta support om problemet kvarstår.");
    }
}

function update_BgColor_error() {

    alert("Ett allvarligt fel inträffade, vänligen kontakta support om problemet kvarstår.");
}

function upload_background_success(response) {

  if(response.responseText == "Error")
    alert("Ett fel inträffade, vänligen kontakta support om problemet kvarstår.");

  if(response.responseText == "OK")
    change_background();

}


function change_icon() {

    document.getElementById("btn_icon").style.backgroundColor = "#ff0000";
    document.getElementById("btn_icon").style.color = "#FFF";

    document.getElementById("btn_banner").style.backgroundColor = "#FFF";
    document.getElementById("btn_banner").style.color = "#2F4F4F";

    document.getElementById("btn_offers").style.backgroundColor = "#FFF";
    document.getElementById("btn_offers").style.color = "#2F4F4F";

    document.getElementById("btn_info").style.backgroundColor = "#FFF";
    document.getElementById("btn_info").style.color = "#2F4F4F";

    document.getElementById("btn_blog").style.backgroundColor = "#FFF";
    document.getElementById("btn_blog").style.color = "#2F4F4F";

    document.getElementById("btn_files").style.backgroundColor = "#FFF";
    document.getElementById("btn_files").style.color = "#2F4F4F";

    document.getElementById("btn_bg").style.backgroundColor = "#FFF";
    document.getElementById("btn_bg").style.color = "#2F4F4F";

    document.getElementById("btn_navbar").style.backgroundColor = "#FFF";
    document.getElementById("btn_navbar").style.color = "#2F4F4F";

    var s = "";
    s += '<form enctype="multipart/form-data" method="post" action="ajax/uploadicon.php" id="iconform">';
    s += '<input type="file" name="iconfile">';
    s += '<br>';
    s += '<input type="submit" name="submiticon" class="btn btn-success" value="Ladda upp">';
    s += '</form>';
    s += '<h3 style="color: black;">Nuvarande Ikon:</h3>';

    s += '<div id="icon_msg" class="alert alert-success"><strong>Loggan är upplagd!</strong></div>';
    s += '<div class="progress" id="iconbar">';
    s += '<div class="progress-bar progress-bar-striped active" id="iconprogress" role="progressbar"';
    s += 'aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">';
    s += '<span id="iconprogressText" class="sr-only">0%</span>';
    s += '</div>';
    s += '</div>';
    s += "<img id='icon_image' src='/images/" + Companies.Company[0].Icon + "' style='width: 200px; height='200px;'>";

    s += '</div>';

    document.getElementById("main").innerHTML = s;

    $("#iconbar").hide();
    $("#icon_msg").hide();

    $(function() {

        $("#iconform").ajaxForm({

            beforeSend: function() {

                $("#iconbar").show();
            },
            uploadProgress: function(event, position, total, percentComplete) {

                $("#iconprogress").width(percentComplete + '%');

            },
            success: function() {
                $("#icon_msg").show();
                $("#iconbar").hide();
            },
            complete: function(response) {
                if (response.responseText != "Error" || response.responseText != "ToBig") {
                    document.getElementById("icon_image").src = "../images/" + response.responseText + "";
                    Companies.Company[0].Icon = "../images/" + response.responseText + "";
                }

            }

        });



    });




}

function change_offers() {

    document.getElementById("btn_offers").style.backgroundColor = "#ff0000";
    document.getElementById("btn_offers").style.color = "#FFF";

    document.getElementById("btn_banner").style.backgroundColor = "#FFF";
    document.getElementById("btn_banner").style.color = "#2F4F4F";

    document.getElementById("btn_info").style.backgroundColor = "#FFF";
    document.getElementById("btn_info").style.color = "#2F4F4F";

    document.getElementById("btn_icon").style.backgroundColor = "#FFF";
    document.getElementById("btn_icon").style.color = "#2F4F4F";

    document.getElementById("btn_blog").style.backgroundColor = "#FFF";
    document.getElementById("btn_blog").style.color = "#2F4F4F";

    document.getElementById("btn_files").style.backgroundColor = "#FFF";
    document.getElementById("btn_files").style.color = "#2F4F4F";

    document.getElementById("btn_bg").style.backgroundColor = "#FFF";
    document.getElementById("btn_bg").style.color = "#2F4F4F";

    document.getElementById("btn_navbar").style.backgroundColor = "#FFF";
    document.getElementById("btn_navbar").style.color = "#2F4F4F";

    var s = "";


    if (Offers.offer) {

        s += '<table class="table table-bordered" id="offer_table">';

        s += '<thead>';

        s += '<tr>';
        s += '<th>Rubrik</th>';
        s += '<th>Beskrivning</th>';
        s += '<th>Startdatum</th>';
        s += '<th>Slutdatum</th>';
        s += '<th>Minsta ålder</th>';
        s += '<th>Högsta ålder</th>';
        s += '<th>Åtgärd</th>';
        s += '</tr>';

        s += '</thead>';

        s += '<tbody id="offer_tbody">';

        for (var i = 0; i < Offers.offer.length; i++) {

            s += '<tr id="' + Offers.offer[i].ID + '">';
            s += '<td>' + Offers.offer[i].Caption + '</td>';
            s += '<td>' + Offers.offer[i].ShortDes + '</td>';
            s += '<td>' + Offers.offer[i].StartDate + '</td>';
            s += '<td>' + Offers.offer[i].DueDate + '</td>';
            s += '<td>' + Offers.offer[i].MinAge + '</td>';
            s += '<td>' + Offers.offer[i].MaxAge + '</td>';
            s += '<td><button class="btn btn-danger" value="' + Offers.offer[i].ID + '"  onclick="remove_offer(this.value)">Ta bort</button></td>';
            s += '</tr>';


        }



        s += '</tbody>';

        s += '</table>';

        s += '<button class="btn btn-success" onclick="add_offer()">Lägg till</button>';
        s += '<div id="new_offer">';
        s += '</div';



        document.getElementById("main").innerHTML = s;

        return;

    } else {

        s += '<h1 style="color: black;">Ditt företag har inga erbjudanden för närvarande.</h1>';
        s += '<button class="btn btn-success" onclick="add_offer()">Lägg till ett nytt erbjudande</button>';
        s += '<div id="new_offer">';
        s += '</div';

    }

    document.getElementById("main").innerHTML = s;

}

function add_offer() {

    var s = "";

    s += '<div class="form-group">';
    s += '<form enctype="multipart/form-data" method="post" action="ajax/uploadoffer.php" id="newofferform">';
    s += '<label for="txt_Caption">Rubrik:</label>';
    s += '<input type="text" class="form-control" id="txt_Caption" name="txt_Caption">';
    s += '<label for="txt_Description">Beskrivning:</label>';
    s += '<textarea id="txt_Description" name="txt_Description" class="form-control" rows="4"></textarea>';
    s += '<label for="txt_StartDate">Startdatum:</label>';
    s += '<input type="text" id="txt_StartDate" name="txt_StartDate" class="form-control">';
    s += '<label for="txt_DueDate">Slutdatum:</label>';
    s += '<input type="text" id="txt_DueDate" name="txt_DueDate" class="form-control">';
    s += '<label for="txt_MinAge">Minsta ålder:</label>';
    s += '<input type="number" name="txt_MinAge" min="10" class="form-control" max="99">';
    s += '<label for="txt_MaxAge" >Högsta ålder:</label>';
    s += '<input type="number" name="txt_MaxAge" min="10" max="99" class="form-control"><br>';
    s += '<label for="txt_Gender" >Kön:</label>';
    s += '<select name="txt_Gender" class="form-control">';
    s += '<option value="1">Män</option>';
    s += '<option value="2">Kvinnor</option>';
    s += '<option value="3">Båda</option>';
    s += '</select><br>';
    s += '<input type="file" name="newOffer_file"><br>';
    s += '<label for="selectCS">Kommuner som erbjudandet ska visas i:</label>';
    s += '<select class="form-control selectpicker"  data-live-search="true"  multiple style="width: 100%;" id="selectCS" name="selectCS[]">';
    for (var i = 0; i < kommun.CS.length; i++) {
        s += '<option value="' + kommun.CS[i].ID + '">' + kommun.CS[i].CityState + '</option>';
    }
    s += '</select><br><br>';
    s += '<input type="submit" class="btn btn-success" id="newOffer_submit" name="newOffer_submit" value="Spara">';
    s += '<div class="progress" id="newOfferbar">';
    s += '<div class="progress-bar progress-bar-striped active" id="offerprogress" role="progressbar"';
    s += 'aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">';
    s += '<span id="iconprogressText" class="sr-only">0%</span>';
    s += '</div>';
    s += '</div>';
    s += '</form>';
    s += '</div>';
    s += '<div id="new_offer_msg" class="alert alert-success"><strong>Erbjudandet är nu upplagt!</strong></div>';

    document.getElementById('new_offer').innerHTML = s;

    $(function() {

        $("#new_offer_msg").hide();

        $("#newofferform").ajaxForm({

            beforeSend: function() {

                $("#newOfferbar").show();
            },
            uploadProgress: function(event, position, total, percentComplete) {

                $("#offerprogress").width(percentComplete + '%');

            },
            success: function() {

                $("#newOfferbar").hide();
            },
            complete: function(response) {

                if (response.responseText == "OK") {

                    alert(response.responseText);

                    $("#new_offer_msg").show();

                }


            }

        });



    });

    $(document).ready(function() {

        $('.selectpicker').selectpicker();
    });

    $("#newOfferbar").hide();

    $(function() {
        $("#txt_StartDate").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    $(function() {
        $("#txt_DueDate").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

}

function remove_offer(value) {

    var check = confirm("Är du säker på att du vill ta bort erbjudandet?");

    if (check == false)
        return;

    var instring = '{"OfferID": "' + value + '"}';

    var objekt = JSON.parse(instring);

    $.getJSON("ajax/remove_offer.php", objekt)
        .done(function(data) {
            remove_offer_success(data);
        })
        .fail(function() {
            remove_offer_error();
        })
        .always(function() {

        });




}

function remove_offer_success(response) {

    if (response.status == "OK") {

        var row = document.getElementById(response.OfferID);
        row.parentNode.removeChild(row);
    }

    if (response.status == "Error") {

        alert("Ett fel inträffade när vi försökte ta bort erbjudandet. Vänligen kontakta support om problemet kvarstår.");
    }
}

function remove_offer_error() {

    alert("Ett allvarligt fel inträffade när vi försökte ta bort erbjudandet. Vänligen kontakta support om problemet kvarstår.");
}

function change_info() {

    document.getElementById("btn_info").style.backgroundColor = "#ff0000";
    document.getElementById("btn_info").style.color = "#FFF";

    document.getElementById("btn_banner").style.backgroundColor = "#FFF";
    document.getElementById("btn_banner").style.color = "#2F4F4F";

    document.getElementById("btn_offers").style.backgroundColor = "#FFF";
    document.getElementById("btn_offers").style.color = "#2F4F4F";

    document.getElementById("btn_icon").style.backgroundColor = "#FFF";
    document.getElementById("btn_icon").style.color = "#2F4F4F";

    document.getElementById("btn_blog").style.backgroundColor = "#FFF";
    document.getElementById("btn_blog").style.color = "#2F4F4F";

    document.getElementById("btn_files").style.backgroundColor = "#FFF";
    document.getElementById("btn_files").style.color = "#2F4F4F";

    document.getElementById("btn_bg").style.backgroundColor = "#FFF";
    document.getElementById("btn_bg").style.color = "#2F4F4F";
    
    document.getElementById("btn_navbar").style.backgroundColor = "#FFF";
    document.getElementById("btn_navbar").style.color = "#2F4F4F";

    var s = "";
    s += '<div class="form-group">';

    s += '<label for="txt_phone">Telefon:</label>';
    s += '<input type="text" id="txt_phone" value="' + Foretagssida.foretag[0].Telefon + '" class="form-control">';

    s += '<label for="txt_email">Email:</label>';
    s += '<input type="text" id="txt_email" value="' + Foretagssida.foretag[0].Postnr + '" class="form-control">';

    s += '<label for="txt_adress">Adress:</label>';
    s += '<input type="text" id="txt_adress" value="' + Foretagssida.foretag[0].Adress + '" class="form-control">';
    s += '<br>';
    s += '<button class="btn btn-success" id="update_info" onclick="update_info()">Uppdatera</button>';

    s += '</div>';

    s += '</div>';
    s += '<br>';
    s += '<div id="update_info_msg" class="alert alert-success"><strong>Uppgifterna är uppdaterade!</strong></div>';
    s += '</div>';



    document.getElementById("main").innerHTML = s;

    $("#update_info_msg").hide();


   
}

function update_info() {

    var phone = document.getElementById("txt_phone").value;
    var email = document.getElementById("txt_email").value;
    var adress = document.getElementById("txt_adress").value;

    var phonechanged = true;
    var emailchanged = true;
    var adresschanged = true;

    if (phone == Foretagssida.foretag[0].Telefon)
        phonechanged = false;

    if (email == Foretagssida.foretag[0].Postnr)
        emailchanged = false;

    if (adress == Foretagssida.foretag[0].Adress)
        adresschanged = false;

    if (phonechanged == false &&
        emailchanged == false &&
        adresschanged == false) {

        alert("Värdena är oförändrade.");
        return;
    }

    var instring = '{"Phone": "' + phone + '", "Email": "' + email + '", "Adress": "' + adress + '"}';
    instring = escapeSpecialChars(instring);
    var objekt = JSON.parse(instring);



    $.getJSON("ajax/update_info.php", objekt)
        .done(function(data) {
            update_info_success(data);
        })
        .fail(function() {
            update_info_error();
        })
        .always(function() {

        });
}

function update_info_success(response) {

    if (response.status == "OK") {
        Foretagssida.foretag[0].Telefon = document.getElementById("txt_phone").value;
        Foretagssida.foretag[0].Postnr = document.getElementById("txt_email").value;
        Foretagssida.foretag[0].Adress = document.getElementById("txt_adress").value;
        $("#update_info_msg").show();
    }

    if (response.status == "Error") {
        alert("Ett fel har inträffat. Vänligen kontakta support om problemet kvarstår");
    }
}

function update_info_error() {

    alert("Ett allvarligt fel har inträffat. Vänligen kontakta support om problemet kvarstår");
}

function uploadbanner() {



}

function uploadbanner_success(response) {

    alert(response.status);
    if (response.status == "OK") {
        alert("Bannern är nu upplagd!");

    }

    if (response.status == "Error") {

        alert("Ett fel har inträffat vid uppladdning av bannern. Vänligen kontakta support ifall problemet kvarstår.");

    }
}

function uploadbanner_error() {

    alert("Ett allvarligt fel har inträffat vid uppladdning av bannern. Vänligen kontakta support ifall problemet kvarstår.");
}

function change_Post() {


    document.getElementById("btn_blog").style.backgroundColor = "#ff0000";
    document.getElementById("btn_blog").style.color = "#FFF";

    document.getElementById("btn_banner").style.backgroundColor = "#FFF";
    document.getElementById("btn_banner").style.color = "#2F4F4F";

    document.getElementById("btn_offers").style.backgroundColor = "#FFF";
    document.getElementById("btn_offers").style.color = "#2F4F4F";

    document.getElementById("btn_icon").style.backgroundColor = "#FFF";
    document.getElementById("btn_icon").style.color = "#2F4F4F";

    document.getElementById("btn_info").style.backgroundColor = "#FFF";
    document.getElementById("btn_info").style.color = "#2F4F4F";

    document.getElementById("btn_files").style.backgroundColor = "#FFF";
    document.getElementById("btn_files").style.color = "#2F4F4F";

    document.getElementById("btn_bg").style.backgroundColor = "#FFF";
    document.getElementById("btn_bg").style.color = "#2F4F4F";

    document.getElementById("btn_navbar").style.backgroundColor = "#FFF";
    document.getElementById("btn_navbar").style.color = "#2F4F4F";


    var s = "";

    s += '<div class="form-group">';
    s += '<label for="txt_Caption">Rubrik:</label>';
    s += '<input type="text" class="form-control" id="txt_Caption" value="' + Post.post[0].Caption + '">';
    s += '<label for="txt_Message">Meddelande:</label>';
    s += '<textarea class="form-control" id="txt_Message" rows="4">' + Post.post[0].Message + '</textarea><br>';
    s += '<button class="btn btn-success" id="btn_blog" onclick="update_Post()">Uppdatera</button><br>';
    s += '<div id="update_blog_msg" class="alert alert-success"><strong>Minibloggen är uppdaterad!</strong></div>';
    s += '</div>';

    document.getElementById("main").innerHTML = s;

    $("#update_blog_msg").hide();
}

function update_Post() {

    var caption = document.getElementById("txt_Caption").value;
    var text = document.getElementById("txt_Message").value;

    if (caption == Post.post[0].Caption && text == Post.post[0].Message) {

        alert("Formuläret är oförändrat!");

        return;
    }


    var instring = '{"Caption": "' + caption + '", "Text": "' + text + '"}';
    instring = escapeSpecialChars(instring);
    var objekt = JSON.parse(instring);
    
    $.getJSON("ajax/update_Post.php", objekt)
        .done(function(data) {
            update_Post_success(data);
        })
        .fail(function() {
            update_Post_error();
        })
        .always(function() {

        });

}

function update_Post_success(response) {

    if (response.status == "OK") {

        $("#update_blog_msg").show();

        Post.post[0].Caption = document.getElementById("txt_Caption").value;
        Post.post[0].Message = document.getElementById("txt_Message").value;

    }

    if (response.status == "Error") {

        alert("Det gick inte att uppdatera minibloggen. Vänligen kontakta support om problemet kvarstår.");
    }
}

function update_Post_error() {

    alert("Det gick inte att uppdatera minibloggen pågrund av ett allvarligt fel. Vänligen kontakta support om problemet kvarstår.");
}

function change_files() {

    document.getElementById("btn_files").style.backgroundColor = "#ff0000";
    document.getElementById("btn_files").style.color = "#FFF";

    document.getElementById("btn_banner").style.backgroundColor = "#FFF";
    document.getElementById("btn_banner").style.color = "#2F4F4F";

    document.getElementById("btn_offers").style.backgroundColor = "#FFF";
    document.getElementById("btn_offers").style.color = "#2F4F4F";

    document.getElementById("btn_icon").style.backgroundColor = "#FFF";
    document.getElementById("btn_icon").style.color = "#2F4F4F";

    document.getElementById("btn_info").style.backgroundColor = "#FFF";
    document.getElementById("btn_info").style.color = "#2F4F4F";

    document.getElementById("btn_blog").style.backgroundColor = "#FFF";
    document.getElementById("btn_blog").style.color = "#2F4F4F";

    document.getElementById("btn_bg").style.backgroundColor = "#FFF";
    document.getElementById("btn_bg").style.color = "#2F4F4F";

    document.getElementById("btn_navbar").style.backgroundColor = "#FFF";
    document.getElementById("btn_navbar").style.color = "#2F4F4F";

    var instring = '{"ID": "' + ID + '"}';

    var objekt = JSON.parse(instring);

    $.getJSON("ajax/get_files.php", objekt)
        .done(function(data) {
            change_files_success(data);
        })
        .fail(function() {
            change_files_error();
        })
        .always(function() {

        });
}

function change_files_success(response) {

	if(response.status == "NoFiles"){
		document.getElementById("main").innerHTML = '<h1>Företaget har inga filer för tillfället.</h1><br><br><button class="btn btn-success" onclick="add_file()">Ladda upp fil</button>';
	}

    var s = "";



    document.getElementById("main").innerHTML = s;

    if(response.status == "OK"){
         s += '<table class="table table-bordered" id=files_table">';
    s += '<thead>';
    s += '<tr>';
    s += '<th>Rubrik</th>';
    s += '<th>Visa bild</th>';
    s += '<th>Åtgärd</th>'
    s += '</tr>';
    s += '</thead>';
    s += '<tbody id="files_tbody">';
    s += '</tbody>';
    s += '</table>';
    s += '<button class="btn btn-success" onclick="add_file()">Ladda upp fil</button>';


       s += '<tr>';
       for(var i = 0; i < response.file.length; i++){
        s += '<td>'+ response.file[i].Caption +'</td>';
        s += '<td id="'+ response.file[i].ID +'"><button class="btn btn-default">Visa bild</button></td>';
        s += '<td><button value="'+ response.file[i].ID +'" class="btn btn-danger">Ta bort</button></td>';
       }

       s += '</tr>';
       
       document.getElementById("files_tbody").innerHTML = s;
    }

    if(response.status == "Error"){
      alert("Något gick snett!");
    }

    if(response.status == "NoFiles"){
      document.getElementById("main").innerHTML += '<p>Företaget har för närvarande inga filer.</p><button class="btn btn-success" onclick="add_file()">Lägg till fil</button>';
    }



}

function change_files_error() {

    alert("Ett allvarligt fel har inträffat. Om problemet kvarstår vänligen kontakta support.");
}
function add_file(){

     var s = "";

     s += '<form enctype="multipart/form-data" method="post" action="ajax/upload_file.php" id="newfileform">';
     s += '<label>Rubrik:</label>';
     s += '<input type="text" class="form-control" name="Caption">';
     s += '<label>Bild:</label>';
     s += '<input type="file" name="fileimg"><br>';
     s += '<label>PDF-fil:</label><br>';
     s += '<input type="file" name="filepdf"><br>';
     s += '<input type="submit" class="btn btn-success" name="submit" value="Ladda upp">';
     s += '</form>';
     document.getElementById("main").innerHTML += s;

         $(function() {


        $("#newfileform").ajaxForm({

            beforeSend: function() {

            },
            uploadProgress: function(event, position, total, percentComplete) {

            },
            success: function() {

                $("#newOfferbar").hide();
            },
            complete: function(response) {

                add_file_success(response);

            }

        });



    });
}

function add_file_success(response){

alert(response.responseText);
    if(response.responseText == "OK"){
    
    

    //    change_files();
    }

    if(response.responseText == 'Error')
        alert("Et fel inträffade. Vänligen kontakta support om problemet kvarstår.");
}

