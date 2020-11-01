<?php
// проверка авторизации пользователя
session_start();
if(!$_SESSION['username']){print_r("Вы не авторизованны"); echo"<br>"; echo"<a href='/'>К авторизации</a>"; exit();}

$name=$_SESSION['username'];

$put1=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/croshki.php'; // создаю абсолютный путь до модуля хлебных крошек
include ($put1);//// подключаю модуль хлебных крошек



$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
include ($put);//// подключаю модуль связи с БД


//получение данных из БД

$sql = "SELECT name,surname,position,levelAccess FROM users WHERE nikname='".$name."'";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $res=['name'=>$row['name'],'surname'=>$row['surname'],'position'=>$row['position'],'level'=>$row['levelAccess']];
        $r++;
    }

    //проверка уровня доступа
if($res['level']<8){print_r("Вы не имеете прав доступа к данному контенту");echo"<br>"; echo"<a href='/start'>На главную</a>"; exit();}
$sql = "SELECT * FROM oborudovanie";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $oborudovanie[$r]=$row;
        $r++;
    }

if($_GET['agrparent'] && $_GET['oborudovanie']  ){

$sql = "INSERT INTO agregats (`name`, `oborid`, `parentid`) VALUES (' ".$_GET['agrparent']."',".$_GET['oborudovanie'].",0);";
$result = $conn->query($sql);
header("Location: /start/parametrs/agregat/addagregat/index.php"); /* Перенаправление браузера */

/* Убедиться, что код ниже не выполнится после перенаправления .*/
exit;
print_r($sql);
}

$res['path']=$croshki;

    //шифрование данных в json для отправки в js
    $resJson=json_encode($res);

    include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); 
include 'index.html';  /// подключение файла html
    include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); 

?>