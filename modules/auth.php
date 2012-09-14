<? if(!isset($_COOKIE['name'])) {
    
    if($_SERVER['HTTP_X_REQUESTED_WITH'] != "XMLHttpRequest") { ?>
    
        <script>
        $(document).ready(function() {
            $(".main").hide();
        });
        </script>
        
    <? } ?>
    
    <h3>Enter your name:</h3>
    <input type='text' id='userName' placeholder='Your real name'>
<? } else { ?>
    <h3><?=$_COOKIE['name']?></h3>
<? } ?>