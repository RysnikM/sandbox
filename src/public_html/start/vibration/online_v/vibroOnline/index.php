<?php
// проверка авторизации пользователя
session_start();
if(!$_SESSION['username']){print_r("Вы не авторизованны"); echo"<br>"; echo"<a href='/'>К авторизации</a>"; exit();}
$name=$_SESSION['username'];
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
if($res['level']<4){print_r("Вы не имеете прав доступа к данному контенту");echo"<br>"; echo"<a href='/start'>На главную</a>"; exit();}
$idob=$_GET["id"];
ini_set("memory_limit", "1224M");
    $oborudovanie = $pdo->query('SELECT id,name,code FROM oborudovanie WHERE id='.$idob)->fetchAll(PDO::FETCH_ASSOC);

    $points = $pdo->query('SELECT * FROM point_control WHERE parentid='.$idob)->fetchAll(PDO::FETCH_ASSOC);
    $from=time()-(60*60*24*3);
    $pointsname=[];
      $pointsid=[];
    $granica_mess=[];
    $granica_alarm=[];
    $values_to_js=[];
     $tablename=[];
foreach ($points as $key => $value) {
    if($value['name']){
array_push($pointsname,$value['name']);
}
   if($value['id']){
array_push($pointsid,$value['id']);
}
   if($value['tablename']){
array_push($tablename,$value['tablename']);
}
   if($value['granica_mess']){
array_push($granica_mess,$value['granica_mess']);

}
   if($value['granica_alarm']){
array_push($granica_alarm,$value['granica_alarm']);
}
if($value['tablename']){
  $times_arr[$key] = $pdo->query('SELECT `time` FROM '.$value['tablename'].'  WHERE time>'.$from.' ORDER BY `time` ASC ; ')->fetchAll(PDO::FETCH_ASSOC);

  $values[$key] = $pdo->query('SELECT `time` as x,value as y FROM '.$value['tablename'].' WHERE time>'.$from.' ORDER BY `time` ASC  ; ')->fetchAll(PDO::FETCH_ASSOC);
}
}
$timepush=[];
foreach ($times_arr[0] as $key => $value) {
array_push($timepush,$value['time']*1000);
}
$e=0;
foreach ($values as $key => $value) {
   $values_to_js[$e]=[];
foreach ($value as $k => $val) {
    $a=["x"=>$val['x']*1000,"y"=>$val["y"]];
array_push($values_to_js[$e],$a);
}
$e++;
//print_r($values_to_js);
}
$online=[];
array_push($online,time());
$e=0;
foreach ($tablename as $id => $bonus)
{

    $online_v = $pdo->query('SELECT value FROM '.$bonus.'  WHERE time>='.$from.' ORDER BY `time` DESC LIMIT 1 ; ')->fetchAll(PDO::FETCH_COLUMN);
array_push($online,$online_v[0]);

    $e++;
}

$namecharts=[$oborudovanie["name"]];
$namecharts=json_encode($namecharts);
$tablename=json_encode($tablename);
$timepush=json_encode($timepush);
$pointsname=json_encode($pointsname);
$pointsid=json_encode($pointsid);
$granica_mess=json_encode($granica_mess);
$granica_alarm=json_encode($granica_alarm);
$values_to_js=json_encode($values_to_js);
$online=json_encode($online);
    include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); //header
include 'index.html';  /// подключение файла html
    include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); //footer

?>