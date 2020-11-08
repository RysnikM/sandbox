<?php
require_once("MySQLiWorker.php");

class test extends apiBaseClass {

    //http://www.example.com/api/?apitest.helloAPI={}
    function helloAPI() {
        $retJSON = $this->createDefaultJson();
        $retJSON->withoutParams = 'It\'s method called without parameters';
        return $retJSON;
    }

        function getUsers($param) {


        $retJSON = $this->createDefaultJson();
     

         $db = DataBase::getDB(); // Создаём объект базы данных
  $query = "SELECT * FROM `users` WHERE `nikname` = {?} AND `pass` = {?}";
  $table = $db->select($query, array($param->name, $param->pass)); // Запрос явно должен вывести таблицу, поэтому вызываем метод select()
if($table[0]){
    $_SESSION['token']=$table[0]['token'];
      $retJSON->sucess="user succesful";   
   $retJSON->userid=$table[0]['id'];
   $retJSON->nikname=$table[0]['nikname'];
    $retJSON->position=$table[0]['position'];
     $retJSON->email=$table[0]['email'];
      $retJSON->userid=$table[0]['id'];
      $retJSON->token=$table[0]['token'];
}else{
    $retJSON->sucess="No valid name or pass";   
}

        return $retJSON;
    }


    function addHeader($param){
$retJSON = $this->createDefaultJson();

function getToken($length){
     $token = "";
     $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
     $codeAlphabet.= "0123456789";
     $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[random_int(0, $max-1)];
    }

    return $token;
}

     
         $db = DataBase::getDB(); // Создаём объект базы данных
         $lastin=time();

  $query = "SELECT * FROM `users` WHERE `token` = {?} ;";
  $table = $db->select($query, array($param->Bearer)); 

  if($table[0]){
    $inputJSON = file_get_contents('php://input');
    $input= json_decode( $inputJSON, TRUE ); 
$sql = "UPDATE `users` SET  `token_push`={?} WHERE `nikname`={?}";
$db->query($sql, array( $input['gcm'], $table[0]['nikname'])); // Запрос явно должен вывести 
  $retJSON->sucess="avalible";  
    $retJSON->newPushToken=$input;  
}else{
      $retJSON->sucess="bad token";  
}
        return $retJSON;
    }
}

?>