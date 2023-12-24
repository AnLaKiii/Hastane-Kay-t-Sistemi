<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $randevuID = $_GET["val"];
    $format = "Y-m-d-H:i";
    include "php/connect.php";
    $SQL = "SELECT 
            Randevu.RandevuID,
            Randevu.RandevuTarihi,
            CONCAT( Hasta.HastaAdi, ' ' ,Hasta.Soyadi) AS HastaAdiSoyadi,
            SUBSTRING(Randevu.RandevuSaati, 1, 5) AS RandevuSaati,
            CONCAT( Doktor.DoktorAdi, ' ' ,Doktor.DoktorSoyadi) AS DoktorAdiSoyadi, 
            BolumAdi.BolumAdi
            FROM Randevu
            LEFT JOIN Doktor ON Randevu.DoktorID = Doktor.DoktorID 
            LEFT JOIN Hasta ON Randevu.HastaID = Hasta.HastaID 
            LEFT JOIN BolumAdi ON Doktor.DoktorBolumID = BolumAdi.BolumID WHERE RandevuID = $randevuID";
    $result = $conn->query($SQL);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Randevu</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
</head>
<body style="max-width:100vw; overflow-x:hidden; background:#167585;" >
    <div style="min-height:90vh; width:100%;">
    <?php 
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $yourDateTimeString = $row["RandevuTarihi"]."-".$row["RandevuSaati"];
        $dateTime = DateTime::createFromFormat($format, $yourDateTimeString);
        $currentDateTime = new DateTime();
        if ($dateTime > $currentDateTime){
            $row["RandevuTarihi"] = date("d.n.Y", strtotime($row["RandevuTarihi"]));
            echo "
                <div class='col-xxl-4 col-lg-5 col-sm-8 col-12 p-2 pt-0 pb-3 rese-info ranActive  mx-auto'>
                    <div class='rounded-1 card shadow mt-5'>
                        <canvas class='qrcode p-4 w-75 mx-auto my-4'  value='".$row["RandevuID"]."'></canvas>
                        <div class='card-body'>
                            <h5 class='card-title fw-bold'>KB Hastanesi<small class='text-success'>(aktif)</small></h5>
                            <hr>
                            <table class='w-100'>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='me-3 fa-solid fa-clipboard'></i></th>
                                    <th style='width:7rem'>Bölüm</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$row["BolumAdi"]."</td>
                                </tr>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='fa-solid fa-user'></i></th>
                                    <th style='width:7rem'>Hasta</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$row["HastaAdiSoyadi"]."</td>
                                </tr>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='me-3 fa-solid fa-user-doctor'></i>
                                    <th style='width:7rem'>Doktor</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$row["DoktorAdiSoyadi"]."</td>
                                </tr>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='me-3 fa-solid fa-calendar'></i></th>
                                    <th style='width:7rem'>Tarih</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$row["RandevuTarihi"]."</td>
                                </tr>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='me-3 fa-solid fa-clock'></i></th>
                                    <th style='width:7rem'>Saat</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$row["RandevuSaati"]."</td>
                                </tr>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='fa-solid fa-hashtag'></i></th>
                                    <th style='width:7rem'>Randevu ID</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$randevuID."</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>";         
        }
        else{
            echo "
                <div class='col-xxl-4 col-lg-5 col-sm-8 col-12 p-2 pt-0 pb-3 rese-info ranPasive  mx-auto'>
                    <div class='rounded-1 card shadow mt-5'>
                        <canvas class='qrcode p-4 w-75 mx-auto my-4'  value='".$row["RandevuID"]."'></canvas>
                        <div class='card-body'>
                            <h5 class='card-title fw-bold'>KB Hastanesi<small class='text-danger'>(pasif)</small></h5>
                            <hr>
                            <table class='w-100'>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='me-3 fa-solid fa-clipboard'></i></th>
                                    <th style='width:7rem'>Bölüm</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$row["BolumAdi"]."</td>
                                </tr>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='fa-solid fa-user'></i></th>
                                    <th style='width:7rem'>Hasta</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$row["HastaAdiSoyadi"]."</td>
                                </tr>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='me-3 fa-solid fa-user-doctor'></i>
                                    <th style='width:7rem'>Doktor</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$row["DoktorAdiSoyadi"]."</td>
                                </tr>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='me-3 fa-solid fa-calendar'></i></th>
                                    <th style='width:7rem'>Tarih</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$row["RandevuTarihi"]."</td>
                                </tr>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='me-3 fa-solid fa-clock'></i></th>
                                    <th style='width:7rem'>Saat</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$row["RandevuSaati"]."</td>
                                </tr>
                                <tr class='row flex-nowrap mb-1'>
                                    <th style='width:30px'><i class='fa-solid fa-hashtag'></i></th>
                                    <th style='width:7rem'>Randevu ID</th>
                                    <th style='width:1rem'>:</th>
                                    <td>".$randevuID."</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>";
        }
            }
        } 
        else {
            echo "
                    <div class='d-flex justify-content-center align-items-center' style='height:100vh; width:100%'>
                        <h1 class='text-center text-white fw-bold'>Randevu Bulunamadı!</h1>
                    </div>
                ";
        }
        $conn->close();
    ?>
    </div>
</body>
</html>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/qrious.min.js"></script>
<script>
    var qrCode = document.querySelector(".qrcode");
    var val = qrCode.getAttribute("value");
    const qr = new QRious({ element: qrCode, value: "randevudetay.php?val="+val, size: 800 , backgroundAlpha: 0});
</script>