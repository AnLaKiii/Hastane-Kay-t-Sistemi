<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$getVal = $_GET["val"];

if($getVal == "kayit"){
    $a = ucfirst(strtolower($_POST["name"]));
    $b = ucfirst(strtolower($_POST["lastName"]));
    $c = $_POST["tckn"];
    $d = $_POST["tel"];
    $e = $_POST["email"];
    $f = $_POST["date"];
    $g = $_POST["password"];
    $h = ucfirst(strtolower($_POST["sehir"]));
    $i = ucfirst(strtolower($_POST["ilce"]));
    $j = ucfirst(strtolower($_POST["acikAdres"]));
    
    include "connect.php";
    
    $SQL = "INSERT INTO Hasta (HastaAdi, Soyadi, TCKimlikNo, HastaTelefonNo, HastaEmail, DogumTarihi) VALUES ('$a', '$b', $c, '$d', '$e', '$f');";
    $SQL .= "INSERT INTO Sifre(TCKimlikNo,Sifre) VALUES ($c,'$g')";
    
    
    $sorgu = "SELECT TCKimlikNo FROM Hasta WHERE TCKimlikNo = $c";
    $result = $conn->query($sorgu);
    if ($result->num_rows > 0) {
        echo "0";
    }
    else if ($conn->multi_query($SQL) === TRUE) {
        $conn->close();   
        include "connect.php";
        $sorgu = "SELECT HastaID FROM Hasta WHERE TCKimlikNo = $c";
        $result = $conn->query($sorgu);
        $row = $result->fetch_assoc();
        $sorgu = "INSERT INTO Adres (HastaID,Sehir,Ilce,AcikAdres) VALUES (".$row["HastaID"].",'$h','$i','$j')";
        $result = $conn->query($sorgu);
        echo "1";
    } 
    else {    
        echo "2";
    }
    // Bağlantıyı kapat
    $conn->close();   
}
if($getVal == "giris"){
    $a = $_POST["tckn"];
    $b = $_POST["password"];
    include "connect.php";
    $sorgu = "SELECT * FROM Sifre WHERE TCKimlikNo = $a";
    $result = $conn->query($sorgu);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($row["Sifre"] == $b){
            echo 1;
            $sorgu = "SELECT HastaID FROM Hasta WHERE TCKimlikNo = $a";
            $result = $conn->query($sorgu);
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['hasta'] = $row['HastaID'];
        }
        else{
            echo 0;
        }
    }
    else{
        echo 0;
    }
    $conn->close();  
}
if($getVal == "randevu"){
    if(isset($_GET["bol"])){
        session_start();
        if(isset($_SESSION['hasta'])){
            include "connect.php";
            $sorgu = "SELECT * FROM BolumAdi;";
            $result = $conn->query($sorgu);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["BolumID"]."'>".$row["BolumAdi"]."</option>";
                }
            } else {
                echo "";
            }
            $conn->close();  
        }
    }
    if(isset($_GET["doc"])){
        $bolum = $_POST["bolum"];
        session_start();
        echo "<option value='0'>Seçilmedi</option>";
        if(isset($_SESSION['hasta'])){
            include "connect.php";
            $sorgu = "SELECT DoktorID, CONCAT(DoktorAdi, ' ', DoktorSoyadi) AS DoktorIsim FROM Doktor
                        INNER JOIN
                        BolumAdi ON Doktor.DoktorBolumID = BolumAdi.BolumID WHERE BolumID = $bolum";
            $result = $conn->query($sorgu);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["DoktorID"]."'>".$row["DoktorIsim"]."</option>";
                }
            } else {
                echo "";
            }
            $conn->close();  
        }
    }
    if(isset($_GET["date"])){
        $times =["09:00:00","10:00:00","11:00:00","12:00:00","13:00:00","14:00:00","15:00:00","16:00:00"];
        $doktorID = $_POST["doktorID"];
        $date = $_POST["date"];
        session_start();
        if(isset($_SESSION['hasta'])){
            include "connect.php";
            $sorgu = "SELECT RandevuSaati FROM Randevu WHERE DoktorID = $doktorID AND RandevuTarihi = '$date' ORDER BY RandevuSaati";
            $result = $conn->query($sorgu);
            $row = $result->fetch_all();
            $length = count($row);
            $j = 0;
            if ($length >= 0 && $length < 8) {
                foreach($times as $i => $time){
                    if($i == 0){
                        echo "<option value='0'>Seçilmedi</option>";
                    }
                    if($row[$j][0]==$time){
                        echo "<option value='".$time."' disabled>".$time."</option>";
                        if($j<$length-1){
                            $j = $j+1;
                        }
                    }
                    else{
                        echo "<option value='".$time."'>".$time."</option>";
                    }
                }
            }
            else {
                echo "";
            }
            $conn->close();  
        }
    }
    if(isset($_GET["fin"])){
        session_start();
        if(isset($_SESSION['hasta'])){
            $hastaID = $_SESSION['hasta'];
            $doktorID = $_POST["doktor"];
            $date = $_POST["date"];
            $time = $_POST["saat"];
            include "connect.php";
            $sorgu = "INSERT INTO Randevu (RandevuTarihi,RandevuSaati,HastaID,DoktorID) VALUES ('$date','$time',$hastaID,$doktorID);";
            $result = $conn->query($sorgu);
            $conn->close();  
            echo 1;
        }
    }
}
if($getVal == "sifreUpdate"){
    $a = $_POST["sifre"];  
    $b = $_POST["Ysifre"];  
    include "connect.php";
    session_start();
    $hastaID=$_SESSION['hasta'];
    $SQL = "SELECT * FROM Sifre WHERE TCKimlikNo = (SELECT TCKimlikNo FROM Hasta WHERE HastaID = $hastaID);";
    $result = $conn->query($SQL);
    $row = $result->fetch_assoc();
    $c=$row['TCKimlikNo'];
    if($row["Sifre"]== $a){
        $SQL = "UPDATE Sifre SET Sifre ='$b' WHERE TCKimlikNo = $c";
        $result = $conn->query($SQL);
        echo 1;
    }
    else{
        echo 0;
    }
    $conn->close();   
}
if($getVal == "randevular"){
    $format = "Y-m-d-H:i";
    include "connect.php";
    session_start();
    $hastaID=$_SESSION['hasta'];
    $SQL = "SELECT 
            Randevu.RandevuID,
            Randevu.RandevuTarihi,
            SUBSTRING(Randevu.RandevuSaati, 1, 5) AS RandevuSaati,
            CONCAT( Doktor.DoktorAdi, ' ' ,Doktor.DoktorSoyadi) AS DoktorAdiSoyadi, 
            BolumAdi.BolumAdi
            FROM Randevu
            LEFT JOIN Doktor ON Randevu.DoktorID = Doktor.DoktorID 
            LEFT JOIN BolumAdi ON Doktor.DoktorBolumID = BolumAdi.BolumID WHERE HastaID = $hastaID ORDER BY CONCAT(RandevuTarihi, ' ', RandevuSaati) ASC";
    $result = $conn->query($SQL);
    $i = 0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $yourDateTimeString = $row["RandevuTarihi"]."-".$row["RandevuSaati"];
            $dateTime = DateTime::createFromFormat($format, $yourDateTimeString);
            $currentDateTime = new DateTime();
            $i += 1;
            if ($dateTime > $currentDateTime){
                $row["RandevuTarihi"] = date("d.n.Y", strtotime($row["RandevuTarihi"]));
                echo "
                    <div class='col-lg-3 col-md-4 col-sm-6 col-12 p-2 pt-0 pb-3 rese-info ranActive'>
                        <div class='rounded-1 card shadow-sm'>
                            <canvas class='qrcode p-4' value='".$row["RandevuID"]."'></canvas>
                            <div class='card-body'>
                                <h5 class='card-title fw-bold'>KB Hastanesi<small class='text-success'>(aktif)</small></h5>
                                <hr>
                                <ul class='p-0 mb-0'>
                                    <li>
                                        <i class='fa-solid fa-clipboard'></i>
                                        <small>".$row["BolumAdi"]."</small>
                                    </li>
                                    <li>
                                        <i class='fa-solid fa-user-doctor'></i>
                                        <small>".$row["DoktorAdiSoyadi"]."</small>
                                    </li>
                                    <li>
                                        <i class='fa-solid fa-calendar'></i>
                                        <small>".$row["RandevuTarihi"]."</small>
                                    </li>
                                    <li>
                                        <i class='fa-solid fa-clock'></i>
                                        <small>".$row["RandevuSaati"]."</small>
                                    </li>
                                    <li>
                                        <a href='randevudetay.php?val=".$row["RandevuID"]."' target='_blank' >
                                            <button class='btn btn-dark mb-2'>Detay</button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>";         
            }
            else{
                echo "
                    <div class='col-lg-3 col-md-4 col-sm-6 col-12 p-2 pt-0 pb-3 rese-info ranPasive'>
                        <div class='rounded-1 card shadow-sm'>
                            <canvas class='qrcode p-4' value='".$row["RandevuID"]."'></canvas>
                            <div class='card-body'>
                                <h5 class='card-title fw-bold'>KB Hastanesi<small class='text-danger'>(Aktif Değil)</small></h5>
                                <hr>
                                <ul class='p-0 mb-0'>
                                    <li>
                                        <i class='fa-solid fa-clipboard'></i>
                                        <small>".$row["BolumAdi"]."</small>
                                    </li>
                                    <li>
                                        <i class='fa-solid fa-user-doctor'></i>
                                        <small>".$row["DoktorAdiSoyadi"]."</small>
                                    </li>
                                    <li>
                                        <i class='fa-solid fa-calendar'></i>
                                        <small>".$row["RandevuTarihi"]."</small>
                                    </li>
                                    <li>
                                        <i class='fa-solid fa-clock'></i>
                                        <small>".$row["RandevuSaati"]."</small>
                                    </li>
                                    <li>
                                        <a href='randevudetay.php?val=".$row["RandevuID"]."' target='_blank' >
                                            <button class='btn btn-dark mb-2'>Detay</button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>";
            }
        }
    } else {
        echo "";
    }
    $conn->close();   
}

