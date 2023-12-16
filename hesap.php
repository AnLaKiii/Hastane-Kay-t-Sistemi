<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
    <title>Hesap</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
</head>
<body style="margin-top:6rem">
    <?php include "php/navbar.php";
        include "php/connect.php";
        $SQL = "SELECT Hasta.*, CONCAT(AcikAdres,' - ',Ilce,' / ',Sehir) AS Adres FROM Hasta
        INNER JOIN Adres ON Hasta.HastaID = Adres.HastaID
        WHERE Hasta.HastaID = ".$_SESSION["hasta"];
        $result = $conn->query($SQL);
        $row = $result->fetch_assoc();
        $row["DogumTarihi"] = date("d.n.Y", strtotime($row["DogumTarihi"]));
        $conn->close();
    ?>
    <div class="container-xxl hesap">
        <div class="row">
            <div class="col-11 col-md-8 col-xl-6 mx-auto">
                <h5 class="fw-bold">Kimlik Bilgileri</h5>
                <hr>
                <table class="mb-4">
                    <tbody class="px-3 row gap-2">
                        <tr class="row">
                            <th class="col-4">İsim:</th>
                            <td class="col-8"><?php echo $row["HastaAdi"] ;?></td>
                        </tr>
                        <tr class="row">
                            <th class="col-4">Soyisim:</th>
                            <td class="col-8"><?php echo $row["Soyadi"] ;?></td>
                        </tr>
                        <tr class="row">
                            <th class="col-4">TCKN</th>
                            <td class="col-8"><?php echo $row["TCKimlikNo"] ;?></td>
                        </tr>
                        <tr class="row">
                            <th class="col-4">Doğum Tarihi</th>
                            <td class="col-8"><?php echo $row["DogumTarihi"] ;?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold">İletişim Bilgileri</h5>
                    <small id="duzenle"  style="cursor:pointer">Düzenle</small>
                </div>
                <hr>
                <table class="mb-4">
                    <tbody class="px-3 row gap-2">
                        <tr class="row">
                            <th class="col-4">Telefon:</th>
                            <td class="col-8"><?php echo $row["HastaTelefonNo"] ;?></td>
                        </tr>
                        <tr class="row">
                            <th class="col-4">E-posta</th>
                            <td class="col-8"><?php echo $row["HastaEmail"] ;?></td>
                        </tr>
                        <tr class="row">
                            <th class="col-4">Adres</th>
                            <td class="col-8"><?php echo $row["Adres"] ;?></td>
                        </tr>
                    </tbody>
                </table>
                <h5 class="fw-bold">Şifre</h5>
                <hr>
                <form action="" id="sifreGuncelle">
                    <label for="" class="w-100">
                        Mevcut Şifre
                        <input type="password" id="pass0" class="w-100">
                    </label>
                    <div class="alert alert-danger d-none" id="sifreErr" role="alert">
                        Kullanıcı şifren hatalı
                    </div>
                    <label for="" class="w-100">
                        Yeni Şifre
                        <input type="password" id="pass1" class="w-100">
                    </label>
                    <label for="" class="w-100">
                        Yeni Şifre Tekrar
                        <input type="password" id="pass2" class="w-100">
                    </label>
                    <div class="alert alert-danger d-none" id="sifreErr2" role="alert">
                        Yeni girilen şifreler hatalı. 
                    </div>
                    <label for="showPass" class="ms-2 d-flex align-items-center">
                        <input class="me-2" type="checkbox" name="showPass" id="showPass">
                        Şifreyi Göster
                    </label>
                    <button class="btn btn-primary" id="sifreChange">Şifre Güncelle</button>
                </form>
            </div>
        </div>
    </div>
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
    </div>
    <div id="cominSet" class="mx-auto hesap card row">
        <div class="card-body col-11 col-md-8 col-xl-6">
            <div class="d-flex justify-content-between align-items-center" style="cursor:pointer">
                    <h5 class="fw-bold">Bilgileri Güncelle</h5>
                    <i id="closeComin" class="fa-solid fa-xmark"></i>
            </div>
            <hr>
            <form action="" id="cominSetForm" class="w-100 px-0 mx-0">
                <label for="" class="w-100">
                    Telefon
                    <input type="tel" class="w-100 inputNumber" maxlength="10" placeholder="(555) 555 55 55">
                </label>
                <label for="" class="w-100">
                    E-posta
                    <input type="email" class="w-100">
                </label>
                <label for="" class="w-100">
                    Adres
                    <input type="text" class="w-100">
                </label>
                <button class="btn btn-primary">Bilgileri Güncelle</button>
            </form>
        </div>
    </div>
</body>
</html>

<script src="js/bootstrap.bundle.min.js"></script>
<script>
    var cominSet = document.getElementById("cominSet");
    var closeComin = document.getElementById("closeComin");
    var duzenle = document.getElementById("duzenle");
    duzenle.addEventListener("click",function(e){
        cominSet.classList.add("active1");
    });
    closeComin.addEventListener("click",function(e){
        cominSet.classList.remove("active1");
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

    var inputNumber = document.querySelectorAll(".inputNumber");
    for (var i = 0; i < inputNumber.length ; i++){
        inputNumber[i].addEventListener("keydown", function(event){
            if(!isNaN(event.key) || event.key == "Backspace" || event.key == "Tab"){
            }
            else{
                event.preventDefault();
            }
        });
    }

    // Toast Message
    var button = document.querySelector(".btn"),
        toast = document.querySelector(".toast1")
        closeIcon = document.querySelector(".close"),

        
    closeIcon.addEventListener("click", () => {
        toast.classList.remove("toastActive")
    });



    var showCheckBox = document.getElementById("showPass");
    var password0 = document.getElementById("pass0");
    var password = document.getElementById("pass1");
    var passwordCheck = document.getElementById("pass2");
    var sifreAlert = document.getElementById("sifreErr");
    var sifreAlert2 = document.getElementById("sifreErr2");
    showCheckBox.addEventListener("click",function(){
        if(showCheckBox.checked){password0.type = "text";;password.type = "text"; passwordCheck.type = "text";}
        else{password0.type = "password";password.type = "password"; passwordCheck.type = "password";}
    });

    var sifreGuncelle = document.getElementById("sifreGuncelle");
    sifreGuncelle.addEventListener("submit", function(event){
        event.preventDefault();
        var check = true;
        if(password.value.length < 8){
            check = false;
        }
        if(passwordCheck.value != password.value){
            check = false;
        }
        if(check){
            sifreAlert2.classList.add("d-none");
            sifreAlert.classList.add("d-none");
            var formData = new FormData();
            formData.append("sifre",password0.value);
            formData.append("Ysifre",password.value);
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                if(xhr.response == 1){
                    toast.classList.add("toastActive");
                    sifreAlert.classList.add("d-none");

                }
                else{
                    sifreAlert.classList.remove("d-none");
                }
            }};
            xhr.open("POST", "php/script.php?val=sifreUpdate", true);
            xhr.send(formData);
        }
        else{
            sifreAlert2.classList.remove("d-none");
        }
    });
    var cominSetForm = document.getElementById("cominSetForm");
    cominSetForm.addEventListener("submit", function(event){
        event.preventDefault();
        var check = true;
        if(password.value.length < 8){
            check = false;
        }
        if(passwordCheck.value != password.value){
            check = false;
        }
        if(check){
            toast.classList.add("toastActive")
        }
        else{

        }
    });
</script>