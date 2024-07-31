<?php
session_start();

$DATA_RAW= file_get_contents("php://input");
$DATA_OBJ = json_decode($DATA_RAW);

$info = (object)[];
//check if loogged in
if(!isset($_SESSION['userid'])){
    
    if(isset($DATA_OBJ->data_type) &&  $DATA_OBJ->data_type != "login"  &&  $DATA_OBJ->data_type != "signup"){
        $info->logged_in = false;
        echo json_encode($info);
        die;
    }
}
require_once("classes/autoload.php");

$DB = new Database();



$Error = "";
//process the data
if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "signup"){

    
    //signup
     include("includes/signup.php");

}
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "login"){

       //login
     include("includes/login.php");
}
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "user_info"){

      //user info
      include("includes/user_info.php");
}
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "logout"){

    //user info
    include("includes/logout.php");
}
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "contacts"){

    //user info
    include("includes/contacts.php");
}
else if(isset($DATA_OBJ->data_type) && ($DATA_OBJ->data_type == "chats" || $DATA_OBJ->data_type == "chats_refresh")){

    //user info
    include("includes/chats.php");
}
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "settings"){

    //user info
    include("includes/settings.php");
}
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "save_settings"){

    //user info
    include("includes/save_settings.php");
}
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "send_message"){

    //send_message
    include("includes/send_message.php");
}


function message_left($data ,$row){

    $image = ($row->gender == "Male") ? "ui/images/user_male.png" : "ui/images/user_female.jpg";
    if(file_exists($row->image)){
        $image = $row->image;
    }

    return "
    <div id='message_left' >
    <div></div>
        <img src='$image'>
        <b>$row->username</b><br>
        $data->message<br><br>
        <span style='font-size:11px; color: white;'>".date($data->date)."</span>
    </div>";
}

function message_right($data ,$row){

    $image = ($row->gender == "Male") ? "ui/images/user_male.png" : "ui/images/user_female.jpg";
    if(file_exists($row->image)){
        $image = $row->image;
    }

    $a =  "
    <div id='message_right' >
        <div>";
        // print_r($data->seen);
        // print_r($data->received);
        if($data->seen){
        $a .= "<img src='ui/images/tick.png'  style=''/>";
        } else if($data->received){
        $a .= "<img src='ui/images/tick_grey.png'  style=''/>";
        }
        $a .= "</div>
            <img src='$image' style='float:right'>
            <b>$row->username</b><br>
            $data->message<br><br>
            <span style='font-size:11px; color: #888;'>".date($data->date)."</span>
        </div>
    ";
    return $a;
}

function message_controls(){


    return "
    </div>
       <div style='display:flex; width:100%; height:40px;'>
    <label for='message_file'>
        <img src='ui/icons/clip.png' style='opacity:0.8; width:30px; margin:5px; cursor:pointer;'>
    </label>
    <input type='file' id='message_file' name='file' style='display:none;'/>
    <input id='message_text'  onkeyup='enter_pressed(event)'  style='flex:6; border:solid thin #ccc; border-bottom:none; font-size:14px; padding:4px;' type='text' placeholder='Type your message'/>
    <input style='flex:1; cursor:pointer;' type='button' value='send' onclick='send_message(event)'/>
</div>

    </div>
    ";
}