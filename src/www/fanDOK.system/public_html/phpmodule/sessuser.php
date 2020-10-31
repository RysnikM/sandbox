<?php
// Start the session
session_start();
if($_GET['name']=="logout"){
$_SESSION["username"] = '';
$_SESSION["userid"] = '';
header("Location: /"); /* Redirect browser */	
}else{
$_SESSION["userid"] = $_GET['id'];
$_SESSION["username"] = $_GET['name'];


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


$lastin=time();
$len=strlen($_SESSION["userid"].$_SESSION["username"].$lastin);
$tok=getToken($len);
$tok=$tok.$_SESSION["username"];
  $_SESSION['token']=$tok;
include 'mysqlconn.php';
$sql = "UPDATE users SET lastInsert=".$lastin.", token='".$tok."' WHERE nikname='".$_GET['name']."'";
$conn->query($sql);

header("Location: /start/"); /* Redirect browser */
exit();
}
?>