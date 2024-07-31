<?php

$arr['userid'] = "null";
if(isset($DATA_OBJ->find->userid)){
    $arr['userid']= $DATA_OBJ->find->userid;
}

$a['sender'] = $_SESSION['userid'];
$a['receiver'] = $arr['userid'];

$sql = "select * from messages where (sender = :sender AND receiver = :receiver) OR (sender = :receiver AND receiver = :sender)";
$result = $DB->read($sql, $a);

if(is_array($result)){
    foreach($result as $row){
        if($_SESSION['userid'] == $row->sender){
            $sql = "update messages set deleted_sender = 1 where id = :id limit 1";
            $DB->write($sql, ['id' => $row->id]);
        }
        if($_SESSION['userid'] == $row->receiver){
            $sql = "update messages set deleted_receiver = 1 where id = :id limit 1";
            $DB->write($sql, ['id' => $row->id]);
        }
    }
}
?>
