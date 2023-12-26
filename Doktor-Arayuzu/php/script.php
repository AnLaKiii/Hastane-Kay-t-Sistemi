<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
$getVal = $_GET["val"];
function randomString($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
function receteIlaclar($receteID){
    include "connect.php";

    $sorgu ="
    SELECT Recete.ReceteID, Ilac.IlacID, Ilac.IlacAdi
    FROM Recete_Ilac
    INNER JOIN Recete ON Recete.ReceteID = Recete_Ilac.ReceteID
    INNER JOIN Ilac ON Ilac.IlacID = Recete_Ilac.IlacID
    WHERE Recete_Ilac.ReceteID = $receteID";
    $result = $conn->query($sorgu);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "  
            <tr id='ilac".$row["IlacID"]."' class='row justify-content-between align-items-center border-bottom'>
                <td class='col-3 text-center'>".$row["IlacAdi"]."</td>
                <td class='col-1 text-center pt-2'><div style='width:35px; height: 35px'><i class='fa-solid fa-trash-can text-danger' style='cursor:pointer' onclick='deleteIlac(".$row["IlacID"].")' ></i></div></td>
            </tr>";
        }
    }
    else{
        echo "";
    }
    $conn->close();  
}

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

if($getVal == "randevular1"){
    session_start();
    $doc =$_SESSION['doktor'];
    include "connect.php";
    $date = $_GET["date"];
    $sorgu = 
    "       SELECT * FROM HastaBilgileri
            WHERE DoktorID = $doc AND RandevuTarihi = '$date' 
            ORDER BY RandevuSaati ASC";
    
    echo "  <tr class='row justify-content-between'>
                <th class='col-1 text-center'> <div style='width:35px; height: 35px'></div></th>
                <th class='col-3 text-center'>Randevu Saati</th>
                <th class='col-3 text-center'>İsim</th>
                <th class='col-1 text-center'>Yaş</th>
                <th class='col-3 text-center'>Reçete</th>
            </tr>
            ";
    $result = $conn->query($sorgu);
    while($row = $result->fetch_assoc()){
        echo "  
                <hr>
                <tr class='row justify-content-between align-items-center'>
                    <td class='col-1 text-center pt-2'><div style='width:35px; height: 35px'><i class='fa-solid fa-user '></i></div></td>
                    <td class='col-3 text-center'>".$row["RandevuSaati"]."</td>
                    <td class='col-3 text-center'>".$row["HastaIsim"]."</td>
                    <td class='col-1 text-center'>".$row["Yas"]."</td>
                    <td class='col-3 text-center'><div class='btn btn-primary' onclick='randevuOpen(".$row["RandevuID"].")'>Reçete Oluştur</div></td>
                </tr>";
    }
    $conn->close();  
}
if($getVal == "ilacs"){
    include "connect.php";
    $sorgu = "SELECT * FROM Ilac";
    $result = $conn->query($sorgu);
    while($row = $result->fetch_assoc()){
        echo "<option value='".$row["IlacID"]."'>".$row["IlacAdi"]."</option>";
    }
    $conn->close();  
}
if($getVal == "receteEkle"){
    include "connect.php";

    $randevuID = $_POST["randevuID"];
    $sorgu = "SELECT ReceteID FROM Recete WHERE RandevuID = $randevuID";
    $result = $conn->query($sorgu);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        receteIlaclar($row["ReceteID"]);
    }
    else{
        $receteAdi =  randomString();
        $sorgu = "INSERT INTO Recete (RandevuID,ReceteAdi) VALUES ($randevuID,'$receteAdi')";
        $conn->query($sorgu);
        $sorgu = "SELECT ReceteID FROM Recete WHERE RandevuID = $randevuID";
        $result = $conn->query($sorgu);
        $row = $result->fetch_assoc();
        receteIlaclar($row["ReceteID"]);
    }
    
    $conn->close();  
}

if($getVal == "ilacEkle"){
    include "connect.php";
    $randevuID = $_POST["randevuID"];
    $ilacID = $_POST["ilacId"];
    $sorgu = "SELECT ReceteID FROM Recete WHERE RandevuID = $randevuID";
    $conn->query($sorgu);
    $result = $conn->query($sorgu);
    $row = $result->fetch_assoc();
    $receteID = $row["ReceteID"];

    $sorgu = "SELECT IlacAdi FROM Ilac WHERE IlacID = $ilacID";
    $conn->query($sorgu);
    $result = $conn->query($sorgu);
    $row = $result->fetch_assoc();
    $ilacAdi = $row["IlacAdi"];


    $sorgu = "INSERT INTO Recete_Ilac (ReceteID,IlacID) VALUES ($receteID,$ilacID)";
    $conn->query($sorgu);
    echo "  
            <tr id='ilac$ilacID' class='row justify-content-between align-items-center border-bottom'>
                <td class='col-3 text-center'>$ilacAdi</td>
                <td class='col-1 text-center pt-2'><div style='width:35px; height: 35px'><i class='fa-solid fa-trash-can text-danger'  style='cursor:pointer'  onclick='deleteIlac($ilacID)' ></i></div></td>
            </tr>";
    $conn->close();  
}

if($getVal == "ilacSil"){
    include "connect.php";

    $randevuID = $_POST["randevuID"];
    $ilacID = $_POST["ilacId"];
    $sorgu = "SELECT ReceteID FROM Recete WHERE RandevuID = $randevuID";
    $conn->query($sorgu);
    $result = $conn->query($sorgu);
    $row = $result->fetch_assoc();
    $receteID = $row["ReceteID"];

    $sorgu = "DELETE FROM Recete_Ilac WHERE ReceteID = $receteID AND IlacID = $ilacID";
    $conn->query($sorgu);
    $conn->close(); 
}
if($getVal == "cikis"){
    session_start();    
    session_destroy();
    header("Location: /Hastane-Kayit-Sistemi/Doktor-Arayuzu/login.php");
    exit;
}


?>