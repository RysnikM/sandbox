<?php

$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
include ($put);//// подключаю модуль связи с БД

set_time_limit(120);
// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);


$tables=$_GET['tables'];
$start_p=$_GET['start'];
$end_p=$_GET['end'];
$count=$_GET['count'];
$tab = explode("|||", $tables);
 array_pop($tab);

$cammarr=array();

// $col=intdiv($end_p-$start_p, $count*60);


// error_reporting(E_ALL);
// ini_set("display_errors", "on");
ini_set("memory_limit", "10224M");

$stmt = $pdo->prepare("SELECT point_control.id as pointId,point_control.granica_mess as mess,point_control.granica_alarm as alarm,point_control.timechange as timechange,  point_control.name as pointName, @tabname:=point_control.tablename as pointTablename, point_control.parentid as pointParentid, (select oborudovanie.id from oborudovanie where oborudovanie.id=point_control.parentid) as oborudovanieId, (select oborudovanie.name from oborudovanie where oborudovanie.id=point_control.parentid) as oborudovanieName,(select oborudovanie.code from oborudovanie where oborudovanie.id=point_control.parentid) as oborudovanieCode FROM point_control WHERE point_control.id=?;");
$e=0;

foreach ($tab as $id => $bonus)
{


    $stmt->execute(array($bonus));
    $points[$bonus] = $stmt->fetch(PDO::FETCH_ASSOC);
 //   print_r($points[$bonus]["pointTablename"]);
    $max = $pdo->query('SELECT MAX(value) FROM '.$points[$bonus]["pointTablename"].'  WHERE time>='.$start_p.' AND time<='.$end_p)->fetchAll(PDO::FETCH_COLUMN);
    $points[$bonus]['max']=$max[0];
     $min = $pdo->query('SELECT MIN(value) FROM '.$points[$bonus]["pointTablename"].'  WHERE time>='.$start_p.' AND time<='.$end_p)->fetchAll(PDO::FETCH_COLUMN);
     $points[$bonus]['min']=$min[0];
      $avg = $pdo->query('SELECT AVG(value) FROM '.$points[$bonus]["pointTablename"].'  WHERE time>='.$start_p.' AND time<='.$end_p)->fetchAll(PDO::FETCH_COLUMN);
     $points[$bonus]['avg']=$avg[0];
         $real = $pdo->query('SELECT AVG(value) FROM '.$points[$bonus]["pointTablename"].'  WHERE time>='.$start_p.' AND time<='.$end_p.' ORDER BY value desc LIMIT 5')->fetchAll(PDO::FETCH_COLUMN);
     $points[$bonus]['real']=$real[0];
$gral[$points[$bonus]["oborudovanieId"]][$bonus][0]=$points[$bonus]["mess"];
$gral[$points[$bonus]["oborudovanieId"]][$bonus][1]=$points[$bonus]["alarm"];     
     $ob_name[$bonus]= $points[$bonus]['oborudovanieName'];
     $point_name[$bonus]= $points[$bonus]['pointName']; 
    $sqls[$points[$bonus]["pointId"]] = "SELECT id, `time`*1000 as x, value as y FROM ".$points[$bonus]["pointTablename"]." WHERE time>=? AND time<=?  ";
    $e++;
}

set_time_limit(200);
foreach ($sqls as $id => $bonus)
{
    $stmt = $pdo->prepare($bonus);
         if (!$stmt) {
    echo "\nPDO::errorInfo():\n";
    print_r($dbh->errorInfo());
}
     $stmt->execute([$start_p,$end_p]);

     $values[$id] = $stmt->fetchAll(PDO::FETCH_UNIQUE);




//$values1[$id]=array_chunk($values[$id], $count,true);

}
// echo "<br>";
$e=0;
$avgg=0;
$c=0;
$avgval=[];


foreach ($values as $key => $value) {
    foreach ($value as $k => $val) {
        // if(!$avgval[$key]){
        //     $avgval[$key][$k]=[];
        // }
        if($e==0){
            $e=$val['x'];
            $avgg+=$val['y'];
            $c++;
        }else{
            if($e+($count*60000)<$val['x']){
                   $avgval[$key][$k]=['x'=>$e,'y'=>$avgg/$c];
                $e=0;
                $avgg=0;
                $avgg+=$val['y'];
                $c=1;
            }else{
                $avgg+=$val['y'];
                $c++;
                    if(!$value[$k+1]){
                        $avgval[$key][$k]=['x'=>$e,'y'=>$avgg/$c];
                        $e=0;
                        $c=1;
                    }
            }
        }
    }
}
// echo "<br>";
// print_r($avgval);
// echo "<br>";
// echo "<br>";
$ob_name = array_unique($ob_name);
 $res=["data"=>$points,"values"=>$avgval,"names_oborudovanie"=>$ob_name,"names_points"=>$poin,"gran"=>$gral,"count"=>$count*60*1000,"prim"=>$values];  

  echo json_encode($res);

?>