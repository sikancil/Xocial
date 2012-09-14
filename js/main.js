$(document).ready(function(e) {
   /// LINKS
   
   $('#home').click(function(e) { lookAt('home') });
   $('#blog').click(function(e) { lookAt('blog') });
   $('#account').click(function(e) { lookAt('account') });
   
   $('.menu a').mouseenter(function(e) {
       $(this).stop().animate({ opacity: 1 }, 200);
   });
   
   $('.menu a').mouseleave(function(e) {
       $(this).stop().animate({ opacity: 0.5 }, 200);
   });
   
   $("a").click(function(e) { return false; });
   
   /// END LINKS
   
   function lookAt(id)
   {
       $(".menu a").removeClass("active");
       $("#"+id).addClass("active");
       $('#panel-home, #panel-blog, #panel-account').hide();
       $("#panel-"+id).fadeIn(500);
   }
   
   ////////////////////////////// LOGIN
   
   $("#userName").focus(function() {
        $(this).stop().animate({ opacity: 1}, 200);
   })
   $("#userName").blur(function() {
        $(this).stop().animate({ opacity: 0.5}, 200);
   })
   
   $("#userName").keypress(function(e){
        if(e.keyCode == 13) {
            $.cookie("name", $(this).val());
            $(".auth").html('<h3>'+$(this).val()+'</h3>');
            $(".main").slideDown(500);
        }
   })
   
   ////////////////////////////// LOGOUT
   $("#btn-logout").click(function() {
        $.cookie("name", null);
        $(".auth").fadeOut(1000);
        $(".main").slideUp(500);
        $(".logo").animate({ marginLeft: "200px" }, 1000);
        $(".slogan").html("Bye-bye");
        $(".slogan").animate({ marginLeft: "150px" }, 1000);
        setTimeout(function() {
            $(".logo").fadeOut(1000);
            $(".slogan").fadeOut(2000);
            
            setTimeout(function() {
                $(".head").html("<button id='reboot'>Reload</button>");
                $("#reboot").css("position", "absolute");
                $("#reboot").css("marginLeft", "300px");
                $("#reboot").css("top", "30px");
                $("#reboot").hide();
                $("#reboot").fadeIn(1000);
                $("#reboot").click(function() { window.location = "/"; })
            }, 2000);
        }, 2000);
   })
   
   ////////////////////////// PHOTO ZOOM
   var zoomed = false;
   
   $(".photo").click(function() {
        if(zoomed == false) {
            $(".about").fadeOut(200);
            $(".photo div").fadeOut(200);
            setTimeout(function() {
                $(".photo img").stop().animate({ width: "300px" }, 500);
                $(".photo").stop().animate({ marginLeft: "120px" }, 500);
                zoomed = true;
            }, 200)            
        }
        if(zoomed == true) {
            $(".photo img").stop().animate({ width: "150px" }, 500);
            $(".photo").stop().animate({ marginLeft: "0px" }, 500);
            setTimeout(function() {
                $(".about").fadeIn(500);
                $(".photo div").fadeIn(500);
                zoomed = false;
            }, 500);
        }
   })
});