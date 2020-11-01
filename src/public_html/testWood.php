<?php

$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
include ($put);//// подключаю модуль связи с БД
// sql to delete a record
/*$sql = "DELETE FROM woodParams WHERE timeStamp is null";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}*/

    $sql = "SELECT *  FROM woodParams WHERE  avrRad>=25";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $count20[$r]=$row;
        $r++;
        echo(date('d-m-Y H:i:s',$row['timeStamp'])); echo "<br>";
    }
    print_r($count20);

?>