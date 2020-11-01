<?php
// проверка авторизации пользователя
session_start();
if(!$_SESSION['username']){print_r("Вы не авторизованны"); echo"<br>"; echo"<a href='/'>К авторизации</a>"; exit();}

$name=$_SESSION['username'];

$put1=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/croshki.php'; // создаю абсолютный путь до модуля хлебных крошек
include ($put1);//// подключаю модуль хлебных крошек



$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
include ($put);//// подключаю модуль связи с БД





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
$dayago=$now-(600);
$ress = array();
$i=0;
  $mass1[0]=array("seriesN"=>"Работает","turboThreshold"=>99999);
   $mass1[$i]["data"]=array();
       $r=0;

  $i++;
 $mass2[1]=array("seriesN"=>"Авария","turboThreshold"=>99999);

    $mass3[2]=array("seriesN"=>"Выключен","turboThreshold"=>99999);

 $mass4[3]=array("seriesN"=>"Простой","turboThreshold"=>99999);

 $mass=$mass1+$mass2+$mass3+$mass4;


$t=0;
  $r=0;
     $ferst=array();
foreach ($resultquery as $key => $value) {
  
  $sql1="SELECT * FROM ".$value['tablename']."  ORDER BY id desc LIMIT 1;";
  $result1 = $conn->query($sql1);
   
 
    while($row1 = $result1->fetch_assoc()) {
      $ferst[$key] = array();
      if((int)$row1['status']==1){
        $ferst[$key]=array("seriesN"=>0,"id"=>$row1['id'],"name"=>$row1['coment'],"x"=>(int)$row1["endperiod"]*1000,"y"=>(int)$row1['parentid'],"status"=>$row1['status']);
      }
      if((int)$row1['status']==2){
        $ferst[$key]=array("seriesN"=>1,"id"=>$row1['id'],"name"=>$row1['coment'],"x"=>(int)$row1["endperiod"]*1000,"y"=>(int)$row1['parentid'],"status"=>$row1['status']);
      }
       if((int)$row1['status']==0){
        $ferst[$key]=array("seriesN"=>2,"id"=>$row1['id'],"name"=>$row1['coment'],"x"=>(int)$row1["endperiod"]*1000,"y"=>(int)$row1['parentid'],"status"=>$row1['status']);
      }
       if((int)$row1['status']==3){
        $ferst[$key]=array("seriesN"=>3,"id"=>$row1['id'],"name"=>$row1['coment'],"x"=>(int)$row1["endperiod"]*1000,"y"=>(int)$row1['parentid'],"status"=>$row1['status']);
      }

    }
 //   $mass4[$i]["data"]=$mass4[$i]["data"]+ $ress;
    $t++;  
}


$t=0;
$mass[0]['data']=[];
$mass[1]['data']=[];
$mass[2]['data']=[];
$mass[3]['data']=[];
foreach ($ferst as $key => $value) {

if((int)$value["status"]==1){

     //    $mass[0]['data']=$ferst;
array_push($mass[0]['data'], $value);

}

if((int)$value["status"]==2){

      //   $mass[1]['data']=$ferst;
array_push($mass[1]['data'], $value);
}

if((int)$value["status"]==0){

       //  $mass[2]['data']=$ferst;
array_push($mass[2]['data'], $value);
}

if((int)$value["status"]==3){

 //        $mass[3]['data']=$ferst;
array_push($mass[3]['data'], $value);
}

}

  // print_r($mass);
    $mass=json_encode($ferst);
print_r($mass);

?>