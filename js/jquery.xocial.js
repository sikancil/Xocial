    function makeCheckbox(container, name, valOff, valOn)
    {
        var on = false,
            speed = 300;

        $(container).append("<div class='lbtn-hidden'></div>");
        $(".lbtn-hidden").append("<div class='lbtn-left'>"+valOff+"</div>");
        $(".lbtn-hidden").append("<div class='lbtn-center'></div>");
        $(".lbtn-hidden").append("<div class='lbtn-right'>"+valOn+"</div>");
        
        $(container).append("<input id='lbtn-check' name='"+name+"'>");
        
        $(".lbtn-center").click(function() {
            if(on == false) {
                $(".lbtn-left").stop().animate({ marginLeft: "-30px" }, speed);
                $("#lbtn-check").attr("checked", true);
                on = true;
            }
            else {
                $(".lbtn-left").stop().animate({ marginLeft: "0px" }, speed);
                $("#lbtn-check").attr("checked", false);
                on = false;
            }
        })
    }