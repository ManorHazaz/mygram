
let options = 
{
    threshold: 0.9
};

let observer = new IntersectionObserver((entries, observer) => 
{
    const loader = entries[0];
    console.log(loader.intersectionRatio);


    if(loader.intersectionRatio > 0.9)
    {
        if( _('#laravel-last-page').value == page )
        {
            _('.load-more').innerHTML = "";
        }
        else
        {
            loadMore(url , page , data);
            page++;
        }
    }
}, options );

var page = 2;
var url = _('#laravel-url-page').value;
url = url.substring(0, url.indexOf("=") );
var data = '.paginate-data';

observer.observe(_('.load-more'));