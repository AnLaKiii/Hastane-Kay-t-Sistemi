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
    <nav class="">
        <ul class="nav-list container-xxl">
            <li class="logo">
                <img src="img/logo.png" alt="">
            </li>
            <li class="">
                <div id="search-box1">
                    <div id="input-box1">
                        <input id="input1" type="text" placeholder="Search" on="deneme()" onkeyup="showHint(this.value)">
                        <div id="write1"></div>
                        <button id="search-button1"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </li>
            <li class="my-nav-item toggle-drop">
                <div class="user-image-1">
                    <img src="img/user.png" alt="">
                </div>
                <p>Abdülbaki Demir</p>
                <ul class="drop-ul">
                    <li>
                        <div class="user-image-1">
                            <img src="img/user.png" alt="">
                        </div>
                        <p>Abdülbaki Demir</p>
                    </li>
                    <hr>
                    <li>
                        <a href="">
                            <i class="fa-solid fa-gear"></i>
                            <p>Hesap</p>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa-solid fa-calendar"></i>
                            <p>Randevularım</p>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <p>Çıkış</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <section class="row pt-3 px-0 px-2" style="z-index: 0;">
        <div class="col-xxl-2 mb-2">
            <div class="row">
                <a href="" class="text-white col-12 col-sm-6 col-xxl-12 mb-2">
                    <div class="card card-color rounded-0 ">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-stethoscope"></i>
                                <h5 class="card-title mb-0 ms-2">Hastane Randevu Al</h5>
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
        <div class="col-8"></div>
        <div class="col-xxl-2">

            <div class="card person-info rounded-bottom">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0 fw-bold">Abdülbaki Demir</h5>
                    </div>
                    <hr>
                    <ul class="p-0">
                        <li>
                            <i class="fa-solid fa-id-card"></i>
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
</body>
</html>


<script src="js/bootstrap.bundle.min.js"></script>

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
</script>