<?php
include_once "connection.php";

class Oee
{
    private  $pdo;
    public $oborudovanie;
    function __construct()
    {
        $this->pdo = new DB;
        //$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true); // added code

        $this->pdo->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
        $sql = "SELECT `tablename` FROM `oborudovanie` WHERE `oee`=1";
        $this->tables = $this->pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
        $sql = "SELECT oborudovanie.id AS id, oborudovanie.name AS name, oborudovanie.code AS code, oborudovanie.group_id AS group_id, oborudovanie.tablename AS tablename, (SELECT name FROM group_o WHERE id=oborudovanie.code) AS groupname FROM oborudovanie  WHERE oee=1 ORDER BY groupname";
        $this->oborudovanie = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        foreach ($this->oborudovanie as$k=>$v){
        //    $this->oborudovanie[$k]['name']=  mb_convert_encoding($v['name'], "Windows-1252", "UTF-8");
        }
    }

    public function getDataOee($time,$status){
        $sql="";
        for ($i=0;$i<count($this->tables);$i++){
            $sql.="SELECT `id` as id,`coment` as name,`startperiod`*1000 as x,`endperiod`*1000 as x2 ,`parentid` as y
                    FROM ".$this->tables[$i]." 
                    WHERE `status`=$status AND `parentid` is not null  and `endperiod`>$time;";
        }
        $data = $this->pdo->query($sql);
        $res=array();

        do {
            $row = $data->fetchAll(PDO::FETCH_ASSOC);
            if($row) {
                $res=  array_merge($res,$row);
            }
        } while($data->nextRowset());

        return $res;
    }

    public static function changeRange($start,$end,$id,$status=2,$prichina="",$comment=""){
        $pdo = new DB;
        $sql = "SELECT * FROM `oborudovanie` WHERE `id`=$id";
        $oborudovanie = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        $table = $oborudovanie['tablename'];

        $sql = "DELETE FROM $table 
                WHERE `startperiod`>=:start AND `endperiod`<=:end1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':start', $start, PDO::PARAM_INT);
        $stmt->bindParam(':end1', $end, PDO::PARAM_INT);
// если начало периода попало на какой то промежуток разрываем его
        $updstmt = $pdo->prepare("UPDATE $table 
                    SET `endperiod`=:start WHERE 
                    `startperiod`<=:start AND `endperiod`>:ends");
        $updstmt->bindParam(':start', $start, PDO::PARAM_INT);
        $updstmt->bindParam(':ends', $end, PDO::PARAM_INT);
// если конец периода попал на промежуток какого то периода разрываем его
        $upstmt = $pdo->prepare("UPDATE $table 
                    SET `startperiod`=:ends WHERE 
                    `startperiod`>:start AND `endperiod`>=:ends");
        $upstmt->bindParam(':start', $start, PDO::PARAM_INT);
        $upstmt->bindParam(':ends', $end, PDO::PARAM_INT);

        $uptmt = $pdo->prepare("UPDATE $table 
                    SET `startperiod`=:start, `endperiod`=:ends WHERE 
                    `startperiod`>:start AND `endperiod`<:ends");
        $uptmt->bindParam(':start', $start, PDO::PARAM_INT);
        $uptmt->bindParam(':ends', $end, PDO::PARAM_INT);

        $insert = $pdo->prepare("INSERT INTO $table (
                        `startperiod`,
                        `endperiod`,
                        `status`,
                        `coment`,
                        `parentid`,
                        `prichina`) VALUES(
                        :start,
                        :end1,
                        :status,
                        :comment,
                        :parent,
                        :prichina
                        ) ;
                    ");
$prichina=  'polomka';

        $insert->bindParam(':start', $start, PDO::PARAM_INT);
        $insert->bindParam(':end1', $end, PDO::PARAM_INT);
        $insert->bindParam(':status', $status, PDO::PARAM_INT);
        $insert->bindParam(':comment', $comment, PDO::PARAM_STR);
        $insert->bindParam(':parent', $oborudovanie['id'], PDO::PARAM_INT);
        $insert->bindParam(':prichina', $prichina, PDO::PARAM_STR);
		try{
            $stmt->execute();
            $updstmt->execute();
            $upstmt->execute();
           // $uptmt->execute();
            $insert->execute();
}catch (Exception $e) {
exit($e);
}
print_r($status);




    }
}
