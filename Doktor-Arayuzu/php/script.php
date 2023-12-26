<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$getVal = $_GET["val"];

if($getVal == "giris"){
    $a = $_POST["tckn"];
    $b = $_POST["password"];
    include "connect.php";
    $sorgu = "SELECT * FROM DSifre WHERE DTCKimlikNo = $a";
    $result = $conn->query($sorgu);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($row["Sifre"] == $b){
            echo 1;
            $sorgu = "SELECT DoktorID FROM Doktor WHERE DTCKimlikNo = $a";
            $result = $conn->query($sorgu);
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION['doktor'] = $row['DoktorID'];
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
if($getVal == "randevular"){
    session_start();
    $doc =$_SESSION['doktor'];
    include "connect.php";
    $date = $_POST["thisDate"];
    $sorgu = "SELECT DAY(RandevuTarihi) AS gun, COUNT(*) AS Randevu_Sayisi
                FROM Randevu
                WHERE DoktorID = $doc AND YEAR(RandevuTarihi) = YEAR('$date') AND MONTH(RandevuTarihi) = MONTH('$date')
                GROUP BY RandevuTarihi;";
    $result = $conn->query($sorgu);
    $row = $result->fetch_all();
    $jsonData = json_encode($row);
    echo $jsonData;
    $conn->close();  
}
 

if($getVal == "cikis"){
    session_start();    
    session_destroy();
    header("Location: /Hastane-Kayit-Sistemi/Doktor-Arayuzu/login.php");
    exit;
}
?>