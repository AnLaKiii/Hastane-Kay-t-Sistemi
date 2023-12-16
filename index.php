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
    <?php include "php/connect.php";
    
    $conn->close();
    ?>

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
            </div>
        </div>
        <div class="col-xxl-8 flex-wrap" style="min-height: 100vh;">
            <div class="mx-2 col  col-md-6 col-lg-3">
                <select class="form-select shadow-none mb-3" id="filtre" name="filtre">
                    <option selected value="1">Tüm Randevular</option>
                    <option value="2">Aktif Randevular</option>
                    <option value="3">Geçmiş Pasif</option>
                </select>
            </div>
            <div class="d-flex flex-wrap w-100" id="randevular">

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

    var randevular = document.getElementById("randevular");
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        randevular.innerHTML = xhr.response;
        var qrCodes = document.querySelectorAll(".qrcode");
        for(var i = 0; i < qrCodes.length; i ++){
            var val = qrCodes[i].getAttribute("value");
            const qr = new QRious({ element: qrCodes[i], value: "https://abdulbakidemir.com?val="+val, size: 800 , backgroundAlpha: 0});
        }
    }};
    xhr.open("POST", "php/script.php?val=randevular", true);
    xhr.send();

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

    var filtre = document.getElementById("filtre");
    filtre.addEventListener("change",function(e){
        var val = e.target.value;
        if(val == 1){
            var ranBoxes = document.querySelectorAll(".ranPasive.d-none");
            ranBoxes.forEach(function(ranBox){
                ranBox.classList.remove("d-none");
            });
            var ranBoxes = document.querySelectorAll(".ranActive.d-none");
            ranBoxes.forEach(function(ranBox){
                ranBox.classList.remove("d-none");
            });
        }
        else if(val == 2){
            var ranBoxes = document.querySelectorAll(".ranPasive.d-none");
            ranBoxes.forEach(function(ranBox){
                ranBox.classList.remove("d-none");
            });
            var ranBoxes = document.querySelectorAll(".ranPasive");
            ranBoxes.forEach(function(ranBox){
                ranBox.classList.add("d-none");
            });
            var ranBoxes = document.querySelectorAll(".ranActive.d-none");
            ranBoxes.forEach(function(ranBox){
                ranBox.classList.remove("d-none");
            });
        }
        else if(val == 3){
            var ranBoxes = document.querySelectorAll(".ranActive.d-none");
            ranBoxes.forEach(function(ranBox){
                ranBox.classList.remove("d-none");
            });
            var ranBoxes = document.querySelectorAll(".ranActive");
            ranBoxes.forEach(function(ranBox){
                ranBox.classList.add("d-none");
            });
            var ranBoxes = document.querySelectorAll(".ranPasive.d-none");
            ranBoxes.forEach(function(ranBox){
                ranBox.classList.remove("d-none");
            });
        }
    });






</script>