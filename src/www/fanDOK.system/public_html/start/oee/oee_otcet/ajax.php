<?php

$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
include ($put);//// подключаю модуль связи с БД



$tables=$_GET['tables'];
$start=$_GET['start'];
$end=$_GET['end'];
$count=$_GET['count'];
$tab = explode("|||", $tables);
 array_pop($tab);

$cammarr=array();

///////////////////////////////////////////////// лллучаем все данные по выбранным точкам контроля
foreach ($tab as $key => $value) {
$sql12 = "SELECT code,name FROM oborudovanie WHERE tablename='".$value."' ;";

$result12 = $conn->query($sql12);
if ($result12->num_rows > 0) {
    // output data of each row
    $r12=0;
    while($row12 = $result12->fetch_assoc()) {

$sql1 = "SELECT name FROM group_o WHERE id='".$row12['code']."' ;";

$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    // output data of each row
    $r1=0;
    while($row1 = $result1->fetch_assoc()) {
$group_o=$row1;
        $r1++;
    }
}

$oname["nameobor"]=$row12['name'];
$oname["group"]=$group_o['name'];
        $r12++;
    }
}

// $value = explode("|||", $value);

$sql112 = "SELECT * FROM ".$value."_oee WHERE startperiod>=".$start." AND endperiod<=".$end.";";

$result112 = $conn->query($sql112);
if ($result112->num_rows > 0) {
    // output data of each row
    $r112=0;
    while($row112 = $result112->fetch_assoc()) {
$oee[$value]['graph'][$r112]=$row112;
        $r112++;

    }
    $oee[$value]["nametab"]=$oname;
}


}

if($count>10){
    $chu=$count/10;
 foreach ($oee as $key => $value) {
    $c=count($value['graph']);
      $arrrays=array_chunk($value['graph'], $chu);
       foreach ($arrrays as $k => $val) {
        $oeesum=0;
        $Asum=0;
        $Psum=0;
        $Qsum=0;
        $ii=0;
 for ($i=0; $i <= count($val); $i++) { 
$oeesum+=$val[$i]['OEE'];
$Asum+=$val[$i]['A'];
$Psum+=$val[$i]['P'];
$Qsum+=$val[$i]['Q'];
$ii++;
 }
 $oee[$key]['graph'][$k]['OEE']=round($oeesum/count($val));
  $oee[$key]['graph'][$k]['A']=round($Asum/count($val));
   $oee[$key]['graph'][$k]['P']=round($Psum/count($val));
    $oee[$key]['graph'][$k]['Q']=round($Qsum/count($val));
    $oee[$key]['graph'][$k]['startperiod']=$val[0]['startperiod'];
    $oee[$key]['graph'][$k]['endperiod']=$val[count($val)-1]['endperiod'];

 }
 array_splice($oee[$key]['graph'], $k+1);
}

}elseif($count==="smena"){
$ferstHour=date("G",$start);
   $offsetMin=date("i",$start);
if(( (int)$ferstHour==23) || ((int)$ferstHour>=0 && (int)$ferstHour<=7) ){
if((int)$ferstHour>9){
$endTosmena= 8;
}else{
    $endTosmena=(7-(int)$ferstHour) ;
}
}
elseif((int)$ferstHour>=7 && (int)$ferstHour<=15 ){
     $endTosmena=(15-(int)$ferstHour);
}
elseif((int)$ferstHour>=15 && (int)$ferstHour<=23){
$endTosmena=(23-(int)$ferstHour);
}


///////////////////////////////////////////////////////////////////////////////////////////

foreach ($tab as $key => $value) {
$sql12 = "SELECT code,name FROM oborudovanie WHERE tablename='".$value."' ;";

$result12 = $conn->query($sql12);
if ($result12->num_rows > 0) {
    // output data of each row
    $r12=0;
    while($row12 = $result12->fetch_assoc()) {

$sql1 = "SELECT name FROM group_o WHERE id='".$row12['code']."' ;";

$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    // output data of each row
    $r1=0;
    while($row1 = $result1->fetch_assoc()) {
$group_o=$row1;
        $r1++;
    }
}

$oname["nameobor"]=$row12['name'];
$oname["group"]=$group_o['name'];
        $r12++;
    }
}

// $value = explode("|||", $value);

$sql112 = "SELECT * FROM ".$value."_oee WHERE startperiod>=".$start." AND endperiod<=".($start+(($endTosmena*3600)-$offsetMin*60)).";";

$result112 = $conn->query($sql112);
if ($result112->num_rows > 0) {
    // output data of each row
    $r112=0;
    while($row112 = $result112->fetch_assoc()) {
$oee1[$value]['graph'][$r112]=$row112;
        $r112++;
    }
    $oee1[$value]["nametab"]=$oname;
}else{
    $sql1 = "SELECT * FROM ".$value."_oee WHERE startperiod>=".$start." ORDER BY startperiod asc LIMIT 1  ;";
    $result12 = $conn->query($sql1);
        $r112=0;
    while($row12 = $result12->fetch_assoc()) {
$startValues=$row12;
        $r112++;
    }
    $newstart=date("G",$startValues['startperiod']);
    $offsetMin=date("i",$startValues['startperiod']);




if(( (int)$newstart==23) || ((int)$newstart>=0 && (int)$newstart<=7) ){
if((int)$newstart>9){
$endTosmena= 8;
}else{
    $endTosmena=(7-(int)$newstart) ;
}
}
elseif((int)$newstart>=7 && (int)$newstart<=15 ){
     $endTosmena=(15-(int)$newstart);
}
elseif((int)$newstart>=15 && (int)$newstart<=23){
$endTosmena=(23-(int)$newstart);
}
$sql112 = "SELECT * FROM ".$value."_oee WHERE startperiod>=".$startValues['startperiod']." AND endperiod<=".($startValues['startperiod']+(($endTosmena*3600)-$offsetMin*60)).";";
$start=$startValues['startperiod'];
$result112 = $conn->query($sql112);
if ($result112->num_rows > 0) {
    // output data of each row
    $r112=0;
    while($row112 = $result112->fetch_assoc()) {
$oee1[$value]['graph'][$r112]=$row112;
        $r112++;
    }
    $oee1[$value]["nametab"]=$oname;
}


}

//
}



 foreach ($oee1 as $key => $value) {
    $c=count($value['graph']);
 
        $oeesum=0;
        $Asum=0;
        $Psum=0;
        $Qsum=0;
        $ii=0;
 for ($i=0; $i < $c; $i++) { 
$oeesum+=$value['graph'][$i]['OEE'];
$Asum+=$value['graph'][$i]['A'];
$Psum+=$value['graph'][$i]['P'];
$Qsum+=$value['graph'][$i]['Q'];
$ii++;
 }
 $oee12[$key]['graph'][0]['OEE']=round($oeesum/$c);
  $oee12[$key]['graph'][0]['A']=round($Asum/$c);
   $oee12[$key]['graph'][0]['P']=round($Psum/$c);
    $oee12[$key]['graph'][0]['Q']=round($Qsum/$c);
    $oee12[$key]['graph'][0]['startperiod']=$value['graph'][0]['startperiod'];
    $oee12[$key]['graph'][0]['endperiod']=$value['graph'][$c-1]['endperiod'];

 
// array_splice($oee1[$key]['graph'], $k+1);
}


