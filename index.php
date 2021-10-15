<?php
    include('connection.php');
    session_start();
    
    
    if(!isset($_SESSION['user_id']))
    {
        header('location:/sign-in.php');
       
    }
    
?>


<!doctype html>
<html lang="en">
    
<head>
    
    <!--Bootstrap, Fonts, Icons -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, shrink-to-fit=no , user-scalable=0">
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous">
    
     
    
    
    <!--Emojionarea-->
    <link rel="stylesheet" href="css/emojionearea.min.css">
    <script src="js/jquery-3.5.0.min.js" integrity="sha256-NjBU59nAXcMiH4mmJDh9uyIOEgfabHrHSZuUsO8yu0Q=" crossorigin="anonymous"></script>
    <script src="js/emojionearea.min.js"></script>
    <script src="js/notify.js"></script>
    <script src="js/howler.min.js"></script>
    
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>-->

        
    
    <!--Stylesheet -->
    <link rel="stylesheet" href="css/index.css">
    <title >Chat Application</title>

</head>
    
    
<body class="container-fluid no-padding"  >
    
    
    
    <div  id="friend-list1" class="row header-2">
        <div class="col-2">
            <button type="button" class="set-profile-pic btn btn-sm "> Profile</button>
        </div>
        <div class="search col-8" style="text-align: center;">
		<input type="text" placeholder="search" data-search />
	    </div>
        <div class="col-2">
            <a href="logout.php"><button type="button" class="btn btn-sm btn-default logout">Logout <span class="glyphicon glyphicon-off"></span></button></a> 
        </div> 
    
    </div>
    
    
    <div class="row main-body"  >
        <div id="friend-list" style="width:100%;" >
            
            <div id='user-details' class="user-details"></div>
        </div>
        
        <div id="chat-box" style="width:100%;height:100%; display:none; ">
        
            <div  class="chat-box" style="width:100%;" ></div>
            
            
    </div>      
  
    <script src="js/popper.min.js" integrity="sha256-7AWAWrnzBhpZ1+xtVOsJTGrqo0sC7FzOW+mvsdrC+qM=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha256-CjSoeELFOcH0/uxWu6mC/Vlrc1AARqbm/jiiImDGV3s=" crossorigin="anonymous"></script>
  </body>
</html>

<script>

var countss= 0;
var clicked = false;

