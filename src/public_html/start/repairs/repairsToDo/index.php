<?php
// проверка авторизации пользователя
session_start();
if(!$_SESSION['username']){print_r("Вы не авторизованны"); echo"<br>"; echo"<a href='/'>К авторизации</a>"; exit();}

$name=$_SESSION['username'];

$put1=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/croshki.php'; // создаю абсолютный путь до модуля хлебных крошек
include ($put1);//// подключаю модуль хлебных крошек



$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
include ($put);//// подключаю модуль связи с БД


//получение данных из БД

$sql = "SELECT name,surname,position,levelAccess FROM users WHERE nikname='".$name."'";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $res=['name'=>$row['name'],'surname'=>$row['surname'],'position'=>$row['position'],'level'=>$row['levelAccess']];
        $r++;
    }
$nameA=json_encode($res);
    //проверка уровня доступа
if($res['level']<8){print_r("Вы не имеете прав доступа к данному контенту");echo"<br>"; echo"<a href='/start'>На главную</a>"; exit();}

$sql = "SELECT repairs.id as id,repairs.id_obor as id_obor, repairs.typeOfRepair as typeOfRepair, repairs.uzel as uzel, repairs.prichina as prichina, repairs.detailNameDestroy as detailNameDestroy, repairs.codeDetailDestroy as codeDetailDestroy, repairs.datailNameNew as datailNameNew, repairs.codeDetailNew as codeDetailNew, repairs.colMan as colMan, repairs.startTime as startTime, repairs.endTime as endTime, repairs.time as time, repairs.userid as userid, repairs.opisanie as opisanie,  repairs.comment as comment, (select oborudovanie.name from oborudovanie where oborudovanie.id=repairs.id_obor) as oborudovanie, (select users.name from users where users.id=repairs.userid) as user, (select users.surname from users where users.id=repairs.userid) as usersurname FROM repairs";
$result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
    

        $repairs[$r]=$row;
        $r++;
    }
function StripBadUTF8($str) { // (C) SiMM, based on ru.wikipedia.org/wiki/Unicode
$ret = '';
for ($i = 0;$i < strlen($str);) {
    $tmp = $str{$i++};
    $ch = ord($tmp);
    if ($ch > 0x7F) {
        if ($ch < 0xC0) continue;
        elseif ($ch < 0xE0) $di = 1;
        elseif ($ch < 0xF0) $di = 2;
        elseif ($ch < 0xF8) $di = 3;
        elseif ($ch < 0xFC) $di = 4;
        elseif ($ch < 0xFE) $di = 5;
        else continue;

        for ($j = 0;$j < $di;$j++) {
            $tmp .= $ch = $str{$i + $j};
            $ch = ord($ch);
            if ($ch < 0x80 || $ch > 0xBF) continue 2;
        }
        $i += $di;
    }
    $ret .= $tmp;
}
return $ret;
}

    //шифрование данных в json для отправки в js
    $resJson=(string)json_encode($repairs);


    include ($_SERVER['DOCUMENT_ROOT'].'/header.html'); 
include 'index.html';  /// подключение файла html
    include ($_SERVER['DOCUMENT_ROOT'].'/footer.html'); 

?>
