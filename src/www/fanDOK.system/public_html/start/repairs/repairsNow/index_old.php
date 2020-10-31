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
$nameA=json_encode($res);
    //проверка уровня доступа
if($res['level']<5){print_r("Вы не имеете прав доступа к данному контенту");echo"<br>"; echo"<a href='/start'>На главную</a>"; exit();}
$sql = "SELECT * FROM oborudovanie";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $oborudovanie[$r]=$row;
        $r++;
    }
array_push($oborudovanie,array("name"=>"Лущильные станки","id"=>1,"groupOborG"=>1));
array_push($oborudovanie,array("name"=>"Пресса","id"=>2,"groupOborG"=>2));
array_push($oborudovanie,array("name"=>"Пилы","id"=>3,"groupOborG"=>3));
if( $_GET['startTime'] && $_GET['endTime'] && $_GET['prihina'] ){
        $prichnaset=$_GET['ferstAgregat'];
 if($_GET['secAgregat'] && $_GET['secAgregat']!="Выберите агрегат"){$prichnaset=$_GET['secAgregat']; if($_GET['serdAgregat'] && $_GET['serdAgregat']!="Выберите агрегат"){$prichnaset=$_GET['serdAgregat'];}}

 $ss="SELECT * FROM oborudovanie WHERE name='".$_GET['oborudovanie']."';";
$result = $conn->query($ss);

    $r=0;
   while($row = $result->fetch_assoc()) {
       $oborudovanieSet=$row;
       $r++;
   } 
if($_GET['groupPrichina']){
   $prichnaset=$_GET['groupPrichina'];
   if($_GET['remont']==1){
      $statusRem = 5;
   }
   if($_GET['remont']==2){
      $statusRem=2;
   }
   if(!$_GET['remont']){
      $statusRem=2;
   }
   print_r($_GET);
   if($_GET['oborudovanie']=="Пилы"){

   }
}
   $startTime = strtotime($_GET['startTime']);
   $endTime = strtotime($_GET['endTime']);
print_r($oborudovanieSet);

if($oborudovanieSet['oee']==1 && !$_GET['updateRepair']){
// Получаем все зоны работы попавшие в промежуток


$sql = "SELECT * FROM ".$oborudovanieSet['tablename']." WHERE (endperiod>".$startTime." AND endperiod<$endTime) OR (startperiod<=$endTime AND startperiod>$startTime) ORDER BY startperiod;";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $AllProm[$r]=$row;
        $r++;
    }
if(count($AllProm)-1>=3){
  foreach ($AllProm as $y => $v) {
    if($y==0){
  $sql = "UPDATE  ".$oborudovanieSet['tablename']."  SET  endperiod=$startTime WHERE id=".$v['id'].";";
   if (mysqli_query($conn, $sql)) {
  
   }else {
    print_r($sql);
      echo "Error UPDATE record: " . mysqli_error($conn);
   }
}
   elseif($y==count($AllProm)){
  $sql = "UPDATE  ".$oborudovanieSet['tablename']."  SET  startperiod=$endTime WHERE id=".$v['id'].";";
   if (mysqli_query($conn, $sql)) {
  
   }else {
    print_r($sql);
      echo "Error UPDATE record: " . mysqli_error($conn);
   }
}else{
  $endId=$v['id'];
$sql = "DELETE FROM ".$oborudovanieSet['tablename']."   WHERE id=".$v['id'].";";
   if (mysqli_query($conn, $sql)) {
  
   }else {
    print_r($sql);
      echo "Error deleting record: " . mysqli_error($conn);
   }
 }



  }

  $sql = "INSERT INTO ".$oborudovanieSet['tablename']." (id,startperiod, endperiod, status, prichina,parentid) VALUES (".$endId.",".$startTime.",".$endTime.",$statusRem,'".$prichnaset."',".$oborudovanieSet['id'].");";
 if (mysqli_query($conn, $sql)) { }else {  print_r($sql);  echo "Error deleting record: " . mysqli_error($conn);}



}elseif(count($AllProm)==2){
////////////////////////////////////////////////////////////////////////////////
   $sql = "UPDATE  ".$oborudovanieSet['tablename']."  SET  endperiod=$startTime WHERE id=".$AllProm[0]['id'].";";
   if (mysqli_query($conn, $sql)) {
  
   }else {
    print_r($sql);
      echo "Error deleting record: " . mysqli_error($conn);
   }
  $sql = "UPDATE  ".$oborudovanieSet['tablename']."  SET  endperiod=$startTime WHERE id=".$AllProm[1]['id'].";";
   if (mysqli_query($conn, $sql)) {
  
   }else {
    print_r($sql);
      echo "Error deleting record: " . mysqli_error($conn);
   }

 $sth = $pdo->prepare("SELECT * FROM ".$oborudovanieSet['tablename']." ORDER BY id;");
$sth->execute([]);
$EndPeriodSql = $sth->fetch(PDO::FETCH_ASSOC);

  $sql = "INSERT INTO ".$oborudovanieSet['tablename']." (startperiod, endperiod, status, prichina,parentid) VALUES (".$startTime.",".$endTime.",$statusRem,'".$prichnaset."',".$oborudovanieSet['id'].");";
 if (mysqli_query($conn, $sql)) { }else {  print_r($sql);  echo "Error deleting record: " . mysqli_error($conn);}

 $sql = "INSERT INTO ".$oborudovanieSet['tablename']." (startperiod, endperiod, status,parentid) VALUES (".time().",".time().",".$EndPeriodSql['status'].",".$oborudovanieSet['id'].");";
 if (mysqli_query($conn, $sql)) { }else {  print_r($sql);  echo "Error deleting record: " . mysqli_error($conn);}



}elseif(count($AllProm)==1){
if($_GET['remont']=="1"){
    $statusRem = 5;
}else{
  $statusRem = 2;
}

 $sql = "UPDATE  ".$oborudovanieSet['tablename']."  SET  status=".$statusRem." WHERE id=".$AllProm[0]['id'].";";
   if (mysqli_query($conn, $sql)) {
  
   }else {
    print_r($sql);
      echo "Error deleting record: " . mysqli_error($conn);
   }
}else{
  $sql = "SELECT * FROM ".$oborudovanieSet['tablename']." WHERE (startperiod<".$startTime." AND endperiod>$endTime)  ORDER BY startperiod;";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $BigPeriod=$row;
        $r++;
    }
 $sql = "UPDATE  ".$oborudovanieSet['tablename']."  SET  endperiod=$startTime WHERE id=".$BigPeriod['id'].";";
   if (mysqli_query($conn, $sql)) {
  
   }else {
    print_r($sql);
      echo "Error deleting record: " . mysqli_error($conn);
   }

    $sql = "INSERT INTO ".$oborudovanieSet['tablename']." (startperiod, endperiod, status, prichina,parentid) VALUES (".$startTime.",".$endTime.",$statusRem,'".$prichnaset."',".$oborudovanieSet['id'].");";
 if (mysqli_query($conn, $sql)) { }else {  print_r($sql);  echo "Error deleting record: " . mysqli_error($conn);}
   $sql = "INSERT INTO ".$oborudovanieSet['tablename']." (startperiod, endperiod, status,parentid) VALUES (".$endTime.",".$BigPeriod['endperiod'].",".$BigPeriod['status'].",".$oborudovanieSet['id'].");";
 if (mysqli_query($conn, $sql)) { }else {  print_r($sql);  echo "Error deleting record: " . mysqli_error($conn);}
 $sql = "INSERT INTO ".$oborudovanieSet['tablename']." (startperiod, endperiod, status,parentid) VALUES (".time().",".time().",".$EndPeriodSql['status'].",".$oborudovanieSet['id'].");";
 if (mysqli_query($conn, $sql)) { }else {  print_r($sql);  echo "Error deleting record: " . mysqli_error($conn);}


}



