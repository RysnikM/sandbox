<?php
// проверка авторизации пользователя
session_start();
if(!$_SESSION['username']){print_r("Вы не авторизованны"); echo"<br>"; echo"<a href='/'>К авторизации</a>"; exit();}

$name=$_SESSION['username'];
$userid=$_SESSION['userid'];
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
      echo "таблица с данными удалена ";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
  $sql = ' DELETE FROM point_control WHERE id = '.$iddel;
   
   if (mysqli_query($conn, $sql)) {
      echo "точка контроля успешно удалено ";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }

}elseif($_GET['addobor']){
	$n=$_GET['name'];
	$s=$_GET['parentid'];
	$ex=$_GET['tablename'];
    $grmes=$_GET['granica_mess'];
      $gralarm=$_GET['granica_alarm'];
   $sql1="create table ".$ex." (id int  AUTO_INCREMENT, value int, time int, PRIMARY KEY (id));";
     if (mysqli_query($conn, $sql1)) {
      echo "таблица добавлена <br>";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
	if(!$s){$s=" ";} if(!$ex){$ex=" ";} if(!$grmes){$age=" ";} if(!$gralarm){$pos=" ";}
  $lastchange=time();
	  $sql = ' INSERT INTO point_control (name,parentid,tablename,granica_mess,granica_alarm,idchange,timechange) VALUES ("'.$n.'","'.$s.'","'.$ex.'","'.$grmes.'","'.$gralarm.'","'.$userid.'","'.$lastchange.'")';   
   if (mysqli_query($conn, $sql)) {
      echo "Точка контроля добавлена добавлена ";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
}elseif($_GET['updateobor']){
 $n=$_GET['name'];
  $s=$_GET['parentid'];
  $ex=$_GET['tablename'];
   $tab_d=$_GET['tablename_del'];
    $grmes=$_GET['granica_mess'];
      $gralarm=$_GET['granica_alarm'];
  $id=$_GET['id'];
    $lastchange=time();
  if(!$s){$s=" ";} if(!$ex){$ex=" ";} if(!$age){$age=" ";} if(!$pos){$pos=" ";} if(!$tel){$tel=NULL;} if(!$em){$em=" ";} 

    $sql = ' UPDATE point_control SET name="'.$n.'",parentid="'.$s.'",granica_mess="'.$grmes.'",granica_alarm="'.$gralarm.'",idchange="'.$userid.'", timechange="'.$lastchange.'" WHERE id='.$id.';';   
   if (mysqli_query($conn, $sql)) {
      echo "Точка контроля изменена ";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
}else{

// получение списка пользователей
$sql = "SELECT point_control.id AS id, point_control.name AS name, point_control.parentid AS parentid, point_control.granica_mess AS granica_mess, point_control.granica_alarm AS granica_alarm, point_control.tablename AS tablename, (SELECT name FROM oborudovanie WHERE id=point_control.parentid) AS groupname , (SELECT name FROM users WHERE id=point_control.idchange) AS userchange, point_control.timechange AS timechange FROM point_control";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $resultquery[$r]=$row;
        $r++;
    }
$sql = "SELECT * FROM oborudovanie;";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $resultgroup[$r]=$row;
        $r++;
    }
   //шифрование данных в json для отправки в js
    $resultJson=json_encode($resultquery);


include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); 
include 'index.html';  /// подключение файла html
include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); 
}
?>