<?php 
    require_once('include/init.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>MIL-SIM</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/extras.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>    
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">MIL-SIM</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">News <span class="sr-only">(current)</span></a></li>
                    <li><a href="about.php">About us</a></li>
                    <li><a href="phpBB3/">Forum</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Streams <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><p class="navbar-text">Twitch</p></li>
                            <li><a href="#">Glore</a></li>
                            <li><a href="#">Ziraz</a></li>
                            <li><a href="#">Kimukun</a></li>
                            <li><p class="navbar-text">Hitbox</p></li>
                            <li><a href="#">Glore</a></li>
                            <li><a href="#">Ziraz</a></li>
                            <li><a href="#">Kimukun</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Operations <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="op.php">Create Operation</a></li>
                            <li><a href="manage.php">Manage Operations</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login</a>
                        <div id="loginDiv" class="panel panel-default dropdown-menu loginPanel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Login</h3>
                            </div>
                            <div class="panel-body">
                                <?php
                                    if(!isset($_SESSION['steamid'])) {
                                    
                                        echo "<p>Welcome Guest! Please login</p>";
                                        echo steamlogin(); //login button
                                        
                                    }  else {
                                        include('include/steamauth/userInfo.php');
                                        //Protected content
                                        echo "<p class='panel-content'>Welcome back " . $steamprofile['personaname'] . "</p>";
                                        echo '<img class="img-thumbnail" src="'.$steamprofile['avatarfull'].'" title="" alt="'. $steamprofile['personaname'] .'" />'; // Display their avatar!
                                        
                                        echo '<p>'.logoutbutton().'</p>';
                                    }    
                                ?>
                            </div>
                        </div>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!-- END HEADER NAV -->

    <!-- JUMBOTRON -->
    <div class="container">
        <div class="jumbotron">
            <h1>Welcome to MIL-SIM</h1>
            <p>A swedish Arma3 mil-sim community, focusing on yadayayaydayyya. Come join us.</p><p>For the win.</p>
            <p><a class="btn btn-info" href="#" role="button">Join us</a></p>
        </div>
    </div>
    <!-- END JUMBOTRON -->
    
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3><a href="article.php">OP Overlord Chapter 2</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                culpa qui officia deserunt mollit anim id est laborum.</p>
                <a href="article.php" class="btn btn-primary">Read more</a>
            </div>
            <div class="col-md-4">
                <h3><a href="article.php">OP Overlord Chapter 2</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                culpa qui officia deserunt mollit anim id est laborum.</p>
                <a href="article.php" class="btn btn-primary">Read more</a>
            </div>
            <div class="col-md-4">
                <h3><a href="article.php">OP Overlord Chapter 2</a></h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                culpa qui officia deserunt mollit anim id est laborum.</p>
                <a href="article.php" class="btn btn-primary">Read more</a>
            </div>
        </div>
    </div>
    <!-- FOOTER  -->
    <div class="navbar navbar-default footer">
        <div class="container">
            <a class="navbar-text" href="http://www.malven.se">Powered by Malven.se.</a>
            <a class="navbar-btn btn-info btn pull-right" href="index.php">Join us</a>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>