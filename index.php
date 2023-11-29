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
        <ul class="nav-list container-xl">
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