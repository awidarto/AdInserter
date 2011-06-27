#rights=ADMIN
//------------------------------------------------------------------- 
// This is a GreasySpoon script.
// --------------------------------------------------------------------
// WHAT IT DOES:
// --------------------------------------------------------------------
// ==ServerScript==
// @name            Ad_Insert
// @status on
// @description     
// @include        .*
// @exclude        
// @responsecode    200
// ==/ServerScript==
// --------------------------------------------------------------------
// Available elements provided through ICAP server:
// ---------------
// requestedurl  :  (String) Requested URL
// requestheader  :  (String)HTTP request header
// responseheader :  (String)HTTP response header
// httpresponse   :  (String)HTTP response body
// user_id        :  (String)user id (login or user ip address)
// user_group     :  (String)user group or user fqdn
// sharedcache    :  (hashtable<String, Object>) shared table between all scripts
// trace           :  (String) variable for debug output - requires to set log level to FINE
// ---------------

//------------------------------------------------------------------- 
// This is a GreasySpoon script.
// --------------------------------------------------------------------
// WHAT IT DOES:
// --------------------------------------------------------------------
// ==ServerScript==
// @name            JS Hello world
// @status on
// @description     Modification script sample in Javascript
// @include    .*     
// @exclude        
// @responsecode    200
// ==/ServerScript==
// --------------------------------------------------------------------
// Available elements provided through ICAP server:
// ---------------
// requestedurl  :  (String) Requested URL
// requestheader  :  (String)HTTP request header
// responseheader :  (String)HTTP response header
// httpresponse   :  (String)HTTP response body
// user_id        :  (String)user id (login or user ip address)
// user_group     :  (String)user group or user fqdn
// sharedcache    :  (hashtable<String, Object>) shared table between all scripts
// trace           :  (String) variable for debug output - requires to set log level to FINE
// ---------------
//trace = responseheader;

//Find html body
a1 = httpresponse.indexOf("<body");
a2 = httpresponse.indexOf(">",a1)+1;

// create / retrieve a transient variable called counter and increased it
i = sharedcache.get("counter");
i++;

//create session id
var sessid = makeid();

start = requestheader.indexOf("User-Agent: " ) + "User-Agent: ".length;
end = requestheader.indexOf("\r\n", start);
//Get User-Agent
useragent = requestheader.substring(start,end);
var device;
if(useragent.indexOf("iPhone") > 0){
    device = "iphone";
}else if(useragent.indexOf("Android") > 0){
    device = "android";
}else{
    device = "generic";
}
  

//update response
httpresponse = httpresponse.substring(0,a2)
        +"<a style='position:absolute;top:0;' href='http://192.168.1.113/ad/ad/uri/" +sessid+ "'>"
    +"<img src='http://192.168.1.113/ad/ad/img/" + sessid + "/" + device + "' alt='banner_ad' style='clear:both;' />"
        +"</a>"
    +httpresponse.substring(a2);

//store updated counter value
sharedcache.put("counter", i);

//insert a custom header
a1 = responseheader.indexOf("\r\n\r\n");
responseheader = responseheader.substring(0,a1) + "\r\nX-Powered-By: Greasyspoon" + responseheader.substring(a1);

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
//Finished








































