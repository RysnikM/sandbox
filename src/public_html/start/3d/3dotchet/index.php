<?php
// проверка авторизации пользователя
session_start();
if(!$_SESSION['username']){print_r("Вы не авторизованны"); echo"<br>"; echo"<a href='/'>К авторизации</a>"; exit();}

$name=$_SESSION['username'];



$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
include ($put);//// подключаю модуль связи с БД

//получение данных из БД
if($_GET['startperiod'] && $_GET['endperiod']){
    $start=$_GET['startperiod'];
    $end=$_GET['endperiod'];
$sql = "SELECT * FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $row['avrRad']=round($row['avrRad'], 2);
        $res[$r]=$row;
        $r++;
    }
    $val['data']=$res;
    $sql = "SELECT COUNT(1) AS count11 FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end;";
 $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        $count1=(int)$row['count11'];
    }
    $val['countWood']=$count1;

    $sql = "SELECT SUM(volume) AS sumVal FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end;";
$result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        $sumVal=round($row['sumVal'], 2);
    }
   $val['sumVal']=$sumVal;

    $sql = "SELECT SUM(usefulVolume) AS usefulVolume FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end";
$result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $usefulVolume=round($row['usefulVolume'], 2);
    }
   $val['usefulVolume']=$usefulVolume;
    
    $AllWood=(int)$r;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND inputRad>=0 AND inputRad<=18";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count20=(int)$row['count'];
    }
$Proc20=100*$count20/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND inputRad>18 AND inputRad<=24";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count30=(int)$row['count'];
    }
$Proc30=100*$count30/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND inputRad>24 AND inputRad<=30";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count40=(int)$row['count'];
    }
$Proc40=100*$count40/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND inputRad>30 AND inputRad<=40";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count50=(int)$row['count'];
    }
$Proc50=100*($count50/$AllWood);
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND inputRad>40 AND inputRad<=50";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count60=(int)$row['count'];
    }
$Proc60=100*($count60/$AllWood);
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND inputRad>50";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count70=(int)$row['count'];
    }
$Proc70=100*($count70/$AllWood);


$stolb=array(array("name"=>"От 0 до 18 см","y"=>round($Proc20,2)),array("name"=>"От 18 до 24 см","y"=>round($Proc30,2)),array("name"=>"От 24 до 30 см","y"=>round($Proc40,2)),array("name"=>"От 30 до 40 см","y"=>round($Proc50,2)),array("name"=>"От 40 до 50 см","y"=>round($Proc60,2)),array("name"=>"От 50 см","y"=>round((int)$Proc70,2)));
$Catstolb=array("От 0 до 18 см","От 18 до 24 см","От 24 до 30 см","От 30 до 40 см","От 40 до 50 см","От 50 см");
    //шифрование данных в json для отправки в js

$val['procD']=$stolb;
$val['procVatD']=$Catstolb;

//////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND inputRad>=0 AND inputRad<=18";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count20=(int)$row['count'];
    }
$Proc20=100*$count20/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND inputRad>18 AND inputRad<=24";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count30=(int)$row['count'];
    }
$Proc30=100*$count30/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND inputRad>24 AND inputRad<=30";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count40=(int)$row['count'];
    }
$Proc40=100*$count40/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND outputRad>30 AND outputRad<=40";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count50=(int)$row['count'];
    }
$Proc50=100*($count50/$AllWood);
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND outputRad>40 AND outputRad<=50";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count60=(int)$row['count'];
    }
$Proc60=100*($count60/$AllWood);
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND outputRad>50 ";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count70=(int)$row['count'];
    }
$Proc70=100*($count70/$AllWood);

$stolb=[];
$stolb=array(array("name"=>"От 0 до 18 см","y"=>round($Proc20,2)),array("name"=>"От 18 до 24 см","y"=>round($Proc30,2)),array("name"=>"От 24 до 30 см","y"=>round($Proc40,2)),array("name"=>"От 30 до 40 см","y"=>round($Proc50,2)),array("name"=>"От 40 до 50 см","y"=>round($Proc60,2)),array("name"=>"От 50  см","y"=>round($Proc70,2)));
$Catstolb=array("От 0 до 18 см","От 18 до 24 см","От 24 до 30 см","От 30 до 40 см","От 40 дo 50 см","От 50 см");



$val['outputProc']=$stolb;



//////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND avrRad>=0 AND avrRad<=18";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count20=(int)$row['count'];
    }
$Proc20=100*$count20/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND avrRad>18 AND avrRad<=24";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count30=(int)$row['count'];
    }
$Proc30=100*$count30/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND avrRad>24 AND avrRad<=30";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count40=(int)$row['count'];
    }
$Proc40=100*$count40/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND avrRad>30 AND avrRad<=40";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count50=(int)$row['count'];
    }
$Proc50=100*($count50/$AllWood);
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND avrRad>40 AND avrRad<=50";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count60=(int)$row['count'];
    }
$Proc60=100*($count60/$AllWood);
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND avrRad>50 ";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count70=(int)$row['count'];
    }
$Proc70=100*($count70/$AllWood);

$stolb=[];
$stolb=array(array("name"=>"От 0 до 18 см","y"=>round($Proc20,2)),array("name"=>"От 18 до 24 см","y"=>round($Proc30,2)),array("name"=>"От 24 до 30 см","y"=>round($Proc40,2)),array("name"=>"От 30 до 40 см","y"=>round($Proc50,2)),array("name"=>"От 40 до 50 см","y"=>round($Proc60,1)),array("name"=>"От 50 см","y"=>round($Proc70,2)));
$Catstolb=array("От 0 до 18 см","От 18 до 24 см","От 24 до 30 см","От 30 до 40 см","От 40 дo 50 см","От 50 см");



