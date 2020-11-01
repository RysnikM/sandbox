<?php

$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
include ($put);//// подключаю модуль связи с БД




$tables=$_GET['tables'];
$start_p=$_GET['start'];
$end_p=$_GET['end'];
$count=$_GET['count'];
$tab = explode("|||", $tables);
 array_pop($tab);

$cammarr=array();

// $col=intdiv($end_p-$start_p, $count*60);
    $from=time()-(60*60*24*30*5);

$ty=time()*1000;

$online=[];
array_push($online,$ty);
$e=0;
foreach ($tab as $id => $bonus)
{

    $online_v = $pdo->query('SELECT value FROM '.$bonus.'  WHERE time>='.$from.' ORDER BY `time` DESC LIMIT 1 ; ')->fetchAll(PDO::FETCH_COLUMN);
array_push($online,$online_v[0]);

    $e++;
}

 

  echo json_encode($online);

?>

