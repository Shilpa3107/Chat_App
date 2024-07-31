<!DOCTYPE html>
<html>
<head>
    <title>My Chat</title>
    <style type="text/css">
        @font-face{
            font-family:headFont;
            src:url(ui/fonts/Summer-Vibes-OTF.otf);
        }
        @font-face{
            font-family:myFont;
            src:url(ui/fonts/OpenSans-Regular.ttf);
        }
       #wrapper{
        max-width: 900px;
        min-height:500px;
        max-height:630px;
        display: flex;
        margin:auto;
        color:white;
        font-family: myFont;
        font-size: 13px;
       }
       #left_pannel{
        min-height: 470px;
        background-color: #27344b;
        flex:1;
        text-align: center;
        padding:10px;   
    }
       #profile_image{
        width:50%;
        border:solid thin white;
        border-radius: 50%;
        margin:10px;

       }
       #left_pannel label{
        width:100%;
       height:20px;
       display:block;
       background-color: #404b56;
       border-bottom: solid thin #ffffff55;
       cursor: pointer;
       padding:5px;
       transition: all 1s ease;
       
       }
       #left_pannel label:hover{
        background-color: #778593;
       }
       #left_pannel label img{
        
        float: right;
        width:25px;
       }
       #right_pannel{
        min-height: 500px;
        flex:4;
        text-align:center;
       }
       #header{
        background-color: #485b6c;
        height:70px;
        font-size:40px;
        text-align: center;
        font-family: headFont;
        position: relative;
       }
       #inner_left_pannel{
        background-color: #383e48;
        flex:1;
        min-height: 430px;
        max-height: 530px;
       }
       #inner_right_pannel{
        background-color: #f2f7f8;
        flex:2;
        min-height: 430px;
        transition: all 2s ease;
        max-height: 530px;
       }
       #radio_contacts:checked ~ #inner_right_pannel{
        flex:0;
       }
       #radio_settings:checked ~ #inner_right_pannel{
        flex:0;
       }
       #active_contact {
    height: 70px;
    margin: 10px;
    border: solid thin #aaa;
    padding:5px;
    background-color: #eee;
    color:#444;
}

#active_contact img {
    width: 70px;
    height: 70px;
    float: left;
    margin:2px;
}
#message_left {
    height: 70px;
    margin: 10px;
    padding:2px;
    padding-right: 10px;
    background-color: #c979d5;
    color:white;
    float:left;
    box-shadow: 0px 0px 10px #aaa;
    border-top-right-radius: 30%;
    border-bottom-left-radius:50% ;
    position: relative;
    width:60%;
    min-width: 200px;
}

#message_left img {
    width: 60px;
    height: 60px;
    float: left;
    margin:2px;
    border-radius: 50%;
    border: solid 2px white;
}
#message_left div {
    width: 20px;
    height: 20px;
    background-color: #34474f;
    border: solid 2px white;
    border-radius: 50%;
    position: absolute;
    left: -10px;
    top:30px;
}

#message_right {
    height: 70px;
    margin: 10px;
    padding:2px;
    padding-right: 10px;
    background-color: #fbffee;
    color:#444;
    float:right;
    box-shadow: 0px 0px 10px #aaa;
    border-top-left-radius: 30%;
    border-bottom-right-radius:50% ;
    position: relative;
    width:60%;
    min-width: 200px;
}

#message_right img {
    width: 60px;
    height: 60px;
    float: left;
    margin:2px;
    border-radius: 50%;
    border: solid 2px white;
}

#message_right div img{
    width: 25px;
    height: 18px;
    float: none;
    margin:0px;
    border-radius: 50%;
    border: none;
    position: absolute;
    top:30px;
    right:10px;
}

#message_right div {
    width: 20px;
    height: 20px;
    background-color: #34474f;
    border: solid 2px white;
    border-radius: 50%;
    position: absolute;
    right: -10px;
    top:30px;
}

        .loader_on{
            position: absolute;
           width:30%;
        }
        .loader_on img{
            width:70px;
        }
        .loader_off{
            display:none;
        }
        input[type=text] , input[type=password],input[type=submit]{
        padding:10px;
        margin:10px;
        width:100%;
        border-radius:5px;
        border:solid 1px grey;
       }
       input[type=submit] {
       width:106%;
       cursor: pointer;
       background-color: #2b5488;
       color:white;

       }
    </style>
