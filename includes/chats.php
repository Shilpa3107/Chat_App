<?php

$arr['userid'] = "null";
if(isset($DATA_OBJ->find->userid)){
    $arr['userid']= $DATA_OBJ->find->userid;
}

$refresh = false;
$seen = false;
if($DATA_OBJ->data_type == "chats_refresh"){
    $refresh = true;
    $seen = $DATA_OBJ->find->seen;
}

$sql = "select * from users where userid = :userid limit 1";
$result = $DB->read($sql,$arr);

$messages = ""; // Initialize $messages

if(is_array($result)){
    // User found
    $row = $result[0];

    $image = ($row->gender == "Male") ? "ui/images/user_male.png" : "ui/images/user_female.jpg";
    if(file_exists($row->image)){
        $image = $row->image;
    }

    $row->image = $image;

     $mydata="";

    if(!$refresh){
        $mydata = "Now Chatting with:<br>
        <div id='active_contact' >
            <img src='$image'>
            <br>$row->username
        </div>";
    }

    $messages = ""; // Ensure $messages is initialized
    $new_message = false;
    // Create the messages holder parent div
    if(!$refresh){
        $messages .= "
        <div id='messages_holder_parent' onclick = 'set_seen(event)' style='height:630px;'>
            <div id='messages_holder' style='height:480px; overflow-y:scroll;'>
        ";
    }

    $a['sender'] = $_SESSION['userid'];
    $a['receiver'] = $arr['userid'];
    $sql = "select * from messages where (sender = :sender && receiver = :receiver) || (sender = :receiver && receiver = :sender) order by id desc limit 10";
    $result2 = $DB->read($sql,$a);

    if(is_array($result2)){
        $result2 = array_reverse($result2);
    
        foreach($result2 as $data){
            $myuser = $DB->get_user($data->sender);
    
            //checkfor new messages
            if($data->receiver == $_SESSION['userid'] && $data->received == 0){
                $new_message = true;
            }

            if($data->receiver == $_SESSION['userid'] && $data->received == 1 && $seen){
                $DB->write("UPDATE messages SET seen = 1 WHERE id = '$data->id' LIMIT 1");
            }
    
            if($data->receiver == $_SESSION['userid']){
                $DB->write("UPDATE messages SET received = 1 WHERE id = '$data->id' LIMIT 1");
            }
    
            if($_SESSION['userid'] == $data->sender){
                $messages .= message_right($data, $myuser);
            } else {
                $messages .= message_left($data, $myuser);
            }
        }
    }
    
    if(!$refresh){
        $messages .= message_controls();
    }

    $info->user = $mydata;
    $info->message = $messages;
    $info->new_message = $new_message;
    $info->data_type = "chats";
    if($refresh){
        $info->data_type = "chats_refresh";
    }
    echo json_encode($info);

} else {
    $a['userid'] = $_SESSION['userid'];

    $sql = "select * from messages where (sender = :userid || receiver = :userid) group by msgid order by id desc limit 10";
    $result2 = $DB->read($sql,$a);

    $mydata = "Previous Chats:<br>";
    

    if(is_array($result2)){
        $result2 = array_reverse($result2);

        foreach($result2 as $data){
            $other_user = $data->sender;
            if($data->sender == $_SESSION['userid']){

                $other_user = $data->receiver;
            }
            $myuser = $DB->get_user($other_user);

            $image = ($myuser->gender == "Male") ? "ui/images/user_male.png" : "ui/images/user_female.jpg";
    if(file_exists($myuser->image)){
        $image = $myuser->image;
    }
         $mydata .= "
            <div id='active_contact' userid='$myuser->userid' onclick='start_chat(event)' style='cursor:pointer'>
                 <img src='$image'>
                <br>$myuser->username<br>
                <span style='font-size: 11px;'>'$data->message'</span>
            </div>";

            if($_SESSION['userid'] == $data->sender){
                $messages .= message_right($data, $myuser);
            } else {
                $messages .= message_left($data, $myuser);
            }
        }
    }

    $info->user = $mydata;
    $info->message = ""; // Set $messages to $info
    $info->data_type = "chats";
    echo json_encode($info);
}

?>
