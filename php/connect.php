<?php 

// $sunucu = "localhost";
// $kullanici ="abdulba2_abdulbakidemir";
// $sifre = "W5BOpjdzS_CBk49";
// $adi ="abdulba2_abdulbakidemir";

$sunucu = "localhost";
$kullanici ="root";
$sifre = "";
$adi ="Hastane";

$conn = new mysqli($sunucu,$kullanici,$sifre,$adi);
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
?>
