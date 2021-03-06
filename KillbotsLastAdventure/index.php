<?
error_reporting(E_ALL & ~E_NOTICE);
include_once('css/css.func.php');
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Killbot FTW</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/game.css.php">
        <link rel="stylesheet" href="css/font-awesome.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="js/vendor/handlebars-v1.3.0.js"></script>
        <script src="js/vendor/jquery-1.10.2.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/ui.js"></script>
        <script src="js/sim.js"></script>
        <script src="js/level.js"></script>
        <script src="js/talk.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <!-- Add your site or application content here -->
        <header>
        Killbot's Last Adventure
        </header>

        <script>
        Config.textColor = '<?= color($textColor) ?>';
        </script>

        <div id="content"><?php
        $screen = basename($_REQUEST['p']);
        if($screen == '') $screen = 'default';
        $includeFile = 'screens/'.$screen.'.php';
        if(file_exists($includeFile))
          include($includeFile);
        else
        {
          print('<div class="banner">Error: screen not found ('.htmlspecialchars($screen).')<span id="cursor"></span></div>');
        }
        ?></div>


    </body>
</html>
