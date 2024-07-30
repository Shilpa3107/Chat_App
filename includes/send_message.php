<?php

$arr['userid'] = "null";
if(isset($DATA_OBJ->find->userid)){
    $arr['userid']= $DATA_OBJ->find->userid;
}

$sql = "select * from users where userid = :userid limit 1";
$result = $DB->read($sql,$arr);

if(is_array($result)){
    //user found
    $arr['message'] = $DATA_OBJ->find->message;
    $arr['date'] = date("Y-m-d H:i:s");
    $arr['sender'] = $_SESSION['userid'];
    
    $query = "insert into messages (sender,receiver,message,date) values (:sender, :userid, :message, :date)";
    $DB->write($sql,$arr);

    $row = $result[0];

    $image = ($row->gender == "Male") ? "ui/images/user_male.png" : "ui/images/user_female.jpg";
    if(file_exists($row->image)){
        $image = $row->image;
    }

    $row->image = $image;
    
    $mydata = "Now Chatting with:<br>
        <div id='active_contact' >
            <img src='$image'>
            <br>$row->username
        </div>";

    // Initialize $messages as an empty string
    $messages = "";

    // Create the messages holder parent div
    $messages .= "
    <div id='messages_holder_parent' style='height:630px;'>
        <div id='messages_holder' style='height:480px; overflow-y:scroll;'>
    ";

    
    $messages .= "
        </div>
        <div style='display:flex; width:100%; height:40px;'>
        <label for='file'><img src = 'ui/icons/clip.png' style='opacity:0.8; width:30px; margin;5px; cursor:pointer;'></label>
            <input type='file' id='message_file' name='file' style='display:none;'/>
             <input id='message_text' style='flex:6; border:solid thin #ccc; border-bottom:none; font-size:14px; padding:4px;' type='text' placeholder='Type your message'/>
            <input style='flex:1; cursor:pointer;' type='button' value='send' onclick='send_message(event)'/>
        </div>
    </div>
    ";

    $info->user = $mydata;
    $info->message = $messages;
    $info->data_type = "chats";
    echo json_encode($info);

} else {
    //user not found
    $info->user = "That contact was not found";
    $info->data_type = "chats";
    echo json_encode($info);
}

?>
