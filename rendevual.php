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
                <i class="fas fa-solid fa-check check"></i>
                <div class="message">
                    <span class="text text-1">Başarılı</span>
                    <span class="text text-2">Randevu Oluşturuldu</span>
                </div>
            </div>
            <i class="fa-solid fa-xmark close"></i>

            <div class="progress"></div>
        </div>
        <div class="row">
            <form action="" id="randevuAl" class="col-11 col-lg-8 col-xxl-6 mx-auto">
                <label for="bolum">Bölüm</label>
                <select class="form-select shadow-none mb-3" id="bolum" name="bolum">
                    <option selected>Seçilmedi</option>
                    <option value="bolum1">Bolum 1</option>
                    <option value="bolum2">Bolum 2</option>
                    <option value="bolum3">Bolum 3</option>
                    <option value="bolum4">Bolum 4</option>
                </select>
                <label for="doktor">Doktor</label>
                <select class="form-select shadow-none mb-3" id="doktor" name="doktor">
                    <option selected>Seçilmedi</option>
                    <option value="doktor1">Doktor 1</option>
                    <option value="doktor2">Doktor 2</option>
                    <option value="doktor3">Doktor 3</option>
                    <option value="doktor4">Doktor 4</option>
                </select>
                <label for="tarihSec">Tarih Seçiniz:</label>
                <input type="date" class="form-control mb-3" id="tarihSec">
                <label for="saat">Saat</label>
                <select class="form-select shadow-none mb-3" id="saat" name="saat">
                    <option selected>Seçilmedi</option>
                    <option value="09:00">09:00</option>
                    <option value="09:10" disabled>09:10</option>
                    <option value="09:20">09:20</option>
                    <option value="09:30">09:30</option>
                </select>
                <button type="submit" class="btn btn-primary">Randevu Al</button>
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

    
    var randevuAl = document.getElementById("randevuAl");
    randevuAl.addEventListener("submit", function(event){
        event.preventDefault();
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
</script>