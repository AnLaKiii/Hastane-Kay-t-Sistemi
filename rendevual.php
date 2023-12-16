<?php
session_start();
if(!isset($_SESSION['hasta'])){
    header("Location: /Hastane-Kayit-Sistemi/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Randevu Al</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
</head>
<body style="margin-top:6rem">
    <?php include "php/navbar.php";?>
    <div class="mx-auto mt-3">
        <div class="toast1" style="--toastColor:#0f0">
            <div class="toast-content">
                <i id="toastIcon" class="fas fa-solid fa-check check"></i>
                <div class="message">
                    <span class="text text-1">Başarılı</span>
                    <span class="text text-2">Güncelleme Uygulandı</span>
                </div>
            </div>
            <i class="fa-solid fa-xmark close"></i>
            <div class="progress"></div>
        </div>
        <div class="">
            <form action="" id="randevuAl" class="w-100">
                <div class="row m-0 ">
                    <div class="col-11 col-sm-8 col-lg-6 col-xxl-4">
                        <label class="mb-5" for="bolum">Bölüm</label>
                        <p>Randevu almak istediğn bölümü seç.</p>
                        <select class="inputs form-select shadow-none mb-3" id="bolum" name="bolum">
                            <option value="0">Seçilmedi</option>
                        </select>
                        <div class="w-100  d-flex justify-content-end">
                            <button  class="btn btn-primary btnI disabled">İleri</button>
                        </div>
                    </div>
                </div>
                <div class="row m-0 d-none">
                    <div class="col-11 col-sm-8 col-lg-6 col-xxl-4">
                        <label class="mb-5" for="doktor">Doktor</label>
                        <p>Randevu almak istediğiniz dokrotu seçin</p>
                        <select class="inputs form-select shadow-none mb-3" id="doktor" name="doktor">
                        </select>
                        <div class="w-100  d-flex justify-content-between">
                            <button class="btn btn-primary btnG">Geri</button>
                            <button class="btn btn-primary btnI disabled">İleri</button>
                        </div>
                    </div>
                </div>
                <div class="row m-0 d-none">
                    <div class="col-11 col-sm-8 col-lg-6 col-xxl-4">
                        <label class="mb-5" for="tarihSec">Tarih Seçiniz</label>
                        <p>Randevu almak istediniz tarihi seçin</p>
                        <input type="date" class="inputs form-control mb-3" id="tarihSec" name="date">
                        <div class="alert alert-danger d-none" role="alert" id="dateAlert">
                            Bu tarihteki tüm randevular dolu. Başka bir tarih seç.
                        </div>
                        <div class="w-100  d-flex justify-content-between">
                            <button class="btn btn-primary btnG">Geri</button>
                            <button class="btn btn-primary btnI disabled">İleri</button>
                        </div>
                    </div>
                </div>
                <div class="row m-0 d-none">
                    <div class="col-11 col-sm-8 col-lg-6 col-xxl-4">
                        <label class="mb-5" for="saat">Saat</label>
                        <p>Randevu almak istediğiniz saati seçin</p>
                        <select class="inputs form-select shadow-none mb-3" id="saat" name="saat">
                        </select>
                        <div class="w-100  d-flex justify-content-between">
                            <button class="btn btn-primary btnG">Geri</button>
                            <button type="submit" class="btn btn-primary btnI disabled">Randevu Al</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>    
    </div>
</body>
</html>

<script src="js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; // Ocak 0, Şubat 1, ..., Aralık 11
        var yyyy = today.getFullYear();

        if (dd < 10) {
        dd = '0' + dd;
        }

        if (mm < 10) {
        mm = '0' + mm;
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById('tarihSec').setAttribute('min', today);
    });

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

    

    // Toast Message
    const button = document.querySelector(".btn"),
        toast = document.querySelector(".toast1")
        closeIcon = document.querySelector(".close"),

    button.addEventListener("click", () => {
        toast.classList.add("active")
    });
        
    closeIcon.addEventListener("click", () => {
        toast.classList.remove("active")
    });
    var randevual = document.getElementById("randevuAl");
    randevual.addEventListener("submit",function(e){
        e.preventDefault();
    });
    var dateAlert = document.getElementById("dateAlert");
    var forms = document.querySelectorAll("#randevuAl > div");
    var inputs = document.querySelectorAll("#randevuAl > div > div > .inputs");
    var bolumBtnI = document.querySelectorAll(".btnI");
    var bolumBtnG = document.querySelectorAll(".btnG");
    inputs.forEach(function(input,i){
        input.setAttribute("sec",i);
        if(i == 0){
            var formData = new FormData(randevual);
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    input.innerHTML = input.innerHTML + xhr.response;
                }
            };
            xhr.open("POST", "php/script.php?val=randevu&bol=1", true);
            xhr.send(formData);
        }
        input.addEventListener("change",function(e){
            var id = e.target.getAttribute("sec");
            if(e.target.value != 0){
                bolumBtnI[id].classList.remove("disabled");
            }
            else{
                bolumBtnI[id].classList.add("disabled");
            }
            if(id == 0){
                var formData = new FormData();
                formData.append("bolum",input.value);
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    inputs[1].innerHTML = xhr.response;
                }};
                xhr.open("POST", "php/script.php?val=randevu&doc=1", true);
                xhr.send(formData);
            }
            else if(id == 2){
                var formData = new FormData();
                formData.append("doktorID",inputs[1].value);
                formData.append("date",inputs[2].value);
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if(xhr.response == ""){
                        dateAlert.classList.remove("d-none");
                        bolumBtnI[2].classList.add("disabled");
                    }
                    else{
                        dateAlert.classList.add("d-none");
                        inputs[3].innerHTML = xhr.response;
                    }
                }};
                xhr.open("POST", "php/script.php?val=randevu&date=1", true);
                xhr.send(formData);
            }
        });
    });
    bolumBtnI.forEach(function(btnI,i){
        btnI.setAttribute("sec",i)
        btnI.addEventListener("click",function(e){  
            var id = e.target.getAttribute("sec");
            if(id != "3"){
                forms[id].classList.add("d-none");
                forms[parseInt(id)+1].classList.remove("d-none");
            }
            else{
                e.target.classList.add("disabled");
                var formData = new FormData(randevual);
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        var val = xhr.responseText;
                        if(val == 1){
                            var toast = document.querySelector(".toast1").classList.add("toastActive");
                            setTimeout(function(){
                                window.location.href = "/Hastane-Kayit-Sistemi/";
                            },1500);
                        }
                        else{
                            e.target.classList.remove("disabled");
                        }
                    }
                };
                xhr.open("POST", "php/script.php?val=randevu&fin=1", true);
                xhr.send(formData);
            }
           
        });
    });
    bolumBtnG.forEach(function(btnG,i){
        btnG.setAttribute("sec",i)
        btnG.addEventListener("click",function(e){  
            var id = e.target.getAttribute("sec");
            forms[parseInt(id)+1].classList.add("d-none");
            forms[parseInt(id)].classList.remove("d-none");
        });
    });

</script>