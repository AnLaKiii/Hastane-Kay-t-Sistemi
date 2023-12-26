<?php
session_start();
if(!isset($_SESSION['doktor'])){
    header("Location: /Hastane-Kayit-Sistemi/Doktor-Arayuzu/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hastane</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
</head>
<body id="userMainPage"> 
    <?php include "php/navbar.php";?>
    <!-- days sourced from: https://nationaldaycalendar.com/february/ -->
    <div class="calendar">
        <div class="d-flex justify-content-center align-items-center">
            <i id="backMonth" class="fa-solid fa-angle-left me-2"></i>
            <h1 id="month" class=" me-2 mb-3" class="mb-3"></h1>
            <h1 id="year" class="mb-3"></h1>
            <i id="nextMonth" class="fa-solid fa-angle-right ms-2"></i>
        </div>
        <ul>
            <li id="1"><time>1</time><p>5</p></li>
            <li id="2"><time>2</time><p>5</p></li>
            <li id="3"><time>3</time><p>5</p></li>
            <li id="4"><time>4</time><p>5</p></li>
            <li id="5"><time>5</time><p>5</p></li>
            <li id="6"><time>6</time><p>5</p></li>
            <li id="7"><time>7</time><p>5</p></li>
            <li id="8"><time>8</time><p>5</p></li>
            <li id="9"><time>9</time><p>5</p></li>
            <li id="10"><time>10</time><p>5</p></li>
            <li id="11"><time>11</time><p>5</p></li>
            <li id="12"><time>12</time><p>5</p></li>
            <li id="13"><time>13</time><p>5</p></li>
            <li id="14"><time>14</time><p>5</p></li>
            <li id="15"><time>15</time><p>5</p></li>
            <li id="16"><time>16</time><p>5</p></li>
            <li id="17"><time>17</time><p>5</p></li>
            <li id="18"><time>18</time><p>5</p></li>
            <li id="19"><time>19</time><p>5</p></li>
            <li id="20"><time>20</time><p>5</p></li>
            <li id="21"><time>21</time><p>5</p></li>
            <li id="22"><time>22</time><p>5</p></li>
            <li id="23"><time>23</time><p>5</p></li>
            <li id="24"><time>24</time><p>5</p></li>
            <li id="25"><time>25</time><p>5</p></li>
            <li id="26"><time>26</time><p>5</p></li>
            <li id="27"><time>27</time><p>5</p></li>
            <li id="28"><time>28</time><p>5</p></li>
            <li id="29"><time>29</time><p>5</p></li>
            <li id="30"><time>30</time><p>5</p></li>
            <li id="31"><time>31</time><p>5</p></li>
        </ul>
    </div>
    <?php include "php/footer.php";?> 
</body>
</html>


<script src="js/bootstrap.bundle.min.js"></script>
<script>
    var togleDrop = document.querySelector(".toggle-drop");
    togleDrop.addEventListener("click",function(event){
        var dropDown = document.querySelector(".toggle-drop .drop-ul");
        if(event.target != dropDown && !(dropDown.contains(event.target))){
            dropDown.classList.toggle("active");
        }
    })
    document.addEventListener('click', function (event) {
        var toggleDrop = document.querySelector('.toggle-drop');
        var dropUl = document.querySelector('.drop-ul');

        if (!toggleDrop.contains(event.target) && !dropUl.contains(event.target)) {
            dropUl.classList.remove("active");
        }
    });

    /***************************/
    /***********Calendar/*******/
    /***************************/
    function ayinSonGununuBul(ay, yil) {
        var ayinSonu = new Date(yil, ay, 0);
    return ayinSonu.getDate();
}



    var suankiTarih = new Date();
    var aylar = ["Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık"]
    // Yılı ve ayı alın
    var yilNow = suankiTarih.getFullYear();
    var ayNow = suankiTarih.getMonth();
    var yil = suankiTarih.getFullYear();
    var ay = suankiTarih.getMonth();
    var gun = suankiTarih.getDate();
    var calendarTitleMonth = document.getElementById("month");
    var calendarTitleYear = document.getElementById("year");
    calendarTitleMonth.innerHTML = aylar[ay]; 
    calendarTitleYear.innerHTML = yil; 
    var gunSayisi = ayinSonGununuBul(ay+1, yil);
    var Days = document.querySelectorAll(".calendar li");
    var DaysCount = document.querySelectorAll(".calendar li p");
    var DaysTime = document.querySelectorAll(".calendar li time");
    Days[gun-1].classList.add("today");
    var i;

    for(var i = 0; i< 31; i++){
        DaysCount[i].innerHTML = "Randevu Bulunmuyor";
        Days[i].setAttribute("val",0);
    }
    var thisDate = yil+"-"+(ay+1)+"-"+gun ;
    var formData = new FormData();
    formData.append("thisDate",thisDate);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var jsonData = JSON.parse(this.responseText);
            for(var i = 0; i< jsonData.length; i++){
                DaysCount[jsonData[i][0]].innerHTML = jsonData[i][1]+" Randevu var";
                Days[jsonData[i][0]].setAttribute("val",jsonData[i][1]);
            }
        }
    };
    xhr.open("POST", "php/script.php?val=randevular", true);
    xhr.send(formData);


    for(i = 0; i< gunSayisi; i++){
        Days[i].setAttribute("datetime",yil+"-"+(ay+1)+"-"+(i+1));
    }
    for(i = 0; i < gunSayisi; i++){
        if(i<gun-1){
            Days[i].classList.remove("d-none");
            Days[i].classList.add("past");
        }
    }
    for(i = gunSayisi; i < 31; i++){
        Days[i].classList.add("d-none");
    }


    var nextMonth = document.getElementById("nextMonth");
    var backMonth = document.getElementById("backMonth");
    nextMonth.addEventListener("click",(e)=>{
        ay = ay+1;
        if(ay==12){ay=0; yil = yil+1}
        var gunSayisi = ayinSonGununuBul(ay+1, yil);
        for(var i = 0; i< 31; i++){
            DaysCount[i].innerHTML = "Randevu Bulunmuyor";
            Days[i].setAttribute("val",0);
        }
        var thisDate = yil+"-"+(ay+1)+"-"+gun ;
        var formData = new FormData();
        formData.append("thisDate",thisDate);
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var jsonData = JSON.parse(this.responseText);
                for(var i = 0; i< jsonData.length; i++){
                    DaysCount[jsonData[i][0]].innerHTML = jsonData[i][1]+" Randevu var";
                    Days[jsonData[i][0]].setAttribute("val",jsonData[i][1]);
                }
            }
        };
        xhr.open("POST", "php/script.php?val=randevular", true);
        xhr.send(formData);
        for(i = 0; i < gunSayisi; i++){
            if((yilNow > yil) || (yilNow== yil && ayNow > ay) || (yilNow== yil && ayNow == ay && i < gun-1)){
                Days[i].classList.add("past");
            }
            else{
                Days[i].classList.remove("past");
            }
            Days[i].classList.remove("d-none");
        }
        for(i = gunSayisi; i < 31; i++){
            Days[i].classList.add("d-none");
        }
        if(yilNow== yil && ayNow == ay){
            Days[gun-1].classList.add("today");
        }
        else{
            Days[gun-1].classList.remove("today");
        }
        for(i = 0; i< gunSayisi; i++){
            Days[i].setAttribute("datetime",yil+"-"+(ay+1)+"-"+(i+1));
        }
        calendarTitleMonth.innerHTML = aylar[ay]; 
        calendarTitleYear.innerHTML = yil; 
    });
    backMonth.addEventListener("click",(e)=>{
        ay = ay-1;
        if(ay==-1){ay=11; yil = yil-1}
        var gunSayisi = ayinSonGununuBul(ay+1, yil);
        for(var i = 0; i< 31; i++){
            DaysCount[i].innerHTML = "Randevu Bulunmuyor";
            Days[i].setAttribute("val",0);
        }
        var thisDate = yil+"-"+(ay+1)+"-"+gun ;
        var formData = new FormData();
        formData.append("thisDate",thisDate);
        var xhr1 = new XMLHttpRequest();
        xhr1.onreadystatechange = function () {
            if (xhr1.readyState == 4 && xhr1.status == 200) {
                var jsonData = JSON.parse(this.responseText);
                for(var i = 0; i< jsonData.length; i++){
                    DaysCount[jsonData[i][0]].innerHTML = jsonData[i][1]+" Randevu var";
                    Days[jsonData[i][0]].setAttribute("val",jsonData[i][1]);
                }
            }
        };
        xhr1.open("POST", "php/script.php?val=randevular", true);
        xhr1.send(formData);
        for(i = 0; i < gunSayisi; i++){
            if((yilNow > yil) || (yilNow== yil && ayNow > ay) || (yilNow== yil && ayNow == ay && i < gun-1)){
                Days[i].classList.add("past");
            }
            else{
                Days[i].classList.remove("past");
            }
            Days[i].classList.remove("d-none");
        }
        for(i = gunSayisi; i < 31; i++){
            Days[i].classList.add("d-none");
        }
        if(yilNow== yil && ayNow == ay){
            Days[gun-1].classList.add("today");
        }
        else{
            Days[gun-1].classList.remove("today");
        }
        for(i = 0; i< gunSayisi; i++){
            Days[i].setAttribute("datetime",yil+"-"+(ay+1)+"-"+(i+1));
        }
        calendarTitleMonth.innerHTML = aylar[ay]; 
        calendarTitleYear.innerHTML = yil; 
    });

/*
    Days.addEventListener("click",(day)=>{
        if(day.setAttribute("datetime")){

        }
    });
*/

</script>