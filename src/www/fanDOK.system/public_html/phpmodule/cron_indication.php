<?php
// хлебные крошки для сайта

$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
$put='/var/www/fanDOK.system/public_html/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля

include ($put);//// подключаю модуль связи с БД

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$sql = "SELECT * FROM point_control;";
$result1 = $conn->query($sql);
    $r=0;
    while($row = $result1->fetch_assoc()) {
        $res[$r]=$row;
        $r++;

      
    }
    //print_r($res);
    $t=time()-600;
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
        	  $statusprev[$row['oborudovanie']]=0;
        	$r++;
   		 }
}
foreach ($vals as $key => $value) {
	unset($st_norm);
	unset($st_warn);
	unset($st_alarm);

	if($value['oborudovanie']==="дробилка 1"){$st_alarm="hl_1"; $st_warn="hl_2"; $st_norm="hl_3";}
	elseif($value['oborudovanie']=="дробилка 2"){$st_alarm="hl_4"; $st_warn="hl_5"; $st_norm="hl_6";}
elseif($value['oborudovanie']=="дробилка 3"){$st_alarm="hl_7"; $st_warn="hl_8"; $st_norm="hl_9";}
elseif($value['oborudovanie']==="пила левая"){$st_alarm="hl_13"; $st_warn="hl_14"; $st_norm="hl_15";}
elseif($value['oborudovanie']==="пила правая"){$st_alarm="hl_16"; $st_warn="hl_17"; $st_norm="hl_18";}
elseif($value['oborudovanie']==="лущильный станок №1"){$st_alarm="hl_19"; $st_warn="hl_20"; $st_norm="hl_21";}
elseif($value['oborudovanie']==="лущильный станок №2"){$st_alarm="hl_22"; $st_warn="hl_23"; $st_norm="hl_24";}
elseif($value['oborudovanie']==="лущильный станок №3"){$st_alarm="hl_25"; $st_warn="hl_26"; $st_norm="hl_27";}
elseif($value['oborudovanie']==="шлифовальный станок"){$st_alarm="hl_10"; $st_warn="hl_11"; $st_norm="hl_12";}
else{$st_norm=null;}
if($st_norm){

			if($statusprev[$value['oborudovanie']]==0 && $value['gran_warn']>=$value['avg'] ){
				$val_alarm=0;
				$val_warn=0;
				$val_norm=1;

					$sql= "UPDATE  vibroIndication SET `".$st_norm."`=".$val_norm.",`".$st_warn."`=".$val_warn.",`".$st_alarm."`=".$val_alarm." ;";
					$result1 = $conn->query($sql);	mysqli_error($conn);
					print_r($sql); echo "<br>".$value['oborudovanie']."<br>".$statusprev[$value['oborudovanie']]."<br><br><br>";
			}
			elseif($value['gran_warn']<=$value['avg']){
					$val_alarm=0;
				$val_warn=1;
				$val_norm=0;
				if($value['gran_alarm']<=$value['avg']){

					$val_alarm=1;
				$val_warn=1;
				$val_norm=0;
								$statusprev[$value['oborudovanie']]=1;
					$sql= "UPDATE  vibroIndication SET `".$st_norm."`=".$val_norm.",`".$st_warn."`=".$val_warn.",`".$st_alarm."`=".$val_alarm." ;";
					$result1 = $conn->query($sql); mysqli_error($conn);
						print_r($sql);	echo "<br>".$value['oborudovanie']."<br>".$statusprev[$value['oborudovanie']]."<br><br><br>";
			}else{
				$statusprev[$value['oborudovanie']]=1;
					$sql= "UPDATE  vibroIndication SET `".$st_norm."`=".$val_norm.",`".$st_warn."`=".$val_warn.",`".$st_alarm."`=".$val_alarm." ;";
					$result1 = $conn->query($sql); mysqli_error($conn);
						print_r($sql); echo "<br>".$value['oborudovanie']."<br>".$statusprev[$value['oborudovanie']]."<br><br><br>";
			}
			}
	
}
}



?>