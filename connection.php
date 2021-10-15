<?php
    $con = mysqli_connect('localhost:3308', 'Hadi', 'Douda.@12345') or die('Connection could not be established');
    mysqli_select_db($con, 'mychat');
?>