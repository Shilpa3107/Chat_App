<?php
$mydata=' chats goes here ';

//$result = $result[0];
$info->message = $mydata;
$info->data_type = "chats";
echo json_encode($info);

die;

$info->message = "No contacts were found";
$info->data_type = "error";
echo json_encode($info);

?>