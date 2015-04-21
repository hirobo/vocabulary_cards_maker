<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo APP_TITLE; ?></title>

        <!-- Bootstrap -->
        <link href="lib/bootstrap-2.3.2/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <!-- Custom styles -->
        <link type="text/css" href="style.css" rel="stylesheet">
        <!-- JavaScript -->
        <script src="lib/jquery-2.0.3.min.js"></script>
        <script src="lib/jquery-ui.min.js"></script>
        <script src="lib/bootstrap-2.3.2/js/bootstrap.min.js"></script>
    </head>
    <body style>
        <div class="wrapper">
            <div class="main">
                <!-- Fixed navibar -->
                <div class="navbar navbar-inverse navbar-fixed-top">
                    <div class="navbar-inner">
                        <div class="container">
                            <a class="brand" href=<?php echo MY_HOME; ?>><?php echo APP_TITLE; ?></a>
                            <div class="nav-collapse collapse">
                                <ul class="nav">
                                    <li><a href=<?php echo SHOW_GITHUB; ?>>View Source Code</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
