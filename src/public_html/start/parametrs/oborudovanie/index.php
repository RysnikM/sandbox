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
$tab=$_GET['tablename'];
      $sql1="drop table ".$tab.";";
     if (mysqli_query($conn, $sql1)) {
      echo "таблица с данными удалена \n";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }

         $sql1="drop table ".$tab."_oee;";
     if (mysqli_query($conn, $sql1)) {
      echo "таблица с oee удалена \n";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }

  $sql = ' DELETE FROM oborudovanie WHERE id = '.$iddel;
   if (mysqli_query($conn, $sql)) {
      echo "Оборудование успешно удалено \n";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }

    $sql = ' DELETE FROM point_control WHERE parentid = '.$iddel;
   
   if (mysqli_query($conn, $sql)) {
      echo "<br> Точки контроля успешно удалены";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }

}elseif($_GET['addobor']){
	$n=$_GET['name'];
	$s=$_GET['group_id'];
	$ex=$_GET['code'];
  $tab=$_GET['tablename'];
  //////////////////////////// add tables for graph oee
   $sql1="create table ".$tab." (id int  AUTO_INCREMENT, startperiod int, endperiod int,status int, coment varchar(255), parentid int, PRIMARY KEY (id));";
     if (mysqli_query($conn, $sql1)) {
      echo "таблица добавлена \n";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
/////////////////////////// add table for oee
  $sql1="create table ".$tab."_oee (id int  AUTO_INCREMENT, startperiod int, endperiod int,A int, P int,Q int, OEE int, PRIMARY KEY (id));";
     if (mysqli_query($conn, $sql1)) {
      echo "таблица OEE  добавлена \n";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
   ////////////////////////////

	if(!$s){$s=" ";} if(!$ex){$ex=" ";} if(!$age){$age=" ";} if(!$pos){$pos=" ";} if(!$tel){$tel=NULL;} if(!$em){$em=" ";} 
	  $sql = ' INSERT INTO oborudovanie (name,code,group_id,tablename) VALUES ("'.$n.'","'.$s.'","'.$ex.'","'.$tab.'")';   
   if (mysqli_query($conn, $sql)) {
      echo "Еденица оборудования добавлена";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
}elseif($_GET['updateobor']){
  $n=$_GET['name'];
  $s=$_GET['group_id'];
  $ex=$_GET['code'];
    $tab=$_GET['tablename'];
  $id=$_GET['id'];
  if(!$s){$s=" ";} if(!$ex){$ex=" ";} if(!$age){$age=" ";} if(!$pos){$pos=" ";} if(!$tel){$tel=NULL;} if(!$em){$em=" ";} 
    $sql = ' UPDATE oborudovanie SET name="'.$n.'",code="'.$ex.'",group_id="'.$s.'",tablename="'.$tab.'" WHERE id='.$id.';';   
   if (mysqli_query($conn, $sql)) {
      echo "Еденица оборудования изменена";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
}else{

// получение списка оборудования
$sql = "SELECT oborudovanie.id AS id, oborudovanie.name AS name, oborudovanie.code AS code, oborudovanie.group_id AS group_id, oborudovanie.tablename AS tablename, (SELECT name FROM group_o WHERE id=oborudovanie.code) AS groupname FROM oborudovanie";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $resultquery[$r]=$row;
        $r++;
    }
$sql = "SELECT * FROM group_o;";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $resultgroup[$r]=$row;
        $r++;
    }
   //шифрование данных в json для отправки в js
    $resultJson=json_encode($resultquery);

$putas="polucg";
include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); 
include 'index.html';  /// подключение файла html
include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); 

}
?>