<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$getVal = $_GET["val"];

if($getVal == "kayit"){
    $a = $_POST["name"];
    $b = $_POST["lastName"];
    $c = $_POST["tckn"];
    $d = $_POST["tel"];
    $e = $_POST["email"];
    $f = $_POST["date"];
    $g = $_POST["password"];
    
    include "connect.php";
    
    $SQL = "INSERT INTO Hasta (HastaAdi, Soyadi, TCKimlikNo, HastaTelefonNo, HastaEmail, DogumTarihi) VALUES ('$a', '$b', $c, '$d', '$e', '$f');";
    $SQL .= "INSERT INTO Sifre(TCKimlikNo,Sifre) VALUES ($c,'$g')";
    
    
    $sorgu = "SELECT TCKimlikNo FROM Hasta WHERE TCKimlikNo = $c";
    $result = $conn->query($sorgu);
    if ($result->num_rows > 0) {
        echo "0";
    }
    else if ($conn->multi_query($SQL) === TRUE) {
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
        echo "<option value='0'>Seçilmedi</option>";
        if(isset($_SESSION['hasta'])){
            include "connect.php";
            $sorgu = "SELECT RandevuSaati FROM Randevu WHERE DoktorID = $doktorID AND RandevuTarihi = '$date' ORDER BY RandevuSaati";
            $result = $conn->query($sorgu);
            $row = $result->fetch_all();
            $length = count($row);
            $j = 0;
            if ($length >= 0 && $length < 8) {
                foreach($times as $i => $time){
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
if($getVal == "cikis"){
    session_start();    
    session_destroy();
    header("Location: /Hastane-Kayit-Sistemi/login.php");
    exit;
}
?>