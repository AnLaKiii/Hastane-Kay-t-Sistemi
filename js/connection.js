let deneme = document.getElementById("deneme");
var data = {
  param1: "value1",
  param2: "value2"
};

var a;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    deneme.innerHTML= this.responseText;
  }
};

var jsonData = JSON.stringify(data);

xmlhttp.open("POST", "php/deneme.php");
xmlhttp.send(jsonData);

