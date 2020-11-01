<?php
// проверка авторизации пользователя
session_start();
if(!$_SESSION['username']){print_r("Вы не авторизованны"); echo"<br>"; echo"<a href='/'>К авторизации</a>"; exit();}

$name=$_SESSION['username'];

$put1=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/croshki.php'; // создаю абсолютный путь до модуля хлебных крошек
include ($put1);//// подключаю модуль хлебных крошек



$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
include ($put);//// подключаю модуль связи с БД


$sql = "SELECT * FROM oborudovanie  WHERE name='".$_GET['id']."';";

$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {

        $obor=$row;
        $r++;
    }


$sql = "SELECT * FROM agregats  WHERE oborid=".$obor['groupObor']." AND parentid=0;";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {

        $resultquery[$r]=$row;
        $r++;
    }

foreach ($resultquery as $key => $value) {
		$sql = "SELECT * FROM agregats  WHERE parentid=".$value['id']." ;";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {

        $resultquery[$key]["secondLevel"][$r]=$row;
        			$sql1 = "SELECT * FROM agregats  WHERE parentid=".$row['id']." ;";
$result1 = $conn->query($sql1);
    $r1=0;
    while($row1 = $result1->fetch_assoc()) {

        $resultquery[$key]["secondLevel"][$r]["serdlevel"][$r1]=$row1;
        $r1++;
    }


        $r++;
    }
}

$resultJson=json_encode($resultquery);
print_r($resultJson);
?>