$('[data-search]').on('keyup', function() {
    clicked = true;
	var searchVal = $(this).val();
	var filterItems = $('[data-filter-item]');

	if ( searchVal != '' ) {
		filterItems.addClass('hidden');
		$('[data-filter-item][data-filter-name*="' + searchVal.toLowerCase() + '"]').removeClass('hidden');
	} else {
		filterItems.removeClass('hidden');
        clicked=false;
	}
}); 

    //Set Profile Picture
    $(document).on("click", ".set-profile-pic", function()
    {   $('#chat-box').css({
        'display': 'flex'
        
    }); 
        $('.chat-box').html("<div class='main'> <div style='margin: 0px auto; width: 300px;'><div id='profile-pic'></div><button  type='button' class='remove' style='background-color: #FF00FF; color: white;  margin-top: 100px auto; width: 80px;height:30px;'> Cancel</button><label for='file' class='btn' style='background-color: #11887B; color: white;  margin: 20px auto; width: 300px;'>Change</label><input type='file' accept='image/*' capture='camera' name='file' id='file' style='display: none;'></div></div>");
       
                
        setInterval(function(){
           display_image(); 
        }, 1000);  
        
        
        function display_image()
        {
            $.ajax({
                url: "upload-profile-pic.php",
                method: "GET",
                success:function(data){
                            $('#profile-pic').html(data);
                        }
            });
        }
        
        $(document).on("change", "#file", function(){
            var property = document.getElementById("file").files[0];
            var img_name = property.name;
            var img_extension = img_name.split('.').pop().toLowerCase();
            
            var form_data = new FormData();
            form_data.append("file", property);
            
            $.ajax({
                url: "upload-profile-pic.php",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend:function(){
                                $('#profile-pic').html("<label class='text-success'>Image Uploading...</label>");
                            },   
                success:function(data){
                                $('#profile-pic').html(data);
                    
                        }
            });
        });
    });
    
    
    //For the cross icon
    
    
    $(document).on("click", "#star", function(){
        
        $('#friend-list').css({
        'display': 'block'
        
    });
        $('#friend-list1').css({
        'display': 'flex'
        
    });
    $('#chat-box').css({
        'display': 'none'
        
    });
    $('.chat-title').data("to_userid", '');
    })

    $(document).on("click", ".remove", function(){
        $('#chat-box').css({
        'display': 'none'
        
    });
        $('#friend-list').css({
        'display': 'block'
        
    });
    $('#friend-list1').css({
        'display': 'flex'
        
    });

    })

    $(document).on("click", "#user-details", function(){
       $('#friend-list1').css({
        'display': 'none'
        
    });
    $('#friend-list').css({
        'display': 'none'
        
    });
    $('#chat-box').css({
        'display': 'flex'
        
    }); 
})
    //Function is used to get all user details 
    function fetch_user()
    {   if (clicked) return;
        var req = new XMLHttpRequest();
        req.open("get", "fetch-user.php", true);
        req.send();
    
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
                
                
                
                document.getElementById("user-details").innerHTML = req.responseText;
                
                var selection1 = document.querySelector('#first') !== null;
                if (selection1) {
                    $('#first').each(function() {
                        var row1 = $('#first').parents('tr')       
                        row1.prependTo('table');
                });
                
                }
                var selection = document.querySelector('#noti') !== null;
                if (selection) {
                
                $('#noti').each(function() {
                    var row = $('#noti').parents('tr')       
                    row.prependTo('table');
                });
                }
            }
        };
    }
    function fetch_not()
    {   
        
        var req = new XMLHttpRequest();
        req.open("get", "fetch-user.php", true);
        req.send();
    
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
                
                var selection = document.querySelector('#noti') !== null;
                if (selection) {
                var counts =  $("label[id^=noti]").length ;
                if(counts > countss){
                
                    
                    $.notify("You Have New Message!");
                    
                    sound = new Howl({
                        src: ['noti.mp3']
                    });
                    
                    sound.play();
                    
                    countss= counts;
                    
                
                }else {
                    countss= counts;
                }
                } 
                else {
                    countss=0;
                }
            }
        };
    }
    
    
    //Function to update the last activity
    function update_last_activity()
    {
        var req = new XMLHttpRequest();
        req.open("get", "update-last-activity.php", true);
        req.send();
        
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
            }
        };
    }

    
    //Function to get the chat history
    function get_chat_history(to_userid)
    {
        var req = new XMLHttpRequest();
        req.open("post", "get-chat-history.php");
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send("to_userid="+to_userid);
        
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
                $("#chat-with-"+to_userid).html(req.responseText);
            }
        };
    }
    
    
    //Function used to insert chat into the database
    function insert_chat(to_userid, message, property)
    {
        var form_data = new FormData();
        form_data.append("to_userid", to_userid);
        form_data.append("message", message);
        form_data.append("share_file", property);
        
        var req = new XMLHttpRequest();
        req.open('POST', 'insert-chat.php', true);
        
        req.send(form_data);
      
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
                $("div.emojionearea-editor").html('');
                document.getElementById("share_file").value = "";
            }
        };
        
    }
    
    
    //Function for message notification
    function msg_notification()
    {
        if($(".chat-title").data('to_userid') != undefined)
        {
            var from_user_id = $(".chat-title").data('to_userid');
            var req = new XMLHttpRequest();
            req.open("post", "msg-notification.php");
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.send("from_user_id="+from_user_id);
            
            
            req.onreadystatechange  = function() 
            {
                if(req.readyState==4 && req.status == 200)
                {
                }
            };
        }
    }
    
    
    
    //calling fetch user() which is used to get all user details and online/offline status
    fetch_user();
    
    setInterval(function(){
        msg_notification();
        fetch_not();
        
    }, 1000);
    
    setInterval(function(){
        fetch_user();
        update_last_activity();
        
    }, 3000);
    
    
    //Function to update the chat history
    function update_chat_history(to_userid)
    {
        var last_index = -1;
        
        setInterval(function()
        {
            var req = new XMLHttpRequest();
            req.open("post", "update-chat-history.php");
            req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            req.send("to_userid="+to_userid);
        
            req.onreadystatechange  = function() 
            {
                if(req.readyState==4 && req.status == 200)
                {
                    if(req.responseText > last_index)
                    {
                        last_index = req.responseText;
                        get_chat_history(to_userid);
                    }
                }
            };
        }, 1000);
    }
    
    
    //This describes the what to be done when a start chat message is clicked
    $(document).on("click", ".start-chat", function()
    {   
        var to_userid = $(this).data('touserid');
        var to_username = $(this).data('tousername');
        var profile_pic = $(this).data('profile_pic');
        
        $('.chat-box').html("<div class='chat-title'></div><div class='chat-body'></div><div class='message-form row' ><div class='col-9'><textarea name='message' style='display: none; width:50%;' id='message-box'></textarea></div><div class='col-1'><label for='share_file'><div class='share-button' style='position: absolute;top: 50%;left: 50%; transform: translate(-50%, -50%);' ><img id='share' src='/images/share.png' height=30px width=30px style='border-radius: 100%''/></div></label><input type='file' name='share_file' id='share_file' onChange='getoutput()' accept='image/*, video/*, audio/*' style='display: none;'></div><div class='col-2'><div class='send-button '><button type='submit' class='send-chat ' style='position: absolute;top: 50%;left: 50%; transform: translate(-50%, -50%);'><img src='/images/send.png' height=30px width=30px style='border-radius: 100%''/></button></div></div></div>");
        
        get_text_area();

        $('.chat-title').attr("id", "to-userid-"+to_userid);
        $('.chat-title').data("to_userid", to_userid);
        $('.chat-body').attr("id", "chat-with-"+to_userid);
        $('.send-chat').data("to_userid", to_userid);
        $('#message-box').data("to_userid", to_userid);
        
        $('#to-userid-'+to_userid).html("<img id='star' src = '/images/back.png' height=50px width=50px style='border-radius: 100%  '> <img src = '/profile-pic/"+profile_pic+"'height=50px width=50px style='border-radius: 100%; '> <span style='color:#871F78;'>"+to_username+"</span>");
        
        update_chat_history(to_userid);
        
        setInterval(function(){
            get_chat_history(to_userid);
        }, 60000);
    });
    function getFile(filePath) {
        return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
    }
    function getoutput () {
        
  alert('Selected file: ' + getFile(share_file.value));
};
    
    //This describes the what to be done when a send chat message is clicked
    $(document).on("click", ".send-chat", function()
    {
        if( document.getElementById('message-box').value == '' && document.getElementById("share_file").files.length == 0)
        {
            alert("Enter a message to send!");
        }
        else
        {
            var to_userid = $(this).data('to_userid');
            var message =  document.getElementById('message-box').value;
            var property = document.getElementById("share_file").files[0];
            
            insert_chat(to_userid, message, property);
            
        }
    });
    
        
    //Delete chat message
    $(document).on("click", ".delete-msg", function()
    {
        var id = $(this).attr("id");
        
        var to_user_id = $(this).data('to_user_id');
        
        var req = new XMLHttpRequest();
        req.open("post", "delete-msg.php");
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send("chat_message_id="+id);
        
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
                update_chat_history(to_user_id);
            }
        };    
    });
    
    
    //Check User Profile
    $(document).on("click", ".check-profile", function()
    {
        var id = $(this).data("user_id");
        
        var req = new XMLHttpRequest();
        req.open("post", "check-profile.php");
        req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        req.send("user_id="+id);
        
        req.onreadystatechange  = function() 
        {
            if(req.readyState==4 && req.status == 200)
            {
                $('.chat-box').html(req.responseText);
            }
        }; 
    });
    
