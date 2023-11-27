<?php
$post_data = file_get_contents("php://input");
$data = json_decode($post_data, true);
$myObj = new stdClass();
$myObj->name = $data['param1'];
$myObj->age = $data['param2'];
$myObj->city = "New York";


echo "<h1>$myObj->name</h1>";
echo "<h1>$myObj->age</h1>";
?>