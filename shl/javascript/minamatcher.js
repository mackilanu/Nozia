//Javascript File

var Rapportlista = new Array();

initiera();


function initiera(){

    var s = '<div class="col-md-1 col-xs-0"></div>';
    s += '<div id="c_side" class="col-md-10 col-xs-12"></div>';
    s += '<div class="col-md-1 col-xs-0"></div>';

    document.getElementById('div_container').innerHTML = s;

    visa_sidan();
    visa_foten();
}


function visa_sidan(){
    
    var s = '<div class="col-md-6 col-xs-6 right-header">';
    s += '<a href="mittkonto.php"><img src="Images/SHL-logo.jpg" alt="SHL" class="logo" style="width:80%;"></a></div>';


    s += '<div class="col-md-6 col-xs-6 left-header">';
    logInfo = JSON.parse(logInfo);
    s += '<p id="inloggadsom" class="text-right">';
    s += logInfo.JerseyNo + '-' + logInfo.FirstName + ', ' + logInfo.LastName;
    s += '<br>' + Domartyper[logInfo.Domartyp] + '</p>';
    s +='<p id="knapp" class="text-right"></p>';
    s += '</div>';


    s += '<h1 class="center-text">Mina matcher</h1>';
    s += '<br>';


    s += '<div class="class="main-content" style="margin: auto 0%;">';

    s += '<div class="text-center">';
    // Fr.o.m. datum
    s += '<label>Fr.o.m.:</label>';
    s +='<input type="text" id="txtFromDate" onchange="CheckDate()" maxlength="10" value="' + FromDate + '"/>';

    // T.o.m. datum
    s += '&nbsp;&nbsp;<label>T.o.m.:</label>';
    s +='<input type="text" id="txtToDate" onchange="CheckDate()" value="' + ToDate + '"/>';

    //Bearbeta
    s += '&nbsp;&nbsp;&nbsp;';
    s += '<button type="button" class="btn-md btn-primary" onclick="bearbeta()">Bearbeta</button>';
    s += '</div>';

    // Rapporten
    s += '<br>'
    s += '<label id="rapportrubrik">Matchrapport</label>';
    s += '<div class="well" id="div_rapport"></div>';
    
    // Tabellen
    s += '<br><br>';
    s += '<div id="div_tabell"></div>';
    s += '<br>';
    s += '<div class="text-center"><button type="button" class="btn btn-primary" onclick="tillbaka()">Till Mitt konto</button></div>';
	    
    s += '</div>';
    s += '<br>'
    s += '<br>'
    s += '<br>'

    document.getElementById('c_side').innerHTML = s;

    
    s  = '<button class="btn btn-info btn-xs" onclick="logout()">Logga ut</button>';
    document.getElementById('knapp').innerHTML = s;


        
    visa_matcher();

}

function tillbaka(){
    window.open('mittkonto.php', '_self');
}




function visa_matcher(){
    
    var s = '<table class="table">';
    s += '<caption>Totalt ' + Matchlista.Match.length + ' matcher funna</caption>' ;
    s += '<thead>';
    s += '<tr>';
    s += '<th>Datum</th>';
    s += '<th>Match</th>';
    s += '<th>HD1</th>';
    s += '<th>HD2</th>';
    s += '<th>LD1</th>';
    s += '<th>LD2</th>';
    s += '<th>Coach</th>';
    s += '<th>Arena</th>';
    s += '<th>Rapport</th>';
    s += '</tr>';
    s += '</thead>';
    s += '<tbody>';

    
    if (publish_posts.publish_posts == 'J'){    
	for (var i = 0; i < Matchlista.Match.length; i++){

	    s += '<tr style="cursor:default;">';
	    // Datum
	    s += '<td>' + Matchlista.Match[i].Date.substr(0,16) + '</td>';

	    // Match
	    var tmp1 = Matchlista.Match[i].HomeCode + '-' + Matchlista.Match[i].AwayCode;
	    var tmp2 = Matchlista.Match[i].HomeName + '-' + Matchlista.Match[i].AwayName;
	    s += '<td title="' + tmp2 + '">' + tmp1 + '</td>';

	    // HD1
	    s += '<td style="color: ';
	    if (Matchlista.Match[i].HD1 < 0){
		s += 'red';
	    } else {
		s += 'black';
	    }
	    s += ';">' +  getDomare(Matchlista.Match[i].HD1) + '</td>';
	
	    // HD2
	    s += '<td style="color: ';
	    if (Matchlista.Match[i].HD2 < 0){
		s += 'red';
	    } else {
		s += 'black';
	    }
	    s += ';">' +  getDomare(Matchlista.Match[i].HD2) + '</td>';

	    // LD1
	    s += '<td style="color: ';
	    if (Matchlista.Match[i].LD1 < 0){
		s += 'red';
	    } else {
		s += 'black';
	    }
	    s += ';">' +  getDomare(Matchlista.Match[i].LD1) + '</td>';

	    // LD2
	    s += '<td style="color: ';
	    if (Matchlista.Match[i].LD2 < 0){
		s += 'red';
	    } else {
		s += 'black';
	    }
	    s += ';">' +  getDomare(Matchlista.Match[i].LD2) + '</td>';

	    // Dcoach
	    s += '<td>' +  getDomare(Matchlista.Match[i].Dcoach) + '</td>';

	    // Arena
	    s += '<td>' +  Matchlista.Match[i].Arena + '</td>';

	    // Rapport
	    s += '<td>';
	    if (Matchlista.Match[i].Dcoach){
		s += '<button type="button" class="btn-xs btn-primary" onclick="visa_rapport(' + String(i) + ')">';
		s += 'Visa</button>';
	    } else {
		s += '-';
	    }
	    s += '</td>';


	    s += '</tr>';
	}
    }
    s += '</tbody>';
    s += '</table>';


    document.getElementById('div_tabell').innerHTML = s;
    if (publish_posts.publish_posts != 'J'){
	alert("Matcherna har ännu inte publicerats.");
    }
	
}

