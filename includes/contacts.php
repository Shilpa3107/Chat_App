<?php

$myid = $_SESSION['userid'];
$sql = "select * from users where userid != '$myid' limit 10";
$myusers = $DB->read($sql,[]);

$mydata = '
<style>
    @keyframes appear {
        0% {opacity: 0; transform: translateY(50px);}
        100% {opacity: 1; transform: translateY(0px);}
    }
    #contacts-container {
        text-align: center; 
        animation: appear 1s ease;
    }
    #contacts-container #contact {
        display: inline-block;
        width: 100px;
        height: 120px;
        margin: 10px;
        overflow: hidden;
    }
    #contacts-container #contact img {
        width: 100px;
        height: 100px;
    }
        #contact{
          cursor:pointer;
          transition: all .5s cubic-bezier(0.68,.-2,.0.265,.1.55);

     }
        #contact:hover{

        transform:scale(1.1);
         }
</style>
<div id="contacts-container">';

if(is_array($myusers)){
    foreach($myusers as $row){
        $image = ($row->gender == "Male") ? "ui/images/user_male.png" : "ui/images/user_female.jpg";
        if(file_exists($row->image)){
            $image = $row->image;
        }
        $mydata .= "
        <div id='contact' userid='$row->userid' onclick='start_chat(event)'>
            <img src='$image'>
            <br>$row->username
        </div>";
    }
}
$mydata .= '
</div>';

//$result = $result[0];
$info->message = $mydata;
$info->data_type = "contacts";
echo json_encode($info);

die;

$info->message = "No contacts were found";
$info->data_type = "error";
echo json_encode($info);

?>
