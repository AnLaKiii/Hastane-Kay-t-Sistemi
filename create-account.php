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
            <div class="card bg-transparent mb-2">
                <div class="login-card-background"></div>
                <div class="card-body">
                    <h3 class="fw-bold title">Kayıt Ol</h3>
                    <form id="kaydol" action="">
                        <label for="name">İsim</label>
                        <input class="form-control mb-2 mt-1" type="text" name="name" id="name">
                        <label for="lastName">Soyisim</label>
                        <input class="form-control mb-2 mt-1" type="text" name="lastName" id="lastName">
                        <label for="tckn">TCKN</label>
                        <input class="form-control mb-2 mt-1 inputNumber" placeholder="12345678910" type="text" maxlength="11" minlength="11" name="tckn" id="logintckn">
                        <label for="password">Şifre</label>
                        <input class="form-control mb-2 mt-1" placeholder="En az 8 karakter" type="password" minlength="8" name="password" id="loginPassword">
                        <label for="passwordCheck">Şifre Kontrol</label>
                        <input class="form-control mb-2 mt-1" type="password" minlength="8" name="passwordCheck" id="loginPasswordCheck" title="Şifreler aynı değil">
                        <p class="text-danger" id="passWar" style="display: none;">Şifre uyuşmuyor</p>
                        <input class="mb-3" type="checkbox" name="showPass" id="showPass">
                        <label for="showPass" class="ms-2">Şifreyi Göster</label>
                        <br>
                        <label for="tel">Tel</label>
                        <input class="form-control mb-2 mt-1 inputNumber" type="tel" name="tel" id="tel" placeholder="(555) 555 55 55">
                        <label for="date">Doğum Tarihi</label>
                        <input class="form-control mb-4 mt-1" type="date" name="date" id="date">
                        <button type="submit" class="btn btn-primary ms-auto">Kaydol</button>
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
        if(!isNaN(event.key) || event.key == "Backspace"){
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

var passWar = document.getElementById("passWar");
var kaydol = document.getElementById("kaydol");
kaydol.addEventListener("submit",function(event){
    event.preventDefault();
    if(password.value != passwordCheck.value){
        passWar.style.display = "flex";
    }
});
</script>