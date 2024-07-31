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
else if(isset($DATA_OBJ->data_type) && $DATA_OBJ->data_type == "chats"){

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

    return "
    <div id='message_left' >
    <div></div>
        <img src='$row->image'>
        <b>$row->username</b><br>
        $data->message<br><br>
        <span style='font-size:11px; color: white;'>20 Jan 2024 10:00</span>
    </div>";
}

function message_right($data ,$row){


    return "
    <div id='message_right' >
        <div></div>
            <img src='$row->image' style='float:right'>
            <b>$row->username</b><br>
            $data->message<br><br>
            <span style='font-size:11px; color: #999;'>20 Jan 2024 10:00</span>
        </div>
    ";
}