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

    <section class="pt-3 px-2 flex-xxl-row flex-column d-flex w-100" style="z-index: 0;" >


    </section>
    <?php include "php/footer.php";?> 
  </div>
</body>
</html>


<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/qrious.min.js"></script>
<script>

    var randevular = document.getElementById("randevular");
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
        randevular.innerHTML = xhr.response;
        var qrCodes = document.querySelectorAll(".qrcode");
        for(var i = 0; i < qrCodes.length; i ++){
            var val = qrCodes[i].getAttribute("value");
            const qr = new QRious({ element: qrCodes[i], value: "randevudetay.php?val="+val, size: 800 , backgroundAlpha: 0});
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