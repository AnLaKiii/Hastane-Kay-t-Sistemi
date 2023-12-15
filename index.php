<?php
session_start();
if(!isset($_SESSION['hasta'])){
    header("Location: /Hastane-Kayit-Sistemi/login.php");
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
    <?php include "php/connect.php";?>
    <section class="pt-3 px-2 flex-xxl-row flex-column d-flex w-100" style="z-index: 0;" >
        <div class="col-xxl-2 mb-2">
            <div class="row ms-0 w-100">
                <a href="rendevual.php" class="text-white col-12 col-sm-6 col-xxl-12 mb-2">
                    <div class="card card-color rounded-0 ">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-stethoscope"></i>
                                <h5 class="card-title mb-0 ms-2">Randevu Al</h5>
                            </div>
                        </div>
                    </div>  
                </a>
                <a href="" class="text-white col-12 col-sm-6 col-xxl-12 mb-2">
                    <div class="card card-color rounded-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-calendar"></i>
                                <h5 class="card-title mb-0 ms-2">Randevularım</h5>
                            </div>
                        </div>
                    </div>  
                </a>
            </div>
        </div>
        <div class="col-xxl-8 flex-wrap">
            <div class="mx-2 col  col-md-6 col-lg-3">
                <select class="form-select shadow-none mb-3" id="filtre" name="filtre">
                    <option selected value="1">hepsi</option>
                    <option value="2">Aktif</option>
                    <option value="3">Tamamlanan</option>
                    <option value="4">Tamamlanamayan</option>
                </select>
            </div>
            <div class="d-flex flex-wrap w-100">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2 pt-0 pb-3 rese-info">
                    <div class="rounded-0 card">
                        <canvas class="qrcode p-4"></canvas>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Şehir Hastanesi <small class="text-warning">(aktif)</small></h5>
                            <hr>
                            <ul class="p-0">
                                <li>
                                    <i class="fa-solid fa-clipboard"></i>
                                    <small>Kardiyoloji</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-user-doctor"></i>
                                    <small>Mehmet Gözütok</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-calendar"></i>
                                    <small>25.12.2023</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-clock"></i>
                                    <small>11:30</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-location-dot"></i>
                                    <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, veniam!</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2 pt-0 pb-3 rese-info">
                    <div class="rounded-0 card">
                        <canvas class="qrcode p-4"></canvas>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Şehir Hastanesi <small class="text-danger">(iptal)</small></h5>
                            <hr>
                            <ul class="p-0">
                                <li>
                                    <i class="fa-solid fa-clipboard"></i>
                                    <small>Kardiyoloji</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-user-doctor"></i>
                                    <small>Mehmet Gözütok</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-calendar"></i>
                                    <small>25.08.2023</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-clock"></i>
                                    <small>11:30</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-location-dot"></i>
                                    <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, veniam!</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 p-2 pt-0 pb-3 rese-info">
                    <div class="rounded-0 card">
                        <canvas class="qrcode p-4"></canvas>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Şehir Hastanesi <small class="text-success">(tamamlandı)</small></h5>
                            <hr>
                            <ul class="p-0">
                                <li>
                                    <i class="fa-solid fa-clipboard"></i>
                                    <small>Kardiyoloji</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-user-doctor"></i>
                                    <small>Mehmet Gözütok</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-calendar"></i>
                                    <small>25.07.2023</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-clock"></i>
                                    <small>11:30</small>
                                </li>
                                <li>
                                    <i class="fa-solid fa-location-dot"></i>
                                    <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, veniam!</small>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-2">

            <div class="card person-info rounded-bottom">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 fw-bold">Abdülbaki Demir</h5>
                    </div>
                    <hr>
                    <ul class="p-0">
                        <li>
                            <i class="fa-solid fa-id-badge"></i>
                            <small>75248652485</small>
                        </li>
                        <li>
                            <i class="fa-solid fa-calendar"></i>
                            <small>16.06.2002</small>
                        </li>
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, veniam!</small>
                        </li>
                    </ul>
                </div>
            </div>  
        </div>

    </section>
    <?php include "php/footer.php";?> 
  </div>
</body>
</html>


<script src="js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
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
var search_box =document.getElementById("search-box1");
var input_box =document.getElementById("input-box1");
var search_button =document.getElementById("search-button1");
var write = document.getElementById("write1");
var input = document.getElementById("input1");
var change = document.getElementById("sadas");

function click(){
    change.style.setProperty('--num','100');
    change.classList.toggle("saw");
}


function showHint(str){
    if(str.length != 0){
        var xhr = new XMLHttpRequest();
            var data = JSON.stringify({ input: str })
            xhr.open('GET', 'verileri_getir.php?input='+str, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                write.innerHTML = xhr.responseText;
                } else if (xhr.readyState === 4) {
                }
            }
            xhr.send();
    }
    else{
        write.innerHTML = "";
    }
}


var qrCodes = document.querySelectorAll(".qrcode");
for(var i = 0; i < qrCodes.length; i ++){
    const qr = new QRious({ element: qrCodes[i], value: "https://abdulbakidemir.com", size: 800 , backgroundAlpha: 0});
}


</script>