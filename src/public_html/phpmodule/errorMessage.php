<?php

$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
$put='/var/www/fanDOK.system/public_html/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля

include ($put);//// подключаю модуль связи с БД

$col=$_GET['col'];
$dayago=time()-(3600*24);

  $sql="SELECT * FROM err_message WHERE  time>".$dayago." ORDER BY id asc LIMIT ".$col.";";
  $result = $conn->query($sql);
   

    while($row = $result->fetch_assoc()) {
      $messages[$r]=$row;
        $r++;
    }
$messages=json_encode($messages);
print_r($messages);
?>