</head>
<body>
    <div id="wrapper">
        <div id="left_pannel">
            <div id="user_info" style="padding:10px">
         <img id="profile_image" src="ui/images/user_female.jpg" style=" height: 100px; width:100px;">
    <br>
    <span id="username">Username</span>
    <br>
    <span id="email" style="font-size: 12px; opacity:0.5;">email@gmail.com</span>
    <br>
    <br>
    <br>
    <div> 
    <label id="label_chat" for="radio_chat">Chat<img src="ui/icons/chat.png"></label>    
  <label id="label_contacts" for="radio_contacts">Contacts<img src="ui/icons/contacts.png"></label>  
  <label id="label_settings"for="radio_settings">Settings<img src="ui/icons/settings.png"></label>
  <label id="logout"for="radio_logout">Logout<img src="ui/icons/logout.png"></label>  
            </div>

</div>

        </div>
        <div id="right_pannel">
            <div id="header">
            <div id="loader_holder" class="loader_on"><img styles ="width:100px;"src="ui/icons/giphy.gif"></div>
                My Chat</div>
            <div id="container" style="display:flex;">
                <div id="inner_left_pannel">
            
                </div>
                    <input type="radio" id="radio_chat" name="myradio" style="display: none;">
                    <input type="radio" id="radio_contacts" name="myradio" style="display: none;">
                    <input type="radio" id="radio_settings" name="myradio" style="display: none;">
                
                <div id="inner_right_pannel">

                </div>
            </div>
        </div>
    </div>
    
</body>
<script type="text/javascript">
 
      var CURRENT_CHAT_USER = "";
      var SEEN_STATUS = false;

        function _(element){
            return document.getElementById(element);
        }
        
        var label_contacts = _("label_contacts");
        label_contacts.addEventListener("click",get_contacts);

        var logout = _("logout");
        logout.addEventListener("click",logout_user);

        var label_chat = _("label_chat");
        label_chat.addEventListener("click",get_chats);

        var label_settings = _("label_settings");
        label_settings.addEventListener("click",get_settings);

        function get_data(find,type){
         
            var xml = new XMLHttpRequest();
            var loader_holder = _("loader_holder");
            loader_holder.className = "loader_on";

            xml.onload = function (){
            //alert(xml.responseText);
                if(xml.readyState == 4 || xml.status == 200){
                   // alert(xml.responseText);
                   loader_holder.className = "loader_off";
                    handle_result(xml.responseText,type);
                }
            }

            var data = {};
            data.find = find;
            data.data_type = type;
            data = JSON.stringify(data);

            xml.open("POST","api.php",true);
            xml.send(data);

        }
        function handle_result(result,type){
          //alert(result);

        if(result.trim() != ""){
            

            var inner_right_pannel = _("inner_right_pannel");
            inner_right_pannel.style.overflow = "visible";
                    
            var obj = JSON.parse(result);
            if(typeof(obj.logged_in) != "undefined" && !obj.logged_in){
                window.location = "login.php";
            }
            else{
                switch(obj.data_type){
                    case "user_info":
                        var username = _("username");
                        var email = _("email");
                        var profile_image = _("profile_image");
                        username.innerHTML = obj.username;
                        email.innerHTML = obj.email;
                        profile_image.src = obj.image;
                        break;
                case "contacts":
                    // SEEN_STATUS = false;
                    var inner_left_pannel = _("inner_left_pannel");
                    inner_right_pannel.style.overflow = "hidden";
                    inner_left_pannel.innerHTML = obj.message;
                break;
                case "chats_refresh":
                    SEEN_STATUS = false;
                      var messages_holder = _("messages_holder");
                      messages_holder.innerHTML = obj.message;
                    break;
                case "chats":
                    SEEN_STATUS = false;
                    var inner_left_pannel = _("inner_left_pannel");

                    inner_left_pannel.innerHTML = obj.user;
                    inner_right_pannel.innerHTML = obj.message;

                    var messages_holder = _("messages_holder");
                    
                     setTimeout(function(){

                        messages_holder.scrollTo(0,messages_holder.scrollHeight);
                        var message_text = _("message_text");
                        message_text.focus();
                    },100);


                break;
                case "settings":
                    var inner_left_pannel = _("inner_left_pannel");
                    inner_left_pannel.innerHTML = obj.message;
                break;
                case "save_settings":
                    alert(obj.message);
                    get_data({},"user_info");
                    get_settings(true);
                break;
                
                }


            }
        }
          
        }
        function logout_user(){
            var answer = confirm("Are you sure you want to log out?");
            if(answer){
            get_data({},"logout");
            }
        }
        get_data({},"user_info");
        get_data({},"contacts");

        var radio_contacts = _("radio_contacts");
        radio_contacts.checked = true;
        function get_contacts(e){
            get_data({},"contacts");
           }
           function get_chats(e){
            get_data({},"chats");
           }
           function get_settings(e){
            get_data({},"settings");
           }
           function send_message(e) {
    var message_text = _("message_text");
    if (message_text.value.trim() == "") {
        alert("Please type something to send");
        return;
    }

     get_data({
            message: message_text.value.trim(),
            userid: CURRENT_CHAT_USER
        }, "send_message");

        // Clear the text box
        message_text.value = "";
}
function enter_pressed(e){
    if(e.keyCode == 13){
        send_message(e);
    }
    SEEN_STATUS = true;
}

