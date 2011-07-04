#rights=ADMIN

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

//set base url here

var base_url = "http://localhost/adplatform/";

//import java packages
importPackage(Packages.java.net);
importPackage(Packages.java.io);
importPackage(Packages.java.lang);

//Find html body
a1 = httpresponse.indexOf("<body");
a2 = httpresponse.indexOf(">",a1)+1;


// create / retrieve a transient variable called counter and increased it
i = sharedcache.get("counter");
i++;

//create session id
var sessid1 = makeid();
var sessid2 = makeid();

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

var uri = requestedurl.split("://");
var requri;

if(uri.length > 1){
    requri = uri[1];
}else{
    requri = requestedurl;
}

var ruleuri = base_url + "ad/wrules/"+device+"/"+uri[1]+ makeid();
var url = new java.net.URL(ruleuri);
var connection = url.openConnection();
var reader = new java.io.BufferedReader(new java.io.InputStreamReader( connection.getInputStream()));
var txtresponse = new StringBuilder();
while ((resp = reader.readLine()) != null) {
    txtresponse.append(resp);
}
reader.close();

var rules = txtresponse;

var widget_html = "<table width=\"100%\">" 
    +"<tr>" 
    +"<td><a href=\"" + base_url + "admin\"><img src=\"" + base_url + "assets/icons/widget/22/jump_content.png\"  alt=\"widget/22/jump_content\" /></a></td>"     
    +"<td><a href=\"" + base_url + "admin\"><img src=\"" + base_url + "assets/icons/widget/22/custom_search.png\"  alt=\"widget/22/custom_search\" /></a></td>" 
    +"<td><a href=\"" + base_url + "admin\"><img src=\"" + base_url + "assets/icons/widget/22/favorites.png\"  alt=\"widget/22/favorites\" /></a></td>"    
    +"<td><a href=\"" + base_url + "admin\"><img src=\"" + base_url + "assets/icons/widget/22/share.png\"  alt=\"widget/22/share\" /></a></td>"    
    +"<td><a href=\"" + base_url + "admin\"><img src=\"" + base_url + "assets/icons/widget/22/jump_media.png\"  alt=\"widget/22/jump_media\" /></a></td>"    
    +"<td width="100%">&nbsp;</td>"
    +"<td><a href=\"" + base_url + "admin\"><img src=\"" + base_url + "assets/icons/widget/22/content_more.png\"  alt=\"widget/22/content_more\" /></a></td>"     
    +"<td><a href=\"" + base_url + "admin\"><img src=\"" + base_url + "assets/icons/widget/22/tools.png\"  alt=\"widget/22/tools\" /></a></td>"     
    +"</tr>" 
    +"<tr>" 
    +"<form action=\"\">"    
    +"<td colspan=\"7\" width=\"100%\">"    
    +"    <input type=\"text\" value=\"jump to\" style=\"width:100%;\" />"    
    +"</td>"    
    +"<td>"    
    +"<button type=\"submit\" name=\"submit\" value=\"submit\" >Go</button>"    
    +"</td>"     
    +"</form>"     
    +"</tr>" 
	+"</table>";
	
var widget_frames_top = "<frameset>"
	+"<frame src=\"" + base_url + "ad/widget/22\" height=\"50\" noresize=\"noresize\" />"
	+"<frame src=\"" + requestedurl + "\" height=\"100%\" />"
    +"</frameset>";

var widget_frames_bottom = "<frameset>"
	+"<frame src=\"" + requestedurl + "\" height=\"100%\" />"
	+"<frame src=\"" + base_url + "ad/widget/22\" height=\"50\" noresize=\"noresize\" />"
    +"</frameset>";

var widget_frames_both = "<frameset>"
	+"<frame src=\"" + base_url + "ad/widget/22\" height=\"50\" noresize=\"noresize\" />"
	+"<frame src=\"" + requestedurl + "\" height=\"100%\" />"
	+"<frame src=\"" + base_url + "ad/widget/22\" height=\"50\" noresize=\"noresize\" />"
    +"</frameset>";

b1 = httpresponse.indexOf("</body");
b2 = httpresponse.indexOf(">",b1)+1;

//update response
if(rules == 'frame_top'){
    httpresponse = httpresponse.substring(0,a2)
			+widget_frame_top
            +httpresponse.substring(b1);
}else if(rules == 'frame_bottom'){
    httpresponse = httpresponse.substring(0,a2)
			+widget_frame_bottom
            +httpresponse.substring(b1);
}else if(rules == 'frame_both'){
    httpresponse = httpresponse.substring(0,a2)
			+widget_frame_both
            +httpresponse.substring(b1);
}else{
	if(rules == 'both' || rules == 'top'){
	    httpresponse = httpresponse.substring(0,a2)
				+widget_html
	            +httpresponse.substring(a2);
	}

	b1 = httpresponse.indexOf("</body");
	b2 = httpresponse.indexOf(">",b1)+1;

	if(rules == 'both' || rules == 'bottom'){
	    httpresponse = httpresponse.substring(0,b1)
				+widget_html
	            +httpresponse.substring(b1);
	}
} 

rules = "";

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








































