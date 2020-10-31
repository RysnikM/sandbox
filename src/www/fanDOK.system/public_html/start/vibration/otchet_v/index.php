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



$res['path']=$croshki;


// получение списка оборудования
// $sql = "SELECT oborudovanie.id AS id, oborudovanie.name AS name, oborudovanie.code AS code, oborudovanie.group_id AS group_id, oborudovanie.tablename AS tablename, (SELECT name FROM group_o WHERE id=oborudovanie.code) AS groupname FROM oborudovanie ORDER BY oborudovanie.code";

$sql = "SELECT name,id FROM group_o";
$result = $conn->query($sql);
    $r=0;
   
    while($row = $result->fetch_assoc()) {
   $resultquery1=array();
    	$sql1 = "SELECT name,id,code FROM oborudovanie WHERE code=".$row['id'];
$result1 = $conn->query($sql1);
    $r1=0;
    $row1="";
   
    while($row1 = $result1->fetch_assoc()) {
////////////////////////////
        //   $resultquery2="";
$sql2 = "SELECT name,id,tablename FROM point_control WHERE parentid=".$row1['id'];
$result2 = $conn->query($sql2);
    $r2=0;
    $row2="";
    $resultquery2=array();
    while($row2 = $result2->fetch_assoc()) {
        $resultquery2[$r2]=$row2;
        $r2++;

    }
    	////////////////////
    $row1['point']=$resultquery2;
        $resultquery1[$r1]=$row1;
        if($resultquery2){
           // array_unshift($resultquery1, array("code"=>$resultquery1[$r1]['code'],"name"=>$resultquery1[$r1]['name'],"id"=>$resultquery1[$r1]['id'],"point"=>array("name"=>"все точки","id"=>9999,"tablename"=>"all")));
        }
        $r1++;
    }
  
    $row["obor"]=$resultquery1;
        $resultquery[$r]=$row;
        $r++;
    }
    //шифрование данных в json для отправки в js
    $resJson=json_encode($res);
  //шифрование данных в json для отправки в js
    $resquery=json_encode($resultquery);
    include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); 
include 'index3.html';  /// подключение файла html
    include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); 

?>