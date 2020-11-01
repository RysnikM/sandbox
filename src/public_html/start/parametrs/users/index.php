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
  $sql = ' DELETE FROM users WHERE id = '.$iddel;
   
   if (mysqli_query($conn, $sql)) {
      echo "Пользователь успешно удален";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }

}elseif($_GET['adduser']){
	$n=$_GET['name'];
	if(!$n){$n="--";}
	$s=$_GET['surname'];
	$ex=$_GET['sex'];
	$age=$_GET['age'];
	$pos=$_GET['position'];
	$tel=$_GET['telephone'];
	$em=$_GET['email'];
	$pas=$_GET['pass'];
	$nik=$_GET['nikname'];
	$lev=$_GET['levelAccess'];
	if(!$s){$s="--";} if(!$ex){$ex="--";} if(!$age){$age="--";} if(!$pos){$pos="--";} if(!$tel){$tel="--";} if(!$em){$em="--";} 
	  $sql = ' INSERT INTO users (name,surname,sex,position,email,pass,nikname,levelAccess) VALUES ("'.$n.'","'.$s.'","'.$ex.'","'.$pos.'","'.$em.'","'.$pas.'","'.$nik.'",'.$lev.')';   
   if (mysqli_query($conn, $sql)) {
      echo "Пользователь добавлен";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
}elseif($_GET['updateobor']){
	$n=$_GET['name'];
	if(!$n){$n="--";}
	$s=$_GET['surname'];
	$ex=$_GET['sex'];
	$age=$_GET['age'];
	$pos=$_GET['position'];
	$tel=$_GET['telephone'];
	$em=$_GET['email'];
	$pas=$_GET['pass'];
	$nik=$_GET['nikname'];
	$lev=$_GET['levelAccess'];
	$id=$_GET['id'];
if(!$s){$s="--";} if(!$ex){$ex="--";} if(!$age){$age=0;} if(!$pos){$pos="--";} if(!$tel){$tel="--";} if(!$em){$em="--";} 
    $sql = ' UPDATE users SET name="'.$n.'",surname="'.$s.'",sex="'.$ex.'",age="'.$age.'",position="'.$pos.'",email="'.$em.'",nikname="'.$nik.'",levelAccess="'.$lev.'",pass="'.$pas.'" WHERE id='.$id.';';  
    print_r($sql); 
   if (mysqli_query($conn, $sql)) {
      echo "Данные пользователя изменены";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
}else{

// получение списка пользователей
$sql = "SELECT * FROM users ";
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