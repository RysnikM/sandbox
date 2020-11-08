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
$res['path']=$croshki;// передача пути в js

    //шифрование данных в json для отправки в js
    $resJson=json_encode($res);
if($_GET['iddel']){
$iddel=$_GET['iddel'];
$toid=$_GET['toid'];

  $sql = ' UPDATE oborudovanie SET group_id="'.$toid.'" WHERE group_id='.$iddel.';';   
   if (mysqli_query($conn, $sql)) {
      echo "Данные группы изменены";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }


  $sql = ' DELETE FROM group_o WHERE id = '.$iddel;
   
   if (mysqli_query($conn, $sql)) {
      echo "Группа успешно удалена";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }

}elseif($_GET['adduser']){
	$n=$_GET['name'];
	if(!$n){$n=" ";}
	$s=$_GET['code'];
	  $sql = ' INSERT INTO group_o (name,code) VALUES ("'.$n.'","'.$s.'")';   
   if (mysqli_query($conn, $sql)) {
      echo "Группа добавлена";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
}elseif($_GET['updateobor']){
	$n=$_GET['name'];
	if(!$n){$n=" ";}
	$s=$_GET['code'];
	$id=$_GET['id'];
    $sql = ' UPDATE group_o SET name="'.$n.'",code="'.$s.'" WHERE id='.$id.';';   
   if (mysqli_query($conn, $sql)) {
      echo "Данные группы изменены";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
}else{

// получение списка пользователей
$sql = "SELECT * FROM group_o ";
$sql = "SELECT group_o.id AS id, group_o.name AS name, group_o.code AS code, (SELECT COUNT(*) FROM oborudovanie WHERE group_id=group_o.id) AS count FROM group_o";

$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $resultquery[$r]=$row;
        $r++;
    }
   //шифрование данных в json для отправки в js
    $resultJson=json_encode($resultquery);




    include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); 
include 'index.html';  /// подключение файла html
    include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); 
}
?>