setInterval(function(){

    if(CURRENT_CHAT_USER != ""){

       // console.log(SEEN_STATUS);
        get_data({
            userid:CURRENT_CHAT_USER,
            seen: SEEN_STATUS
        },"chats_refresh");
    }
    //if u want to load the chats by refresh instead of chats write chats_refresh

},5000);


function set_seen(e){
     SEEN_STATUS = true;
}
    </script>




<script type="text/javascript">


function collect_data(){
    var save_settings_button   = _("save_settings_button");
save_settings_button.disabled = true;
save_settings_button.value = "Loading...Please wait..";

var myform = _("myform");
var inputs = myform.getElementsByTagName("INPUT");

var data ={};
for(var i = inputs.length-1;i>=0;i--){
    var key = inputs[i].name;
    switch(key){
        case "username":
             data.username = inputs[i].value;
             break;
        case "email":
             data.email = inputs[i].value;
             break;
        case "gender":
            if(inputs[i].checked){
             data.gender = inputs[i].value;
            }
             break;
        case "password":
             data.password = inputs[i].value;
             break;
        case "password2":
             data.password2 = inputs[i].value;
             break;
    }
}
send_data(data,"save_settings");

}
function send_data(data,type){
   var xml = new XMLHttpRequest();
   xml.onload = function(){
    if(xml.readyState == 4 || xml.status == 200){
        handle_result(xml.responseText);
        var save_settings_button   = _("save_settings_button");
        save_settings_button.disabled = false;
        save_settings_button.value = "Sign up";
    }
}
    data.data_type = type;
    var data_string = JSON.stringify(data);

    xml.open("POST","api.php",true);
    xml.send(data_string);

}
function upload_profile_image(files){

    var myfile = files[0].name;
    
    var change_image_button   = _("change_image_button");
    change_image_button.disabled = true;
    change_image_button.innerHTML = "Uploading Image...";

    var myform = new FormData();

    var xml = new XMLHttpRequest();

   xml.onload = function(){

    if(xml.readyState == 4 || xml.status == 200){
        //alert(xml.responseText);
       
        get_data({},"user_info");
        get_settings(true);
        change_image_button.disabled = false;
        change_image_button.innerHTML = "Change Image";
    }
}
    myform.append('file', files[0]);
    myform.append('data_type',"change_profile_image"); 

    xml.open("POST","uploader.php",true);
    xml.send(myform);
}

function handle_drag_and_drop(e){

    if(e.type == "dragover"){

        e.preventDefault();
        e.target.className = "dragging";
    } 
    else if(e.type == "dragleave"){

          e.target.className = "";
    }
     else if(e.type == "drop"){

        e.preventDefault();
        e.target.className = "";

        upload_profile_image(e.dataTransfer.files);
    }
    else{
        e.target.className = "";
    }
}
function start_chat(e){
    var userid = e.target.getAttribute("userid");

   if(e.target.id == ""){
       userid = e.target.parentNode.getAttribute("userid");
   }
   CURRENT_CHAT_USER = userid;
    var radio_chat = _("radio_chat");
    radio_chat.checked = true;
    get_data({userid:CURRENT_CHAT_USER},"chats");
}
</script>
</html>

