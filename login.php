<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <label for="userName">TCKN</label>
                        <input class="form-control mb-2 mt-1" type="text" name="userName" id="loginUsername">
                        <label for="password">Şifre</label>
                        <input class="form-control mb-4 mt-1" type="password" name="password" id="loginPassword">
                        <div class="d-flex"> 
                            <input class="mb-3" type="checkbox" name="showPass" id="showPass">
                            <span class="ms-2">Şifreyi Göster</span>
                            <button class="btn btn-primary ms-auto">Giriş</button>
                        </div>
                    </form>
                    <hr>
                </div>
                <p class="px-2 text-center text-wrap" style="max-width: 400px;">Kayıt olmak için <a href="">buraya</a> tıklayın.</p>

            </div>
        </div>
    </div>
</body>
</html>

<script src="js/bootstrap.bundle.min.js"></script>