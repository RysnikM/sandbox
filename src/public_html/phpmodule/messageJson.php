<?php
// хлебные крошки для сайта
define('API_ACCESS_KEY','AAAAVFwOZbY:APA91bGcD7o5GFLgTRjE7OynH8bYRXFtI_XMETtDwIWycCm4aUYl8-T4rsQLYDdVK4mN38kTciMM__8T4h7y5RRVwO-X2HrdMghEl-KE1WFAc4YnNUQ45-bAaY9GsLaRlWf2Opv0ewi6');

function senPush($title,$text){
$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
$put='/var/www/fanDOK.system/public_html/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля

include ($put);//// подключаю модуль связи с БД

$sql="SELECT * FROM users ;";

  $result = $conn->query($sql);
   $r=0;

    while($row = $result->fetch_assoc()) {
      $users[$r]=$row;
        $r++;
    }
foreach ($users as $key => $value) {


 $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
 $token=$value['token_push'];

     $notification = [
            'title' =>$title,
            'body' => $text,
            'icon' =>'myIcon', 
            'sound' => 'mySound'
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);


        echo $result;


}

}


?>