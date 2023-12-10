<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaydol</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="position-relative">
    <div id="login-main-page-background"></div>
    <div id="login-main-page";>
        <div class="container">
            <div class="card bg-transparent my-5 py-5">
                <div class="login-card-background"></div>
                <div class="card-body">
                    <h3 class="fw-bold title">Kayıt Ol</h3>
                    <form id="kaydol" action="">
                        <label class="mt-2" for="name">İsim</label>
                        <input class="form-control mt-1" type="text" name="name" id="namei">
                        <p class="text-danger mb-0 mt-1" id="nameWar" style="display: none;">*Lütfen isim girin</p>
                        <label class="mt-2" for="lastName">Soyisim</label>
                        <input class="form-control mt-1" type="text" name="lastName" id="lastName">
                        <p class="text-danger mb-0 mt-1" id="lastNameWar" style="display: none;">*Lütfen soyisim girin</p>
                        <label class="mt-2" for="tckn">TCKN</label>
                        <input class="form-control mt-1 inputNumber" placeholder="12345678910" maxlength="11" type="text" name="tckn" id="logintckn">
                        <p class="text-danger mb-0 mt-1" id="tcWar" style="display: none;">*Lütfen geçerli TC kimlik numaranızı girin</p>
                        <label class="mt-2" for="password">Şifre</label>
                        <input class="form-control mt-1" placeholder="En az 8 karakter" type="password" name="password" id="loginPassword">
                        <p class="text-danger mb-0 mt-1" id="passWar" style="display: none;">*Şifre 8 karakterden büyük olmalı</p>
                        <label class="mt-2" for="passwordCheck">Şifre Kontrol</label>
                        <input class="form-control mt-1" type="password" name="passwordCheck" id="loginPasswordCheck">
                        <p class="text-danger mb-0 mt-1" id="passCheckWar" style="display: none;">*Şifre uyuşmuyor</p>
                        <input class="mb-3" type="checkbox" name="showPass" id="showPass">
                        <label for="showPass" class="ms-2">Şifreyi Göster</label>
                        <br>
                        <label class="" for="tel">Tel</label>
                        <input class="form-control mt-1 inputNumber" type="tel" name="tel" id="tel" maxlength="10" placeholder="(555) 555 55 55">
                        <p class="text-danger mb-0 mt-1" id="telWar" style="display: none;">*Lütfen geçerli bir telefon numarası girin</p>
                        <label class="mt-2" for="date">Doğum Tarihi</label>
                        <input class="form-control mt-1" type="date" name="date" id="date">
                        <p class="text-danger mb-0 mt-1" id="dateWar" style="display: none;">*Lütfen doğum tarihi girin</p>
                        <button type="submit" class="btn btn-primary ms-auto mt-3">Kaydol</button>
                    </form>
                    <hr>
                </div>
                <p class="px-2 text-center text-wrap" style="max-width: 400px;">Giriş yapmak için <a href="login.php">buraya</a> tıklayın.</p>

            </div>
        </div>
    </div>
</body>
</html>

<script src="js/bootstrap.bundle.min.js"></script>
<script>
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
var showCheckBox = document.getElementById("showPass");
var password = document.getElementById("loginPassword");
var passwordCheck = document.getElementById("loginPasswordCheck");
showCheckBox.addEventListener("click",function(){
    if(showCheckBox.checked){password.type = "text"; passwordCheck.type = "text";}
    else{password.type = "password"; passwordCheck.type = "password";}
});

var name2 = document.getElementById("namei");
var nameWar = document.getElementById("nameWar");
var lastname = document.getElementById("lastName");
var lastnameWar = document.getElementById("lastNameWar");
var tckn = document.getElementById("logintckn");
var tcWar = document.getElementById("tcWar"); 
var passWar = document.getElementById("passWar");
var passCheckWar = document.getElementById("passCheckWar");
var tel = document.getElementById("tel");
var telWar = document.getElementById("telWar"); 
var date = document.getElementById("date");
var dateWar = document.getElementById("dateWar");
var kaydol = document.getElementById("kaydol");
kaydol.addEventListener("submit",function(event){
    event.preventDefault();
    var error = false;
    if(name2.value == ""){
        name2.style.border = "1px solid rgb(245, 55, 55)";
        nameWar.style.display = "flex";
        error = true;
    }
    else{
        name2.style.border = "none";
        nameWar.style.display = "none";
    }
    if(lastname.value == ""){
        lastname.style.border = "1px solid rgb(245, 55, 55)";
        lastnameWar.style.display = "flex";
        error = true;
    }
    else{
        lastname.style.border = "none";
        lastnameWar.style.display = "none";
    }
    if(tckn.value == "" || tckn.value.length < 11){
        tckn.style.border = "1px solid rgb(245, 55, 55)";
        tcWar.style.display = "flex";
        error = true;
    }
    else{
        tckn.style.border = "none";
        tcWar.style.display = "none";
    }
    if(password.value == "" || password.value.length < 8){
        password.style.border = "1px solid rgb(245, 55, 55)";
        passWar.style.display = "flex";
        error = true;
    }
    else{
        password.style.border = "none";
        passWar.style.display = "none";
    }
    if(tel.value == "" || tel.value.length < 10){
        tel.style.border = "1px solid rgb(245, 55, 55)";
        telWar.style.display = "flex";
        error = true;
    }
    else{
        tel.style.border = "none";
        telWar.style.display = "none";
    }
    if(date.value == ""){
        date.style.border = "1px solid rgb(245, 55, 55)";
        dateWar.style.display = "flex";
        error = true;
    }
    else{
        date.style.border = "none";
        dateWar.style.display = "none";
    
    }
    if(password.value != passwordCheck.value){
        passwordCheck.style.border = "1px solid rgb(245, 55, 55)";
        passCheckWar.style.display = "flex";
        error = true;
    
    }
    else{
        passwordCheck.style.border = "none";
        passCheckWar.style.display = "none";
    
    }
    if(!error){kaydol.submit();}
    
});
</script>