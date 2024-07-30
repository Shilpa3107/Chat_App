<?php

$arr['userid'] = "null";
if(isset($DATA_OBJ->find->userid)){
    $arr['userid']= $DATA_OBJ->find->userid;
}

$sql = "select * from users where userid = :userid limit 1";
$result = $DB->read($sql,$arr);

if(is_array($result)){

    $arr['message'] = $DATA_OBJ->find->message;
    $arr['date'] = date("Y-m-d H:i:s");
    $arr['sender'] = $_SESSION['userid'];
    //$arr['msgid'] = get_random_string_max(60);

//     $arr2['sender'] = $_SESSION['userid'];
//     $arr2['receiver'] =  $arr['userid'];

//     $sql1 = "select * from messages where (sender = :sender AND receiver = :receiver) OR (sender = :receiver AND receiver = :sender) limit 1";
// $result2 = $DB->read($sql1, $arr2);

// if(is_array($result2)){
//     $arr['msgid'] = $result2[0]->msgid;  // Use existing thread ID
// } else {
//     $arr['msgid'] = get_random_string_max(60);  // Generate new thread ID
// }
   
    //  $query = "insert into messages (msgid, sender, receiver, message, date) values (:msgid, :sender, :userid, :message, :date)";
    //  $DB->write($query, $arr);
     
    //user found
    
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
  
    //read from db
    // $a['$msgid'] = $arr['msgid'];

    // $sql = "select * from messages where msgid = :msgid limit 10";
    // $result2 = $DB->read($sql,$a);

    //  if(is_array($result2 )){


    //     $result = $result2[0];
    //     foreach($result as $row){
    //         $messages .="this is a message";
    //     }
    //  }
    
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

//  function get_random_string_max($length){
//     $array = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
//     $text = "";
//     $length = rand(4,$length);
//     for ($i=0; $i < $length; $i++) { 
//         # code...
//         $random = rand(0,61);
//         $text .= $array[$random];
//     }
//     return $text;
//  }

?>