////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////



$endHour=date("G",$end);
$offsetEnd=date("i",$end);
if(( (int)$endHour==23) || ((int)$endHour>=0 && (int)$endHour<=7) ){
if((int)$endHour>9){
$ostalos= 0;
}else{
    $ostalos=(int)$endHour ;
}
}
elseif((int)$endHour>=7 && (int)$endHour<=15 ){
     $ostalos=((int)$endHour-7);
}
elseif((int)$endHour>=15 && (int)$endHour<=23){
$ostalos=((int)$endHour-15);
}

///**********************************************************************************************



foreach ($tab as $key => $value) {
$sql12 = "SELECT code,name FROM oborudovanie WHERE tablename='".$value."' ;";

$result12 = $conn->query($sql12);
if ($result12->num_rows > 0) {
    // output data of each row
    $r12=0;
    while($row12 = $result12->fetch_assoc()) {

$sql1 = "SELECT name FROM group_o WHERE id='".$row12['code']."' ;";

$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    // output data of each row
    $r1=0;
    while($row1 = $result1->fetch_assoc()) {
$group_o=$row1;
        $r1++;
    }
}

$oname["nameobor"]=$row12['name'];
$oname["group"]=$group_o['name'];
        $r12++;
    }
}

// $value = explode("|||", $value);

$sql112 = "SELECT * FROM ".$value."_oee WHERE startperiod>=".($end-($ostalos*3600)+$offsetEnd*60)." AND endperiod<=".$end.";";

$result112 = $conn->query($sql112);
if ($result112->num_rows > 0) {
    // output data of each row
    $r112=0;
    while($row112 = $result112->fetch_assoc()) {
$oee2[$value]['graph'][$r112]=$row112;
        $r112++;
    }
    $oee2[$value]["nametab"]=$oname;
}

