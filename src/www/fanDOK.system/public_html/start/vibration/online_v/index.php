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



$sql = "SELECT * FROM group_o";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
  
        $group[$r]=$row;
        $r++;
    }

$sql3 = "SELECT * FROM group_o";
$result3 = $conn->query($sql3);
    $r3=0;
    while($row3 = $result3->fetch_assoc()) {

$sql = "SELECT * FROM oborudovanie WHERE code='".$row3['id']."' AND vibro=1;";
$result = $conn->query($sql);
    $r=0;
    $obor=array();
//SELECT * FROM Table ORDER BY ID DESC LIMIT 1
    while($row = $result->fetch_assoc()) {
        $point=array();
        $sql1 = "SELECT * FROM point_control WHERE parentid='".$row['id']."';";
$result1 = $conn->query($sql1);
    $r1=0;
         $point=array();

    while($row1 = $result1->fetch_assoc()) {
 $sred=0;
            $valueonline=0;
             $maxval=0;
            $sql11 = "SELECT * FROM ".$row1['tablename']." ORDER BY time DESC LIMIT 1;";
            $result11 = $conn->query($sql11);
            $r11=0;
        
            if($result11){
            while($row11 = $result11->fetch_assoc()) {
            $valueonline=$row11['value'];
            $r11++;
            }
             }
            $sql111 = "SELECT MAX(value) as value FROM ".$row1['tablename'].";";
            $result111 = $conn->query($sql111);
            $r111=0;
        
            if($result111){
            while($row111 = $result111->fetch_assoc()) {
            $maxval=$row111['value'];
            $r111++;
            }


        }

$sql1111 = "SELECT avg(value) as value FROM ".$row1['tablename'].";";
            $result1111 = $conn->query($sql1111);
            $r1111=0;
       
            if($result1111){
            while($row1111 = $result1111->fetch_assoc()) {
            $sred=$row1111['value'];
            $r1111++;
            }


        }
       
        $point[$r1]=$row1;
         $point[$r1]['onlinevalue']=$valueonline;
           $point[$r1]['maxval']=$maxval;
           $point[$r1]['avg']=$sred;
        $r1++;
    }


       $sql2 = "SELECT * FROM ".$row['tablename']."_oee ORDER BY id DESC LIMIT 1;";
            $result2 = $conn->query($sql2);
            $r11=0;
         $oee=array();
            if($result2){
            while($row2 = $result2->fetch_assoc()) {
            $oee=$row2;
            $r11++;
            }
             }


        $obor[$r]=$row;
        $obor[$r]['points']=$point;
        $obor[$r]['oee']=$oee;
        $r++;
    }

            $group_o[$r3]=$row3;
            $group_o[$r3]['obor']=$obor;
        $r3++;
    }


    include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); 
include 'index.html';  /// подключение файла html
    include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); 

?>