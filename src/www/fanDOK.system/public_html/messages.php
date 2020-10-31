<?php
include 'phpmodule/mysqlconn.php';  // подключаю модуль связи с БД
$what=$_GET['get'];
session_start(); 
//получение данных из БД
if($_GET['get']==1){
	$sql = "SELECT * FROM err_message ORDER BY id desc LIMIT 10;";
$result = $conn->query($sql);

    // output data of each row
    $r=0;
    while($row = $result->fetch_assoc()) {
        $messages[$r]=$row;
        $r++;
    }
  print_r(json_encode($messages));
}elseif($_GET['time']==1){
    date_default_timezone_set("Europe/Minsk");
$time=time();

	$sql = "SELECT * FROM status_connection;";
$result = $conn->query($sql);

    // output data of each row
    $r=0;
    while($row = $result->fetch_assoc()) {
        $status[$r]=$row;
        $r++;
    }
    $send=["time"=>$time,"status"=>$status,'timezone'=>date_default_timezone_get()];
 print_r(json_encode($send));
}
?>