function visa_rapport(i){
    
    var instring ='{"GameId": "' + Matchlista.Match[i].GameId + '"}';

    var js_objekt = JSON.parse(instring);

    
    $.getJSON("ajax/hamta_minrapport.php", js_objekt)
        .done(function(data) {
	    visa_rapport_success(data,i);
	})
        .fail(function() {
	    visa_rapport_fail();
	})
        .always(function() {

	});

}

function CheckDate(){
     
     var from = document.getElementById("txtFromDate").value;
     var tom  = document.getElementById("txtToDate").value;

     if(tom < from){
        alert("T.o.m kan inte vara större Fr.o.m");

       document.getElementById("txtToDate").value = from;
     }
}

function visa_rapport_success(response,i){

    Rapportlista = response;

    if (Rapportlista.status == 'Error'){
	alert("Hämtning av rapporten har, av okänd anledning, misslyckats. Vid upprepade fel kontakta webbadministratören.");

    } else if (Rapportlista.status == 'OK'){
	visa_rapporten(i);
    } else {
	alert("Oförutsett fel har inträffat!");
    }
}

function visa_rapport_fail(){

    alert("Ett oförutsett fel har inträffat! Åtgärden har inte kunnat genomföras");
}


function visa_rapporten(j){

    var s = '';

    if (Rapportlista.Answer.length < 1){
	s += 'Rapporten finns ännu inte.';
	s += '<br><br>';
    } else {
	for (i = 0; i < Rapportlista.Query.length; ++i){
	    s += '<b>' + Rapportlista.Query[i].Query + '</b>';
	    s += '<br>' + Rapportlista.Answer[i].Answer;
	    s += '<br><br>';
	}
    }

    s += '<button type="button" class="btn btn-primary" onclick="doljRapport()">Dölj rapport</button>';

    document.getElementById('div_rapport').innerHTML = s;
    var tmp = 'Matchrapport för matchen ' + Matchlista.Match[j].HomeName + '-' + Matchlista.Match[j].AwayName;

    document.getElementById('rapportrubrik').innerHTML = tmp;
}


function doljRapport(){
    document.getElementById('rapportrubrik').innerHTML = 'Matchrapport';
    document.getElementById('div_rapport').innerHTML = '';
}

function getDomare(domarID){
    var svar = '';
    for (var i = 0; i < Domarlista.Domare.length; ++i){
	if (Domarlista.Domare[i].JerseyNo == Math.abs(domarID)){
	    svar = Domarlista.Domare[i].LastName + ', ' + Domarlista.Domare[i].FirstName;
	    return svar;
	}
    }
    return svar;
}

function bearbeta(){
    if (publish_posts.publish_posts != 'J'){
	alert("Matcherna har ännu inte publicerats.");
	return;
    }
	
    
    var FromDate = rensatoDB(document.getElementById('txtFromDate').value.trim());
    document.getElementById('txtFromDate').value = FromDate;
    if (!FromDate){
	alert("Från och med datum saknas.");
	document.getElementById('txtFromDate').focus();
	return;
    }
    FromDate = FromDate + ' 00:00:00';

    
    var ToDate = rensatoDB(document.getElementById('txtToDate').value.trim());
    document.getElementById('txtToDate').value = ToDate;
    if (!ToDate){
	alert("Till och med datum saknas.");
	document.getElementById('txtToDate').focus();
	return;
    }
    ToDate = ToDate + ' 23:59:59';

    
    if (FromDate > ToDate){
	alert("Från och med datumet är större än till och med datumet");
	document.getElementById('txtFromDate').focus();
	return;
    }
    
    var instring ='{"FromDate": "' + FromDate + '", ';
    instring += '"ToDate": "' + ToDate + '"}';
    

    var js_objekt = JSON.parse(instring);

    $.getJSON("ajax/hamta_minamatcher.php", js_objekt)
        .done(function(data) {
	    bearbeta_success(data);
	})
        .fail(function() {
	    bearbeta_fail();
	})
        .always(function() {

	});

}

function bearbeta_success(response){

    Matchlista = response;

    if (Matchlista.status == 'Error'){
	alert("Hämtning av matcher har, av okänd anledning, misslyckats. Vid upprepade fel kontakta webbadministratören.");

    } else if (Matchlista.status == 'OK'){
	visa_matcher();
    } else {
	alert("Oförutsett fel har inträffat!");
    }
}

function bearbeta_fail(){

    alert("Ett oförutsett fel har inträffat! Åtgärden har inte kunnat genomföras");
}

 $( function() {
    $( "#txtToDate" ).datepicker( {dateFormat: 'yy-mm-dd' });
  } );

 $( function() {
    $( "#txtFromDate" ).datepicker( {dateFormat: 'yy-mm-dd' });
  } );


