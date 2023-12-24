<?php 

// $sunucu = "localhost";
// $kullanici ="abdulba2_abdulbakidemir";
// $sifre = "W5BOpjdzS_CBk49";
// $adi ="abdulba2_abdulbakidemir";
header('Content-Type: text/html; charset=utf-8');
$sunucu = "localhost";
$kullanici ="root";
$sifre = "";
$adi ="hastane";

$conn = new mysqli($sunucu,$kullanici,$sifre,$adi);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
