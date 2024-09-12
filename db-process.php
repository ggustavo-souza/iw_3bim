<?php

$servername = "localhost";
$username = "root";
$password = "";
$dataserver = "IPI_2";

$conn = mysqli_connect($servername, $username, $password, $dataserver);

if (!$conn) {
  die("Conexão falhou: " . mysqli_connect_error());
} else {
    echo "conectou";
}

?>
