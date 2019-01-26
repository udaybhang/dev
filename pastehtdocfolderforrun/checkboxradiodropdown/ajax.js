
function change_country(){
var xmlhttp= new XMLHttpRequest();
xmlhttp.open("GET", "get-states.php?country="+document.getElementByName("dropdown").value, false);
xmlhttp.send(null);

document.getElementById("state").innerHTML=xmlhttp.responseText;
}



