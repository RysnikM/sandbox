<?php
// хлебные крошки для сайта
set_time_limit ( 300 );
$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
$put='/var/www/fanDOK.system/public_html/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля

include ($put);//// подключаю модуль связи с БД
include "messageJson.php";
$sql = "SELECT * FROM point_control;";
$result1 = $conn->query($sql);
    $r=0;
    while($row = $result1->fetch_assoc()) {
        $res[$r]=$row;
        $r++;
    }
    //print_r($res);
    $t=time()-60*5;
    $ti=time();
foreach ($res as $key => $value) {
		$sql1 = "SELECT AVG(value) as avg, (SELECT name from oborudovanie WHERE id=".$value['parentid'].") as oborudovanie FROM ".$value['tablename']." WHERE time>".$t."  ;";
		$result = $conn->query($sql1);
    		$r=0;
 		   while($row = $result->fetch_assoc()) {
 		   	$row['gran_warn']=$value['granica_mess'];
 		   	$row['name']=$value['name'];
 		   		$row['id']=$value['id'];
 		   	$row['gran_alarm']=$value['granica_alarm'];
        	$vals[$value['id']]=$row;
        	$r++;
   		 }
}
foreach ($vals as $key => $value) {
	if($value['gran_warn']<=$value['avg']){
			if($value['gran_alarm']<=$value['avg']){
					$sql= "INSERT INTO err_message (`name`,`text`,`time`,`parentid`,`acknowledgment`) VALUES ('Превышение предельного уровня вибрации на ".$value['oborudovanie']."','Уровень превышен на узле ".$value['name']."',".$ti.",".$value['id'].",1);";
					$result1 = $conn->query($sql);	mysqli_error($conn);
					senPush("Превышение предельного уровня вибрации на ".$value['oborudovanie'],"Провень превышен на узле ".$value['name']);
			}else{
					$sql= "INSERT INTO err_message (`name`,`text`,`time`,`parentid`,`href`,`acknowledgment`) VALUES ('Превышение  уровня вибрации на ".$value['oborudovanie']."','Уровень превышен на узле ".$value['name']."',".$ti.",".$value['id'].",'/start/vibration/online_v/vibroOnline/index.php?id=".$value['parentid'].",1);";
					$result1 = $conn->query($sql); mysqli_error($conn);
						print_r($result1);	
			}
	}
}

$sql = "SELECT * FROM oborudovanie;";
$result1 = $conn->query($sql);
    $r=0;
    while($row = $result1->fetch_assoc()) {
        $obor[$r]=$row;
        $r++;
    }
        $toee=time()-60*10;
foreach ($obor as $key => $value) {
				$sql1 = "SELECT * FROM ".$value['tablename']." ORDER BY id desc limit 1  ;";
		$result = $conn->query($sql1);
    		$r=0;
 		   while($row = $result->fetch_assoc()) {
 		   	$row['name']=$value['name'];
 	//	   		$row['id']=$value['id'];
 		    	$oee[$value['id']]=$row;
       	$r++;
   		 }
}

foreach ($oee as $key => $value) {

			 if(($value['endperiod']-$value['startperiod'])>=1800 && ($value['status']==0 || $value['status']==3)){
					$sql= "INSERT INTO err_message (`name`,`text`,`time`,`parentid`,`href`,`acknowledgment`) VALUES ('Простой оборудования ".$value['name']."','Оборудование стоит больше 30 минут',".$ti.",".$value['id'].",'/start/oee/oee_online/',1);";
                    senPush("Простой оборудования ".$value['name'],"Оборудование стоит больше 30 минут");
					$result1 = $conn->query($sql);	mysqli_error($conn);
	
				}elseif(($value['endperiod']-$value['startperiod'])>=600 && ($value['status']==0 || $value['status']==3)){
                        $sql= "INSERT INTO err_message (`name`,`text`,`time`,`parentid`,`href`,`acknowledgment`) VALUES ('Простой оборудования ".$value['name']."','Оборудование стоит больше 10 минут',".$ti.",".$value['id'].",'/start/oee/oee_online/',1);";
                    $result1 = $conn->query($sql);  mysqli_error($conn);
                }elseif(($value['endperiod']-$value['startperiod'])>=300 && ($value['status']==0 || $value['status']==2)){
                    $sql= "INSERT INTO err_message (`name`,`text`,`time`,`parentid`,`href`,`acknowledgment`) VALUES ('Авария на оборудовании ".$value['name']."','Обобрудование стоит больше 5 минут',".$ti.",".$value['id'].",'/start/oee/oee_online/',1);";
                }

}
$sql = "SELECT * FROM status_connection WHERE status=0;";
$result13 = $conn->query($sql);
    $r=0;
    while($row = $result13->fetch_assoc()) {
        $res[$r]=$row;
        $r++;
             $sql= "INSERT INTO err_message (`name`,`text`,`time`,`parentid`,`acknowledgment`) VALUES ('Нет связи с устройством ".$row['name']."','Нет связи с узлом,".$row['ip'].", установленном на оборудовании ".$row['name']."',".$ti.",".$row['id'].",1);";
              $result1 = $conn->query($sql);  mysqli_error($conn);
              print_r($result1);
        
    }

?>