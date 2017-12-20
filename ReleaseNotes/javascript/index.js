$(document).ready(function() {
 var s = "";

 for(var i = 0; i < Note.note.length; i++){
    
    s += '<div class="jumbotron">';
    s += '  <h3 style="color: #000;">'+ Note.note[i].Caption +'</h3>';
    s += '<h5>'+ Note.note[i].Date +'</h5>';
    s += '<h5>'+ Note.note[i].Version +'</h5>';
    s += '<p>'+ Note.note[i].Message +'</p>';
    s += '</div>';

 }

document.getElementById("main").innerHTML += s;

});

 $( function() {
        $( "#Date" ).datepicker( {dateFormat: 'yy-mm-dd' });
     } );



 function Upload(){

 	var Caption = document.getElementById("Caption").value;
 	var Message = document.getElementById("Message").value;
 	var date    = document.getElementById("Date").value;
 	var Version = document.getElementById("Version").value;

 	var instring  = '{"Caption": "' + Caption +'", "Message": "'+ Message +'", "Date": "'+ date +'", "Version": "'+ Version +'"}';
    var objekt    = JSON.parse(instring);

  $.getJSON("ajax/Upload.php", objekt)
        .done(function(data) {
       Upload_success(data);
  })
        .fail(function() {
        Upload_error();
  })
        .always(function() {

  });
 }


 function Upload_success(response){

 	if(response.status == "OK")
 		alert("Klart!");

 	if(response.status == "Error")
 		alert("Ett fel inträffade.");
}

function Upload_error(){
	alert("Ett allvarligt fel inträffade.");
}