//print_r($oee2);
}

 foreach ($oee2 as $key => $value) {
    $c=count($value['graph']);
 
        $oeesum=0;
        $Asum=0;
        $Psum=0;
        $Qsum=0;
        $ii=0;
 for ($i=0; $i < $c; $i++) { 
$oeesum+=$value['graph'][$i]['OEE'];
$Asum+=$value['graph'][$i]['A'];
$Psum+=$value['graph'][$i]['P'];
$Qsum+=$value['graph'][$i]['Q'];
$ii++;
 }
 $oee22[$key]['graph'][0]['OEE']=round($oeesum/$c);
  $oee22[$key]['graph'][0]['A']=round($Asum/$c);
   $oee22[$key]['graph'][0]['P']=round($Psum/$c);
    $oee22[$key]['graph'][0]['Q']=round($Qsum/$c);
    $oee22[$key]['graph'][0]['startperiod']=$value['graph'][0]['startperiod'];
    $oee22[$key]['graph'][0]['endperiod']=$value['graph'][$c-1]['endperiod'];

 
// array_splice($oee1[$key]['graph'], $k+1);
}





////*****************************************************************************************



foreach ($tab as $key => $value) {
$sql12 = "SELECT code,name FROM oborudovanie WHERE tablename='".$value."' ;";

$result12 = $conn->query($sql12);
if ($result12->num_rows > 0) {
    // output data of each row
    $r12=0;
    while($row12 = $result12->fetch_assoc()) {

$sql1 = "SELECT name FROM group_o WHERE id='".$row12['code']."' ;";

$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
    // output data of each row
    $r1=0;
    while($row1 = $result1->fetch_assoc()) {
$group_o=$row1;
        $r1++;
    }
}

$oname["nameobor"]=$row12['name'];
$oname["group"]=$group_o['name'];
        $r12++;
    }
}

// $value = explode("|||", $value);

$sql112 = "SELECT * FROM ".$value."_oee WHERE startperiod>=".($start+($endTosmena*3600)-$offsetMin*60)." AND endperiod<=".($end-($ostalos*3600)+$offsetEnd*60).";";

$result112 = $conn->query($sql112);
if ($result112->num_rows > 0) {
    // output data of each row
    $r112=0;
    while($row112 = $result112->fetch_assoc()) {
$oee3[$value]['graph'][$r112]=$row112;
        $r112++;
    }
    $oee3[$value]["nametab"]=$oname;
}

//print_r($oee2);
}




    $chu=(8*6);
 foreach ($oee3 as $key => $value) {
    $c=count($value['graph']);
      $arrrays=array_chunk($value['graph'], $chu);
       foreach ($arrrays as $k => $val) {
        $oeesum=0;
        $Asum=0;
        $Psum=0;
        $Qsum=0;
        $ii=0;
 for ($i=0; $i <= count($val); $i++) { 
$oeesum+=$val[$i]['OEE'];
$Asum+=$val[$i]['A'];
$Psum+=$val[$i]['P'];
$Qsum+=$val[$i]['Q'];
$ii++;
 }
 $oee31[$key]['graph'][$k]['OEE']=round($oeesum/count($val));
  $oee31[$key]['graph'][$k]['A']=round($Asum/count($val));
   $oee31[$key]['graph'][$k]['P']=round($Psum/count($val));
    $oee31[$key]['graph'][$k]['Q']=round($Qsum/count($val));
    $oee31[$key]['graph'][$k]['startperiod']=$val[0]['startperiod'];
    $oee31[$key]['graph'][$k]['endperiod']=$val[count($val)-1]['endperiod'];

 }
 array_splice($oee31[$key]['graph'], $k+1);
}
foreach ($oee31 as $key => $value) {
    
    array_unshift($oee31[$key]['graph'],$oee12[$key]['graph'][0]);

       array_push($oee31[$key]['graph'],$oee22[$key]['graph'][0]);
       $oee3[$key]["graph"]=array();
        $oee3[$key]["graph"]=$oee31[$key]['graph'];
}


unset($oee);
$oee=$oee3;
// print_r($oee12);
// echo "<br><br><br><br><br>";
// print_r($oee22);
// echo "<br><br><br><br><br>";
///////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////

}

