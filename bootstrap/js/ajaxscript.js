    //Ajax for SEARCH
function searchUsers(str)
{
var xmlhttp;    
if (str=="")
  {
  window.location.replace("user.php");
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("showUsers").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","searchUsers.php?q="+str,true);
xmlhttp.send();
}












