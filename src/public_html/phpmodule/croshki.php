<?php
// хлебные крошки для сайта
$parent_dir = dirname($_SERVER["SCRIPT_NAME"]);
$path = explode("/", $parent_dir);
 array_shift($path);
foreach ($path as $key => $value) {
if($key==0){
	$croshki[$key]=['path'=>'/'.$value,'name'=>$value];
	$arrpath[$key]="/".$value;
}else{
	$arrpath[$key]=$arrpath[$key-1]."/".$value;
 $croshki[$key]=['path'=>$arrpath[$key],'name'=>$value];
}
}
?>