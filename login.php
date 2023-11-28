<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="position-relative">
    <div id="login-main-page-background"></div>
    <div id="login-main-page";>
        <div class="container my-5 py-5">
            <div class="card bg-transparent mb-2">
                <div class="login-card-background"></div>
                <div class="card-body">
                    <h3 class="fw-bold title">Giriş Yap</h3>
                    <form action="" id="kaydol">
                        <label for="tckn">TCKN</label>
                        <input class="form-control mb-2 mt-1 inputNumber" placeholder="12345678910" type="text" maxlength="11" name="tckn" id="logintckn">
                        <label for="password">Şifre</label>
                        <input class="form-control mb-2 mt-1" type="password" name="password" id="loginPassword">
                        <p class="text-danger mb-2" style="display: none;" id="loginWar">*Hatalı Giriş</p>
                        <div class="d-flex"> 
                            <input class="mb-3" type="checkbox" name="showPass" id="showPass">
                            <label for="showPass" class="ms-2">Şifreyi Göster</label>
                            <button type="submit" class="btn btn-primary ms-auto">Giriş</button>
                        </div>
                    </form>
                    <hr>
                </div>
                <p class="px-2 text-center text-wrap" style="max-width: 400px;">Kayıt olmak için <a href="create-account.php">buraya</a> tıklayın.</p>

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
var loginWar = document.getElementById("loginWar");
showCheckBox.addEventListener("click",function(){
    if(showCheckBox.checked){password.type = "text";}
    else{password.type = "password";}
})

var tckn = document.getElementById("logintckn");
var kaydol = document.getElementById("kaydol");
kaydol.addEventListener("submit",function(event){
    event.preventDefault();
    var error = false;
    if(tckn.value == "" || tckn.value.length < 11){
        tckn.style.border = "1px solid rgb(245, 55, 55)";
        loginWar.style.display = "flex";
        error = true;
    }
    else{
        tckn.style.border = "none";
        loginWar.style.display = "none";
    }
    
    if(!error){kaydol.submit();}
    
});
</script>