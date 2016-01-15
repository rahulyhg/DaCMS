/* vars */
var piwik_status = true;
var piwik_id = 17;
var piwik_url = 'https://stats.roumen.it/';
var piwik_domain = '*.dacms.co';
var google_analytics_status = false;
var google_analytics_id = '';
/* counters */
if (piwik_status)
{
    // piwik code
    var _paq = _paq || [];
    (function(){
    _paq.push(['setSiteId', piwik_id]);
    _paq.push(['setTrackerUrl', piwik_url+'piwik.php']);
    _paq.push(['setCookieDomain', piwik_domain]);
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=piwik_url+'piwik.js';
    s.parentNode.insertBefore(g,s);
    })();
}
if (google_analytics_status)
{
    // google analytics code
}
/* cookies */
function createCookie(name, value, days)
{
    if (days)
    {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else
    {
        var expires = "";
    }

    document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}
function readCookie(name)
{
    var nameEQ = escape(name) + "=";
    var ca = document.cookie.split(';');

    for (var i = 0; i < ca.length; i++)
    {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return unescape(c.substring(nameEQ.length, c.length));
    }
    return null;
}
function eraseCookie(name)
{
    createCookie(name, "", -1);
}