//////////////////////////////////////////
///////////////////////////////////////////////////////////////////
//ПОлучаем список причин простое оборудования
foreach ($tab as $key => $value) {

$sql="SELECT * FROM ".$value." WHERE startperiod>=".$start." AND  endperiod<=".$end." ORDER BY startperiod LIMIT 1 ;";
$result = $conn->query($sql);
$row=array();
    while($row = $result->fetch_assoc()) {
$startperiod=$row['startperiod'];
    }
$sql="SELECT * FROM ".$value." WHERE startperiod>=".$start." AND  endperiod<=".$end." ORDER BY endperiod DESC LIMIT 1 ;";
$result = $conn->query($sql);
$row=array();
    while($row = $result->fetch_assoc()) {
$endper=$row['endperiod'];
    }

    $sql="SELECT * FROM oborudovanie WHERE tablename='".$value."' ;";
$result = $conn->query($sql);
$row=array();
    while($row = $result->fetch_assoc()) {
$oborName=$row['name'];
    }


$sql="SELECT SUM(startperiod) as sumStart, SUM(endperiod) as sumEnd FROM ".$value." WHERE startperiod>=".$start." AND  endperiod<=".$end."  AND (status=0 OR status=2 OR status=3) ;";
$result = $conn->query($sql);
$AllProstoiTime=0;
    $r=0;
    $row=array();
    while($row = $result->fetch_assoc()) {
        $row['AllProstoi']=(int)$row['sumEnd']-(int)$row['sumStart'];
        $AllProstoiTime=$row['AllProstoi'];
        $row['startOfValues']=$startperiod;
           $row['allTime']=$endper-$startperiod;
           $row["procentAll"]=round(100*($row['AllProstoi']/$row['allTime']),2);
$prichiny[$value]["prostoiAll"]=$row;
        $r++;
    }

$sql="SELECT SUM(startperiod) as sumStart, SUM(endperiod) as sumEnd FROM ".$value." WHERE startperiod>=".$start." AND  endperiod<=".$end."  AND (status=0 OR status=2 OR status=3) AND prichina is null ;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $r=0;
    $row=array();
    while($row = $result->fetch_assoc()) {
        $row['withoutReason']=(int)$row['sumEnd']-(int)$row['sumStart'];
        $row['startOfValues']=$startperiod;
         $row['oborudovanie']=$oborName;
           $row['allTime']=$endper-$startperiod;
           $row["procentOfAllTime"]=round(100*($row['withoutReason']/$row['allTime']),2);
           $row["procentOfProstoi"]=round(100*($row['withoutReason']/$AllProstoiTime),2);
$prichiny[$value]["withoutReason"]=$row;
        $r++;
    }
$sql="SELECT SUM(startperiod) as sumStart, SUM(endperiod) as sumEnd FROM ".$value." WHERE startperiod>=".$start." AND  endperiod<=".$end."  AND (status=0 OR status=2 OR status=3) AND prichina is NOT null ;";
$result = $conn->query($sql);

    $r=0;
    $row=array();
    while($row = $result->fetch_assoc()) {
        $row['withoutReason']=(int)$row['sumEnd']-(int)$row['sumStart'];
        $row['startOfValues']=$startperiod;
           $row['allTime']=$endper-$startperiod;
           $row["procentOfAllTime"]=round(100*($row['withoutReason']/$row['allTime']),2);
           $row["procentOfProstoi"]=round(100*($row['withoutReason']/$AllProstoiTime),2);
$prichiny[$value]["withReason"]=$row;
        $r++;
    }

$sql="SELECT prichina FROM ".$value." WHERE startperiod>=".$start." AND  endperiod<=".$end." AND prichina is NOT null ;";
$result = $conn->query($sql);
$row=array();
$prichinaforOne=array();
    $r=0;
    while($row = $result->fetch_assoc()) {

$prichinaforOne[$r]=$row['prichina'];
        $r++;
    }
    foreach ($prichinaforOne as $k => $val) {
        $sql1="SELECT SUM(startperiod) as sumStart, SUM(endperiod) as sumEnd FROM ".$value." WHERE startperiod>=".$start." AND  endperiod<=".$end."  AND prichina='".$val."';";
        $result1 = $conn->query($sql1);
        $r1=0;
        $row1=array();
        while($row1 = $result1->fetch_assoc()) {
            $row1['withoutReason']=(int)$row1['sumEnd']-(int)$row1['sumStart'];
            $row1['startOfValues']=$startperiod;
             $row1['nameObor']=$value;
             $row1['oborudovanie']=$oborName;
              $row1['namePrichina']=$val;
            $row1['allTime']=$endper-$startperiod;
            $row1["procentOfAllTime"]=round(100*($row1['withoutReason']/$row1['allTime']),2);
            $row1["procentOfAllProstoi"]=round(100*($row1['withoutReason']/$AllProstoiTime),2);
            $prichiny[$value]["poPrichinam"][$val]=$row1;
            $r1++;
        }
    }

}

}

$res=array("oee"=>$oee,"prostoi"=>$prichiny);	
  echo json_encode($res);

?>