$sth = $pdo->prepare("SELECT * FROM ".$oborudovanieSet['tablename']." WHERE endperiod>=? AND ?<=startperiod;");
$sth->execute([$startTime,$endTime]);
$PeriodStartA = $sth->fetch(PDO::FETCH_ASSOC);
 

   $sql = "INSERT INTO ".$oborudovanieSet['tablename']." (startperiod, endperiod, status, prichina,parentid) VALUES (?,?,?,?,?)";
   $stmt= $pdo->prepare($sql);
   $stmt->execute([$startTime, $endTime,$statusRem, $prichnaset,$oborudovanieSet['id']]);
   print_r($_GET['endTime']);echo" -  -  "; print_r(strtotime($_GET['endTime'])); echo "<br>"; echo"<br>";
   print_r([$startTime,$endTime]);
 
}  
if(!$_GET['updateRepair']){
  $sql = "INSERT INTO repairs (`id_obor`, `typeOfRepair`, `uzel`, `prichina`, `detailNameDestroy`, `codeDetailDestroy`, `datailNameNew`, `codeDetailNew`, `colMan`, `startTime`, `endTime`, `time`, `userid`, `opisanie`, `comment`) VALUES ('".$oborudovanieSet['id']."',' ".$_GET['remont']."', '".$prichnaset."', '".$_GET['prihina']."', '".$_GET['detalName']."', '".$_GET['CodeDetail']."', '".$_GET['detalNameInsrt']."', '".$_GET['CodeDetailInsert']."', ".$_GET['ManTo'].", ".strtotime($_GET['startTime']).", ".strtotime($_GET['endTime']).", ".time().", ".$_userid.", '".$_GET['opisanie']."', '".$_GET['comment']."');";
 if (mysqli_query($conn, $sql)) {
    //  echo "Коментарий изменен";
   }else {
    print_r($sql);
      echo "Error deleting record: " . mysqli_error($conn);
   }
 }else{
   $sql = "UPDATE  repairs  SET  `id_obor`='".$oborudovanieSet['id']."',`typeOfRepair`=' ".$_GET['remont']."', `uzel`='".$prichnaset."', `prichina`='".$_GET['prihina']."',  `detailNameDestroy`='".$_GET['detalName']."', `codeDetailDestroy`='".$_GET['CodeDetail']."', `datailNameNew`='".$_GET['detalNameInsrt']."', `codeDetailNew`='".$_GET['CodeDetailInsert']."', `colMan`=".$_GET['ManTo'].", `startTime`=".strtotime($_GET['startTime']).", `endTime`=".strtotime($_GET['endTime']).", `time`=".time().", `userid`=".$_userid.", `opisanie`='".$_GET['opisanie']."', `comment`='".$_GET['comment']."' WHERE id=".$_GET['updateRepair'].";";
 if (mysqli_query($conn, $sql)) {
    //  echo "Коментарий изменен";
   }else {
    print_r($sql);
      echo "Error deleting record: " . mysqli_error($conn);
   }
 }
header("Location: /start/repairs/repairsNow/index.php"); /* Перенаправление браузера */

/* Убедиться, что код ниже не выполнится после перенаправления .*/
exit;

}
if($_GET['redact']==1){
  $sth = $pdo->prepare("SELECT * FROM repairs WHERE id=?;");
  $sth->execute([$_GET['id']]);
  $repair = $sth->fetch(PDO::FETCH_ASSOC);

$repair=json_encode($repair);
}

    //шифрование данных в json для отправки в js
    $resJson=json_encode($res);

    include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); 
include 'index.html';  /// подключение файла html
    include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); 

?>
