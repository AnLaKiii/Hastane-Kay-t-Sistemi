<?php include "php/connect.php";
    $SQL = "SELECT CONCAT(DoktorAdi,' ',DoktorSoyadi) AS DoktorAdi FROM Doktor WHERE  DoktorID= ".$_SESSION["doktor"];
    $result = $conn->query($SQL);
    $row = $result->fetch_assoc();
    $conn->close();
    ?>
<nav class="">
    <ul class="nav-list container-xxl">
        <a class="logo" href="./" >
            <img src="img/logo.png" alt="">
        </a>
        <li class="my-nav-item toggle-drop">
            <div class="user-image-1">
                <img src="img/user.png" alt="">
            </div>
            <p><?php echo $row["DoktorAdi"];?></p>
            <ul class="drop-ul">
                <li>
                    <div class="user-image-1">
                        <img src="img/user.png" alt="">
                    </div>
                    <p><?php echo $row["DoktorAdi"];?></p>
                </li>
                <hr>
                <li>
                    <a href="php/script.php?val=cikis">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <p>Çıkış</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>