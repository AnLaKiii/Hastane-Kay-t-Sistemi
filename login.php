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
        <div class="container">
            <div class="card bg-transparent mb-2">
                <div class="login-card-background"></div>
                <div class="card-body">
                    <h3 class="fw-bold title">Giriş Yap</h3>
                    <form action="">
                        <label for="tckn">TCKN</label>
                        <input class="form-control mb-2 mt-1 inputNumber" placeholder="12345678910" type="text" maxlength="11" minlength="11" name="tckn" id="logintckn" title="Geçerli bir TC Kimlik Numarası girin (11 hane)">
                        <label for="password">Şifre</label>
                        <input class="form-control mb-4 mt-1" type="password" name="password" id="loginPassword">
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
showCheckBox.addEventListener("click",function(){
    if(showCheckBox.checked){password.type = "text";}
    else{password.type = "password";}
})
</script>