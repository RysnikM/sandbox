<?php
$servername = "localhost";
$username = "server";
$password = "z1x2c3v4";
$db='fanDOK';
$charset = 'utf8';
$_userid=$_SESSION["userid"];
// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


  $dsn = "mysql:host=$servername;dbname=$db;";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $username, $password, $opt);

// $put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/template_html.php'; // создаю абсолютный путь до модуля
// include ($put);//// подключаю модуль связи с БД



?>