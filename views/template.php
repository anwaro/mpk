<!DOCTYPE HTML>
<html>
    <!--
    
    Author: Łukasz Micał
    WWW: lukaszmical.pl
    
    -->

    <head>
        <title>{%title%}</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link href="{%url%}/favicon.ico" rel="shortcut icon" type="image/x-icon">





        <script src="{%url%}public/js/jquery.js"></script>
        <script>url = "{%url%}";</script>
        {%js%}
        <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet">
        <link href="{%url%}public/css/default.css" rel="stylesheet" media="screen">
        <link href="{%url%}public/css/fonts.css" rel="stylesheet" media="screen">
        {%css%}
    </head>
    <body>
        <div id="header-wrapper">
            <div id="header" class="container">
                <div id="logo">
                    <h1><a href="#">MPK</a></h1>
                </div>
                <div id="menu">
                    <ul>
                        {%menu%}
                    </ul>
                </div>
            </div>
        </div>

        <div id="wrapper">
            <div id="featured-wrapper">
                <div id="featured" class="container">
                {%content%}
                </div>
            </div>
            <div id="extra" class="container">
                
            </div>
        </div>

        <div id="copyright" class="container">
            <p>© All rights reserved. | Design by 
                <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
                . | 
                <a href="{%url%}phpinfo">PHP INFO</a></p>
        </div>
    </body>
</html>