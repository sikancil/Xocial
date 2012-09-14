<script>
$(document).ready(function() {
   function send()
    {
        var msg = $("#msg").val();
        var name = $.cookie("name");
        var token = Math.floor(Math.random()*1000000);
        
        $("#msg").attr("disabled", true);
        
            $.ajax({
              type: 'POST',
              url: "modules/server.php",
              data: { "name": name, "msg": msg },
              success: function() { $("#msg").val(''); $("#msg").removeAttr("disabled"); }
            });
    }
    
    function success(id, name, msg, token)
    {
        $(".messages").append("<div class='mmsg' msgid='"+id+"' id='"+id+token+"'></div>");
        $("#"+id+token).append("<div class='name'>"+name+"</div>");
        $("#"+id+token).append("<div class='msg'>"+msg+"</div>");
        
        showMsg(id+token);
    }
    
    function showMsg(id)
    {
        $("#"+id).hide();
        $("#"+id).fadeIn(200);
        
        $('body').animate({scrollTop: $(this).height()}, 200);
    }
    
    function getMsg()
    {
        setTimeout(function() {
            switchStatus("online");
            var last_msg = $(".mmsg").last().attr("msgid");
    
            $.ajax({
                type: 'GET',
                url: 'modules/server.php',
                data: { 'last_id': last_msg },
                success: function(data)
                    {
                        if(data != "") {
                            var fl = data.split("~");
                            var sl = fl[1].split(";");
                            
                            var id = sl[0],
                                name = sl[1],
                                msg = sl[2],
                                token = sl[3];
                            success(id, name, msg, token);
                        }
                    },
                complete: function() { switchStatus("offline"); getMsg(); }
            });
        }, 1000);  
    }
    
    function switchStatus(status) {
        $(".circle").removeClass("c_offline");
        $(".circle").removeClass("c_online");
        if(status == "online") { $(".circle").addClass("c_online"); }
        if(status == "offline") { $(".circle").addClass("c_offline"); }
    }
    
    //###########################\\
    
    $("#msg").keypress(function(e) {
        if(e.keyCode == 13) {
            send();
        }
    })
    
    $("#msg").focus();
    
    getMsg();
    
    $(".circle").tipTip({ defaultPosition: "left", delay: 0 });
})
</script>

<?php
    //error_reporting(0);
    require_once "core/classes/core.class.php";
    require_once "core/classes/mysql.class.php";
    $mysql = new mysql("host", "user", "pass", "database");
    
    $q = $mysql->getFromQuery("SELECT COUNT(id) FROM msg");
    $max = $q[0]['COUNT(id)'];
    if($max > 5) $max5 = $max-5;
    else $max5 = 0;
    
    $q = $mysql->getFromQuery("SELECT * FROM msg ORDER BY id LIMIT $max5, $max");
    $token = rand(0, 999999);
?>

<div class='chat'>
    <div class='messages'>
    <? if(count($q) == 0) { ?>
        <div class='mmsg'>
                <div class='name'>CreatureMyst</div>
                <div class='msg'>Hello guys! Welcome to Xocial chat!</div>
        </div>
    <? }
        for($n=0; $n < count($q); $n++) {
            echo "<div class='mmsg' msgid='".$q[$n]['id']."' id='".$q[$n]['id'].$token."'>";
                echo "<div class='name'>".$q[$n]['name']."</div>";
                echo "<div class='msg'>".$q[$n]['msg']."</div>";
            echo "</div>";
        }
    ?>
    </div>
    
    <div class='toolbar'>
        <input type='text' id='msg' placeholder='Type your message'>
        <div class='circle c_offline' title='It`s connection indicator. Every second you send a query to server-side and sync your message list.'></div>
    </div>
</div>