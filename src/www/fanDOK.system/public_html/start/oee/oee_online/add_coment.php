<?php
$put=$_SERVER['DOCUMENT_ROOT'].'/phpmodule/mysqlconn.php'; // создаю абсолютный путь до модуля
include ($put);//// подключаю модуль связи с БД

include_once "./oee_class.php";
    $name=$_GET['oborname'];
    $ids=$_GET['id'];
    $obrid=$_GET['obrid'];
    $text=$_GET['comment'];
    $prichnaset=$_GET['prichina'];
if($_GET['typerem']==="1")
        {
            $statusToUpd = 5;
        }

        if($_GET['typerem']==="2")
        {
            $statusToUpd = 2;
        }



    $name =  mb_convert_encoding($name,  "UTF-8","Windows-1252");
    $sql = "SELECT oborudovanie.id AS id, oborudovanie.name AS name, oborudovanie.code AS code, oborudovanie.group_id AS group_id, oborudovanie.tablename AS tablename, (SELECT name FROM group_o WHERE id=oborudovanie.code) AS groupname FROM `oborudovanie` WHERE `id`=".$obrid.";";

    $result = $conn->query($sql);
    $r=0;
    while($row = $result->fetch_assoc()) {
        $resultquery=$row;
        $r++;
    }

    $prichnaset=$_GET['prichina'];

    $prichina1="Ремотные работы";
    if($_GET["prichina"]!="Выберите причину" && $_GET["prichina"]==="1"){
        $prichnaset=$_GET['ferstAgregat'];
        if($_GET['secAgregat']){$prichnaset=$_GET['secAgregat']; if($_GET['serdAgregat']){$prichnaset=$_GET['serdAgregat'];}}


        $sql = "INSERT INTO repairs (`id_obor`, `typeOfRepair`, `uzel`, `prichina`, `startTime`, `endTime`, `time`, `userid`, `comment`) VALUES (".$resultquery['id'].",' ".$_GET['typerem']."', '".$_GET['ferstAgregat']."', '".$prichnaset."', ".$_GET['timestart'].", ".$_GET['timeend'].", ".time().", ".$_userid.",  '".$_GET['comment']."');";
        if (mysqli_query($conn, $sql)) {
            //  echo "Коментарий изменен";
        } else {
            print_r($sql);
            echo "Error deleting record: " . mysqli_error($conn);
        }

        $prichnaset=$_GET['ferstAgregat'];
        if($_GET['secAgregat']){$prichnaset=$_GET['secAgregat']; if($_GET['serdAgregat']){$prichnaset=$_GET['serdAgregat'];}}
        if($_GET['typerem']==="1")
        {
            $statusToUpd = 5;
        }

        if($_GET['typerem']==="2")
        {
            $statusToUpd = 2;
        }

        $sql = ' UPDATE '.$resultquery['tablename'].' SET coment="'.$text.'",`prichina`="'.$prichnaset.'", status='.$statusToUpd.' WHERE id="'.$ids.'";';
        if (mysqli_query($conn, $sql)) {
            //  echo "Коментарий изменен";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        header("Location: /start/oee/oee_online/oee_new.php"); /* Перенаправление браузера */

        /* Убедиться, что код ниже не выполнится после перенаправления .*/
        exit;
    }else{
        if($_GET["prichina"]=="Погодные условия (сильный ветер)" || $_GET["prichina"]=="Отсутствие сырья" || $_GET["prichina"]=="Отсутствие пара"){
            $sql = ' UPDATE '.$resultquery['tablename'].' SET coment="'.$text.'",`prichina`="'.$prichnaset.'", status=3 WHERE id="'.$ids.'";';
            if (mysqli_query($conn, $sql)) {
                //  echo "Коментарий изменен";
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
            exit;
        }
        $sql = ' UPDATE '.$resultquery['tablename'].' SET coment="'.$text.'" WHERE id="'.$ids.'";';
        if (mysqli_query($conn, $sql)) {
            //  echo "Коментарий изменен";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
