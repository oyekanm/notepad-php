<?php
$conn = mysqli_connect("localhost", "zayb", "zaybomoerin", "notepad");

if (!$conn) {
   echo 'connect failed ' . mysqli_connect_error();
}


?>