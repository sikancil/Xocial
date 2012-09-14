<? include "core/init.php"; ?>
<html>
<head>
<link rel='stylesheet' href='style.css'>
<link rel='stylesheet' href='styles/tipTip.css'>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
<script src="http://yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>
<script src='js/main.js'></script>
<script src='js/tipTip.js'></script>
<title>Xocial</title>
</head>
<body>

<div class='header'>
    <div class='head'>
        <div class='logo'>Xocial</div>
        <div class='slogan'>is Koding Social</div>
        <div class='auth'>
            <? include "modules/auth.php"; ?>
        </div>
    </div>
</div>

<div class='main'>
    <div class='leftBlock'>
        
        <div class='menu'>
            <a id='home' href='#' class='active'>Chat</a>
            <a id='blog' href='#'>About me</a>
            <a id='account' href='#'>Account</a>
        </div>
        
    </div>
    <div class='content'>
        <div id="panel-home"><? include "pages/home.php"; ?></div>
        <div id="panel-blog"><? include "pages/blog.php"; ?></div>
        <div id="panel-account"><? include "pages/account.php"; ?></div>
    </div>
</div>

</body>
</html>