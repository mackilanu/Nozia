function fetch_categories(value){
var newURL = updateURLParameter(window.location.href, 'locId', 'newLoc');
newURL = updateURLParameter(newURL, 'resId', 'newResId');

window.history.replaceState('', '', updateURLParameter(window.location.href, "CS", value));
}


function initialize(value){
	var newURL = updateURLParameter(window.location.href, 'locId', 'newLoc');
newURL = updateURLParameter(newURL, 'resId', 'newResId');

window.history.replaceState('', '', updateURLParameter(window.location.href, "CS", value));
}

function SendCS(value){
	    $.get("../companies/index.php",{cs: value},  function(data, status){
     
    });
}


function updateURLParameter(url, param, paramVal)
{
    var TheAnchor = null;
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";

    if (additionalURL) 
    {
        var tmpAnchor = additionalURL.split("#");
        var TheParams = tmpAnchor[0];
            TheAnchor = tmpAnchor[1];
        if(TheAnchor)
            additionalURL = TheParams;

        tempArray = additionalURL.split("&");

        for (var i=0; i<tempArray.length; i++)
        {
            if(tempArray[i].split('=')[0] != param)
            {
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }        
    }
    else
    {
        var tmpAnchor = baseURL.split("#");
        var TheParams = tmpAnchor[0];
            TheAnchor  = tmpAnchor[1];

        if(TheParams)
            baseURL = TheParams;
    }

    if(TheAnchor)
        paramVal += "#" + TheAnchor;

    var rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}


function fetch_categories(value){
	    $.get("ajax/fetch_categories.php", function(data, status){
        alert("Data: " + value);
    });
}