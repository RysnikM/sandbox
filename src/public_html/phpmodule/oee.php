<?php

$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
$put='/var/www/fanDOK.system/public_html/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля

include ($put);//// подключаю модуль связи с БД

$col=$_GET['col'];
$dayago=time()-(600);
$r=0;
  $sql="SELECT * FROM oborudovanie WHERE  oee=1;";
  $result = $conn->query($sql);
   

    while($row = $result->fetch_assoc()) {
      $obor[$r]=$row;
        $r++;
    }


foreach ($obor as $key => $value) {
$r=0;
  $sql="SELECT SUM(startperiod) as startSum, SUM(endperiod) as endSum  FROM ".$value['tablename']." WHERE status=1 AND  endperiod>=".$dayago.";";
  $result = $conn->query($sql);
   

    while($row = $result->fetch_assoc()) {
    	$row['timeWork']=$row['endSum']-$row['startSum'];
    	$row['A_OEE']=round(100*($row['timeWork']/600));
    	if($row['A_OEE']>100){$row['A_OEE']=100;}
    	$row["Q_OEE"]=95;
    	$row['tablename']=$value['tablename'];
    	$row['id']=$value['id'];
    	$row['nameobor']=$value['name'];
    	
      $pointsOee[$key]=$row;
        $r++;
    }
	
}
foreach ($pointsOee as $key => $value) {
	if((int)$value['id']== 46 || (int)$value['id']== 47 || (int)$value['id']== 48){
	
	$r=0;
  $sql="SELECT *  FROM  ".$value['tablename']."_Data  WHERE   timeStamp>=".$dayago." ORDER BY id;";
  $result = $conn->query($sql);
   

    while($row = $result->fetch_assoc()) {
   
      $luShpon[$r]=$row;
        $r++;
    }
    	$estnol=0;
    foreach($luShpon as $k=>$val){
    		if($val['data']==0 || $luShpon[$k-1]['data']>$luShpon[$k]['data']){
    			if($estnol==0){$numkey=$k;}
    			$estnol=1;

    			
    		}
    		print_r($val['data']); echo "<br>";
    	}
    	echo "<br>";echo "<br>";echo "<br>";
    		if($estnol==1){
    				$c=count($luShpon);
    				
    			$ferst_col=($luShpon[$numkey-1]['data']-$luShpon[0]['data'])+$luShpon[$c-1]['data'];
    		}else{
    			$c=count($luShpon);

    			$ferst_col=$luShpon[$c-1]['data']-$luShpon[0]['data'];
    		}
    	
    		$value['P_OEE']=100*($ferst_col/0.625);
            if($value['P_OEE']>100){$value['P_OEE']=97;}
//echo "<br>";echo $ferst_col;echo "<br>";echo "<br>";
}else{
	$value['P_OEE']=70;
}
//print_r($value['P_OEE']); echo "<br>";
$pointsOee[$key]['P_OEE']=$value['P_OEE'];
$pointsOee[$key]['OEE']=100*(($value['P_OEE']/100)*($value['A_OEE']/100)*($value['Q_OEE']/100));
}
print_r($pointsOee);
foreach ($pointsOee as $key => $value) {
	$sql="INSERT INTO ".$value['tablename']."_oee (startperiod,endperiod,A,P,Q,OEE) VALUE (".(time()-600).",".time().",".$value['A_OEE'].",".$value['P_OEE'].",".$value['Q_OEE'].",".$value['OEE'].") ;";
	 $result = $conn->query($sql);
	}
?>