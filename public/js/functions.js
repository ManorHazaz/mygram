// get one element by CSS selector
function _( selector )
{
	return document.querySelector( selector );

}

// get all elements by CSS selector
function __( selector )
{
	return document.querySelectorAll( selector );

}

// get data from page with specific url in specific selector
function loadMore(url, page, fieldName)  
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) 
        {
            var parser = new DOMParser ();
            var responseDoc = parser.parseFromString (this.responseText, "text/html");
            _(fieldName).innerHTML += responseDoc.querySelector(fieldName).innerHTML;
            console.log(responseDoc);
        }
    };
    xhttp.open("GET", url + page, true);
    xhttp.send();
}