</script>


<!--Script for emojionarea-->
<script>
    
    function get_text_area()
    {
        $("#message-box").emojioneArea({  pickerPosition:"top",
                                           placeholder: "Write your message here",
                                           search: false
                                       });
  
        var msg_box = $("#message-box").emojioneArea();
        
        msg_box[0].emojioneArea.on("focus", function(editor, event) 
        {
            if($("#message-box").data('to_userid') != undefined)
            {
                var to_userid = $("#message-box").data('to_userid');
                var is_typing = 1;
            
                var req = new XMLHttpRequest();
                req.open("post", "set-typing-status.php");
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                req.send("to_userid="+to_userid+"&is_typing="+is_typing);
            
                req.onreadystatechange  = function() 
                {
                    if(req.readyState==4 && req.status == 200)
                    {
                    }
                };
            }
        });
                
        
        msg_box[0].emojioneArea.on("blur", function(editor, event) 
        {
             
            if($("#message-box").data('to_userid') != undefined)
            {
                var to_userid = 0;
                var is_typing = 0;
            
                var req = new XMLHttpRequest();
                req.open("post", "set-typing-status.php");
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                req.send("to_userid="+to_userid+"&is_typing="+is_typing);
            
                req.onreadystatechange  = function() 
                {
                    if(req.readyState==4 && req.status == 200)
                    {
                    }
                };
            }                                           
        });
    }
</script>

<style>


.hidden {
	display: none;
}
</style>