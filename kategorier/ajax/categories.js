function newUrl(){
    $.getJSON("ajax/fetch_categories.php")
        .done(function(data) {
       newUrl_success(data);
	})
        .fail(function() {
     newUrl_error();
	})
        .always(function() {

	});
}

function newUrl_success(response){
	if(response.status == "OK"){

		var div = document.getElementById("categories");
		console.log(response.CS.length);
		console.log(response.CS[0].URL);


		for(var i = 0; i < response.CS.length; i++){


       console.log(response.CS[i].Caption);
			div.innerHTML += '<div class="col-lg-4 col-sm-4 col-xs-4 text-center">';
			div.innerHTML += '<div class="square circle-format">';
			div.innerHTML += ' <a href="../companies?category='+ response.CS[i].Caption +'&id='+ response.CS[i].CategoryID +'&CS=$CS">';
			div.innerHTML += ' <img src="images/'+ response.CS[i].URL +'" class="img-responsive circle-format" ';
			div.innerHTML += 'style="margin-bottom: 5px;" alt="Company Profile Picture"></a>';
			div.innerHTML += '</div>';
			div.innerHTML += ' <a class="company-name" href="../companies?category='+ response.CS[i].Caption +'&id='+ response.CS[i].CategoryID +'&CS=$CS">'+ response.CS[i].Caption+'</a> <br></div>';


                
		}

		
	}
}

function  newUrl_error(){
	alert("det funkade inte");
}