$val['avrRad']=$stolb;



//////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND usefulVolume>=0 AND usefulVolume<=0.2";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count20=(int)$row['count'];
    }
$Proc20=100*$count20/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND usefulVolume>0.2 AND usefulVolume<=0.4";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count30=(int)$row['count'];
    }
$Proc30=100*$count30/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND usefulVolume>0.4 AND usefulVolume<=0.6";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count40=(int)$row['count'];
    }
$Proc40=100*$count40/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND usefulVolume>0.6 AND usefulVolume<=0.8";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count50=(int)$row['count'];
    }
$Proc50=100*($count50/$AllWood);
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND usefulVolume>0.8 AND usefulVolume<=1";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count60=(int)$row['count'];
    }
$Proc60=100*($count60/$AllWood);

    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND usefulVolume>1";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count80=(int)$row['count'];
    }
$Proc80=100*($count80/$AllWood);
$stolb=[];
$stolb=array(array("name"=>"От 0 до 0,2 м3","y"=>round($Proc20,2)),array("name"=>"От 0,2 м3 до 0,4 м3","y"=>round($Proc30,2)),array("name"=>"От 0,4 м3 до 0,6 м3","y"=>round($Proc40,2)),array("name"=>"От 0,6 м3 до 0,8 м3","y"=>round($Proc50,2)),array("name"=>"От 0,8 м3 до 1 м3","y"=>round($Proc60,2)),array("name"=>"Более 1 м3","y"=>round($Proc80,2)));
$Catstolb=array("От 0 до 0,2 м3","От 0,2 м3 до 0,4 м3","От 0,4 м3 до 0,6 м3","От 0,6 м3 до 0,8 м3","От 0,8 м3 до 1 м3","Более 1 м3");


$val['valueWoodCad']=$Catstolb;
$val['valueWoodUseful']=$stolb;


//////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND volume>=0 AND volume<=0.2";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count20=(int)$row['count'];
    }
$Proc20=100*$count20/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND volume>0.2 AND volume<=0.4";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count30=(int)$row['count'];
    }
$Proc30=100*$count30/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND volume>0.4 AND volume<=0.6";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count40=(int)$row['count'];
    }
$Proc40=100*$count40/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND volume>0.6 AND volume<=0.8";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count50=(int)$row['count'];
    }
$Proc50=100*($count50/$AllWood);
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND volume>0.8 AND volume<=1";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count60=(int)$row['count'];
    }
$Proc60=100*($count60/$AllWood);

    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND volume>1";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count80=(int)$row['count'];
    }
$Proc80=100*($count80/$AllWood);
$stolb=[];
$stolb=array(array("name"=>"От 0 до 0,2 м3","y"=>round($Proc20,2)),array("name"=>"От 0,2 м3 до 0,4 м3","y"=>round($Proc30,2)),array("name"=>"От 0,4 м3 до 0,6 м3","y"=>round($Proc40,2)),array("name"=>"От 0,6 м3 до 0,8 м3","y"=>round($Proc50,2)),array("name"=>"От 0,8 м3 до 1 м3","y"=>round($Proc60,2)),array("name"=>"Более 1 м3","y"=>round($Proc80,2)));
$Catstolb=array("От 0 до 0,2 м3","От 0,2 м3 до 0,4 м3","От 0,4 м3 до 0,6 м3","От 0,6 м3 до 0,8 м3","От 0,8 м3 до 1 м3","Более 1 м3");


$val['valueWoodCad']=$Catstolb;
$val['valueWood']=$stolb;

//////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND volume>=0 AND volume<=0.1";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count20=(int)$row['count'];
    }
$Proc20=100*$count20/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND volume>0.1 AND volume<=0.2";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count30=(int)$row['count'];
    }
$Proc30=100*$count30/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND volume>0.2 AND volume<=0.4";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count40=(int)$row['count'];
    }
$Proc40=100*$count40/$AllWood;
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND curvature>0.4 AND curvature<=0.6";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count50=(int)$row['count'];
    }
$Proc50=100*($count50/$AllWood);
    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND curvature>0.6 AND curvature<=0.8";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count60=(int)$row['count'];
    }
$Proc60=100*($count60/$AllWood);

    $sql = "SELECT COUNT(1) AS count FROM woodParams WHERE timeStamp>=$start AND timeStamp<=$end AND curvature>0.8 AND curvature<=1";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count80=(int)$row['count'];
    }
$Proc80=100*($count80/$AllWood);
$stolb=[];
$stolb=array(array("name"=>"От 0 до 10 %","y"=>round($Proc20,2)),array("name"=>"От 10% до 20%","y"=>round($Proc30,2)),array("name"=>"От 20% до 40%","y"=>round($Proc40,2)),array("name"=>"От 40% до 60%","y"=>round($Proc50,2)),array("name"=>"От 60% до 80%","y"=>round($Proc60,2)),array("name"=>"От 80% до 100%","y"=>round($Proc80,2)));
$Catstolb=array("От 0 до 10 %","От 10% до 20%","От 20% до 40%","От 40% до 60%","От 60% до 80%","От 80% до 100%");


$val['curvatureCad']=$Catstolb;
$val['curvature']=$stolb;



    $resJson=json_encode($val);
    print_r($resJson);
}
else{

    include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); 
include 'index.html';  /// подключение файла html
    include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); 
}
?>