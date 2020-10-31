<?php

include_once "./oee_class.php";
$time = time() - (60*60*24*5);

$d = new Oee;
// 1 это работа

$mass1[0]=array("name"=>"Работает","turboThreshold"=>99999);
$mass1[0]['data']=$d->getDataOee($time,1);

// 2 это авария
$mass1[1]=array("name"=>"Авария","turboThreshold"=>99999);
$mass1[1]['data']=$d->getDataOee($time,2);

// 0 это выключен
$mass1[2]=array("name"=>"Выключен","turboThreshold"=>99999);
$mass1[2]['data']=$d->getDataOee($time,0);

// 3 это простой
$mass1[3]=array("name"=>"Простой","turboThreshold"=>99999);
$mass1[3]['data']=$d->getDataOee($time,3);

// 5 это запланированный простой простой
$mass1[4]=array("name"=>"Запланированый ремонт","turboThreshold"=>99999);
$mass1[4]['data']=$d->getDataOee($time,5);
$resultJson = json_encode($d->oborudovanie);
$mass=json_encode($mass1);

include ($_SERVER['DOCUMENT_ROOT'].'/header.html');

include 'index_new.html';  /// подключение файла html
include ($_SERVER['DOCUMENT_ROOT'].'/footer.html');
include ('oeeOnline.html');
