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
if($_GET['update']==1){
$sql = "SELECT * FROM woodParams ORDER BY id desc LIMIT 3";
$result = $conn->query($sql);
    $r=3;
    while($row = $result->fetch_assoc()) {
        $resWood[$r]=$row;
        $r--;
    }
sort($resWood);

  $tabl=json_encode($resWood[2]);
  echo $tabl;
}else{


$sql = "SELECT * FROM woodData_3 ORDER BY id ASC";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $data[$r]=$row;
        $r++;
    }

 // $ss="UPDATE status_connection SET name='Дробилка на оптимизаторе' WHERE id=7";
 // $result = $conn->query($ss);
$sql = "SELECT * FROM woodParams ORDER BY id desc LIMIT 3";
$result = $conn->query($sql);
    $r=3;
    while($row = $result->fetch_assoc()) {
        $resWood[$r]=$row;
        $r--;
    }
sort($resWood);
    //шифрование данных в json для отправки в js
    $resJson=json_encode($data);
      $tabl=json_encode($resWood);
    include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); 
include 'index.html';  /// подключение файла html
    include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); 
}
?>