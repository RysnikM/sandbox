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



$sql = "SELECT oborudovanie.id AS id, oborudovanie.name AS name, oborudovanie.code AS code, oborudovanie.group_id AS group_id, oborudovanie.tablename AS tablename, (SELECT name FROM group_o WHERE id=oborudovanie.code) AS groupname FROM oborudovanie  WHERE oee=1 ORDER BY groupname";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {

        $resultquery[$r]=$row;
        $r++;
    }
$resultJson=json_encode($resultquery);
$res['path']=$croshki;
    //шифрование данных в json для отправки в js
    $resJson=json_encode($res);

$now=time();
$dayago=$now-(3600*24);
$ress = array();
$i=0;
  $mass1[$i]=array("name"=>"Работает","turboThreshold"=>99999);
   $mass1[$i]["data"]=array();
       $r=0;
foreach ($resultquery as $key => $value) {
	
	$sql="SELECT * FROM ".$value['tablename']." WHERE status=1 AND endperiod>".$dayago.";";
	$result = $conn->query($sql);
$ress=array();


    while($row = $result->fetch_assoc()) {
      $ress[$r] = array();
        $ress[$r]=array("id"=>$row['id'],"name"=>$row['coment'],"x"=>(int)$row["startperiod"]*1000,"x2"=>(int)$row["endperiod"]*1000,"y"=>(int)$row['parentid']);
        $r++;

    }
    $mass1[$i]["data"]=$mass1[$i]["data"]+$ress;
   

}

 $i++;
 $mass2[$i]=array("name"=>"Авария","turboThreshold"=>99999);
   $mass2[$i]["data"]=array();
      $r=0;
foreach ($resultquery as $key => $value) {
	
	$sql="SELECT * FROM ".$value['tablename']." WHERE status=2 AND endperiod>".$dayago.";";
  //добавлено 1 февраля 2020
  if($value["tablename"]==="obreznoy")
  {
    $sql="SELECT * FROM ".$value['tablename']." WHERE status=2 AND prichina IS NOT NULL AND endperiod>".$dayago.";";
  }
  ///////////
	$result = $conn->query($sql);
 $ress=array();
    
    while($row = $result->fetch_assoc()) {
      $ress[$r] = array();
        $ress[$r]=array("id"=>$row['id'],"name"=>$row['coment'],"x"=>(int)$row["startperiod"]*1000,"x2"=>(int)$row["endperiod"]*1000,"y"=>(int)$value['id']);
        $r++;
    }
    $mass2[$i]["data"]=  $mass2[$i]["data"]+$ress;
     
}
 $i++;



   $mass3[$i]=array("name"=>"Выключен","turboThreshold"=>99999);
    $mass3[$i]["data"]=array();
    $t=0;
      $r=0;
foreach ($resultquery as $key => $value) {
	
	$sql="SELECT * FROM ".$value['tablename']." WHERE status=0 AND parentid is not null AND endperiod>".$dayago.";";
	$result = $conn->query($sql);
  $ress=array();
  
    while($row = $result->fetch_assoc()) {
      $ress[$r] = array();
        $ress[$r]=array("id"=>$row['id'],"name"=>$row['coment'],"x"=>(int)$row["startperiod"]*1000,"x2"=>(int)$row["endperiod"]*1000,"y"=>(int)$row['parentid']);
        $r++;
    }
    $mass3[$i]["data"]= $mass3[$i]["data"]+$ress;
   // array_push($mass3[$i]["data"], $ress);
      $t++;
}
$i++;

// $s="UPDATE  status_connection SET name='модуль на прессах' WHERE id=14";
// $rea=$conn->query($s);
$mass4[$i]=array("name"=>"Простой","turboThreshold"=>99999);
 $mass4[$i]["data"]=array();
 $t=0;
  $r=0;
foreach ($resultquery as $key => $value) {
	
	$sql="SELECT * FROM ".$value['tablename']." WHERE status=3 AND parentid is not null AND endperiod>".$dayago.";";
    if($value["tablename"]==="obreznoy")
  {
    //$null = NULL;
    $sql="SELECT * FROM ".$value['tablename']." WHERE status=2 AND prichina IS NULL AND endperiod>".$dayago.";";
  }
  ///////////
	$result = $conn->query($sql);
   
    $ress=array();
    while($row = $result->fetch_assoc()) {
      $ress[$r] = array();
        $ress[$r]=array("id"=>$row['id'],"name"=>$row['coment'],"x"=>(int)$row["startperiod"]*1000,"x2"=>(int)$row["endperiod"]*1000,"y"=>(int)$row['parentid']);
        $r++;
    }
    $mass4[$i]["data"]=$mass4[$i]["data"]+ $ress;
    $t++;  
}
$i++;
// added 13:43 1-febr-2020
$mass5[$i]=array("name"=>"Запланированный ремонт","turboThreshold"=>99999);
 $mass5[$i]["data"]=array();

$t=0;
  $r=0;
foreach ($resultquery as $key => $value) {
  
  $sql="SELECT * FROM ".$value['tablename']." WHERE status=5 AND parentid is not null AND endperiod>".$dayago.";";
  $result = $conn->query($sql);
   
    $ress=array();
    while($row = $result->fetch_assoc()) {
      $ress[$r] = array();
        $ress[$r]=array("id"=>$row['id'],"name"=>$row['coment'],"x"=>(int)$row["startperiod"]*1000,"x2"=>(int)$row["endperiod"]*1000,"y"=>(int)$row['parentid']);
        $r++;
    }
    $mass5[$i]["data"]=$mass5[$i]["data"]+ $ress;
    $t++;  
}
$i++;


