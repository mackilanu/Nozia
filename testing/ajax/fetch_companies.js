function FetchCompanies(str, value){
       if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("companies").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajax/fetch_companies.php?category="+ document.getElementById(value).value,true);
        xmlhttp.send();
    }

}



setInterval(FetchCompanies, 2000)