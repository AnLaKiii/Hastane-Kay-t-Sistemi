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
}
if($getVal == "randevu"){
    /*
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
    */
    echo 1;
}
if($getVal == "cikis"){
    session_start();    
    session_destroy();
    header("Location: /Hastane-Kayit-Sistemi/login.php");
    exit;
}
?>