///////////



$mass=$mass1+$mass2+$mass3+$mass4+$mass5;


$t=0;
  $r=0;
     $ferst=array();
foreach ($resultquery as $key => $value) {
  
  $sql1="SELECT * FROM ".$value['tablename']." WHERE endperiod>".$dayago."  ORDER BY endperiod asc LIMIT 1;";
  $result1 = $conn->query($sql1);
   
 
    while($row1 = $result1->fetch_assoc()) {
      $ferst[$key] = array();
        $ferst[$key]=array("id"=>$row1['id'],"name"=>$row1['coment'],"x"=>(int)$row1["startperiod"]*1000,"x2"=>(int)$row1["endperiod"]*1000,"y"=>(int)$row1['parentid'],"status"=>$row1['status']);
        $r++;
    }

    $t++;  
}

foreach ($ferst as $key => $value) {

if((int)$value["status"]==1){
  foreach ($mass[0]['data'] as $k => $val) {
      if($value['id']===$val["id"] && $value['y']===$val["y"]){
         $mass[0]['data'][$k]["x"]=$dayago*1000;

      }

   }
}

if((int)$value["status"]==2){
  foreach ($mass[1]['data'] as $k => $val) {
      if($value['id']===$val["id"] && $value['y']===$val["y"]){
         $mass[1]['data'][$k]["x"]=$dayago*1000;
      }

   }
}

if((int)$value["status"]==0){
  foreach ($mass[2]['data'] as $k => $val) {
      if($value['id']===$val["id"] && $value['y']===$val["y"]){
         $mass[2]['data'][$k]["x"]=$dayago*1000;
      }

   }
}

if((int)$value["status"]==3){
  foreach ($mass[3]['data'] as $k => $val) {
      if($value['id']===$val["id"] && $value['y']===$val["y"]){
         $mass[3]['data'][$k]["x"]=$dayago*1000;
      }

   }
}

}
if($_GET['comment']){
$name=$_GET['oborname'];
$ids=$_GET['id'];
$text=$_GET['comment'];
print_r($name);
$sql = "SELECT oborudovanie.id AS id, oborudovanie.name AS name, oborudovanie.code AS code, oborudovanie.group_id AS group_id, oborudovanie.tablename AS tablename, (SELECT name FROM group_o WHERE id=oborudovanie.code) AS groupname FROM oborudovanie WHERE name='".$name."';";

$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $resultquery=$row;
        $r++;
    }

 $prichnaset=$_GET['prichina'];

$prichina1="Ремотные работы";
   if($_GET["prichina"]!="Выберите причину" && $_GET["prichina"]==="1"){
        $prichnaset=$_GET['ferstAgregat'];
 if($_GET['secAgregat']){$prichnaset=$_GET['secAgregat']; if($_GET['serdAgregat']){$prichnaset=$_GET['serdAgregat'];}}


    $sql = "INSERT INTO repairs (`id_obor`, `typeOfRepair`, `uzel`, `prichina`, `startTime`, `endTime`, `time`, `userid`, `comment`) VALUES (".$resultquery['id'].",' ".$_GET['typerem']."', '".$_GET['ferstAgregat']."', '".$prichnaset."', ".$_GET['timestart'].", ".$_GET['timeend'].", ".time().", ".$_userid.",  '".$_GET['comment']."');";
  if (mysqli_query($conn, $sql)) {
    //  echo "Коментарий изменен";
   } else {
    print_r($sql);
      echo "Error deleting record: " . mysqli_error($conn);
   }

    $prichnaset=$_GET['ferstAgregat'];
 if($_GET['secAgregat']){$prichnaset=$_GET['secAgregat']; if($_GET['serdAgregat']){$prichnaset=$_GET['serdAgregat'];}}
 if($_GET['typerem']==="1")
 {
    $statusToUpd = 5;
 }

if($_GET['typerem']==="2")
 {
    $statusToUpd = 2;
 }
 
      $sql = ' UPDATE '.$resultquery['tablename'].' SET coment="'.$text.'",`prichina`="'.$prichnaset.'", status='.$statusToUpd.' WHERE id="'.$ids.'";';  
   if (mysqli_query($conn, $sql)) {
    //  echo "Коментарий изменен";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
header("Location: /start/oee/oee_online/index.php"); /* Перенаправление браузера */

/* Убедиться, что код ниже не выполнится после перенаправления .*/
exit;
   }else{
    if($_GET["prichina"]=="Погодные условия (сильный ветер)" || $_GET["prichina"]=="Отсутствие сырья" || $_GET["prichina"]=="Отсутствие пара"){
          $sql = ' UPDATE '.$resultquery['tablename'].' SET coment="'.$text.'",`prichina`="'.$prichnaset.'", status=3 WHERE id="'.$ids.'";';  
   if (mysqli_query($conn, $sql)) {
    //  echo "Коментарий изменен";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
   exit;
    }
       $sql = ' UPDATE '.$resultquery['tablename'].' SET coment="'.$text.'" WHERE id="'.$ids.'";';  
   if (mysqli_query($conn, $sql)) {
    //  echo "Коментарий изменен";
   } else {
      echo "Error deleting record: " . mysqli_error($conn);
   }
   }
}
  $dayago=$dayago*1000;
    $mass=json_encode($mass);
    include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); 

include 'index.html';  /// подключение файла html
    include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); 
       include ('oeeOnline.html'); 
?>