if($getVal == "telUpdate"){
    include "connect.php";
    session_start();
    $a = $_POST["telefon"];
    $SQL = "SELECT HastaTelefonNo FROM Hasta WHERE HastaTelefonNo = '$a'";
    $result = $conn->query($SQL);
    if($result->num_rows >= 1){
        echo 0;
    }
    else {
        $SQL = "UPDATE Hasta SET  HastaTelefonNo = '$a'  WHERE HastaID =".$_SESSION["hasta"];
        $conn->query($SQL);
        echo 1;
    }
    $conn->close();  
}
if($getVal == "mailUpdate"){
    include "connect.php";
    session_start();
    $a = $_POST["email"]; 
    $SQL = "UPDATE Hasta SET  HastaEmail = '$a'  WHERE HastaID =".$_SESSION["hasta"];
    if($conn->query($SQL)){
        echo 1;
    }
    else{
        echo 0;
    }
    $conn->close();  
}
if($getVal == "adresUpdate"){
    include "connect.php";
    session_start();
    $a = $_POST["il"]; 
    $b = $_POST["ilce"]; 
    $c = $_POST["acikAdres"]; 
    $SQL = "UPDATE Adres SET Sehir ='$a', Ilce = '$b', AcikAdres = '$c'  WHERE HastaID = ".$_SESSION["hasta"];
    if($conn->query($SQL)){
        echo 1;
    }
    else{
        echo 0;
    }
    $conn->close();  
}

if($getVal == "cikis"){
    session_start();    
    session_destroy();
    header("Location: /Hastane-Kayit-Sistemi/login.php");
    exit;
}
?>