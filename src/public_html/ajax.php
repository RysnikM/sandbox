<?php
include 'phpmodule/mysqlconn.php';  // подключаю модуль связи с БД
$name=$_GET['name'];
$pass=$_GET['pass'];

//получение данных из БД

$sql = "SELECT name,surname,position,nikname,levelAccess,id FROM users WHERE nikname='".$name."' AND pass='".$pass."';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    $r=0;
    while($row = $result->fetch_assoc()) {
        $res=['name'=>$row['name'],'surname'=>$row['surname'],'position'=>$row['position'],'level'=>$row['levelAccess'],'id'=>$row['id']];
        $r++;
    }
  echo json_encode($res);
} else {
   print_r(0); //при неправильном вводе отдаем 0
}
?>