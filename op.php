<?php
    require_once('include/init.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>MIL-SIM</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Tweaks to Bootstrap -->
    <link href="css/extras.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">MIL-SIM</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">News <span class="sr-only">(current)</span></a></li>
                    <li><a href="article.php">About us</a></li>
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
                        <div class="panel panel-default dropdown-menu loginPanel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Login</h3>
                            </div>
                            <div class="panel-body">
                                <form action="login.php" method="POST" role="form">
                                <div class="form-group">
                                    <label for="username" class="sr-only">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password">
                                </div>

                                <button type="submit" class="btn btn-info">Login</button>
                            </form>
                            </div>
                        </div>
                    </li>
                    <li><a href="#registerModal" data-toggle="modal">Register</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!-- END HEADER NAV -->
    <!-- CONTAINER -->
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <?php
                    if(isset($_SESSION['message'])){
                        echo '<div id="message" class="alert alert-success" role="alert"><p>'. $_SESSION['message'].'</p></div>';
                        unset($_SESSION['message']);
                    }
                ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="page-header">
                            <h3>Create an Operation.</h3>
                        </div>
                            <form id="OPForm" action="process.php" method="post" role="form">
                                <div class="form-group">
                                    <label for="addOpTitle">Operation Title: </label>
                                    <input type="text" class="form-control" id="addOpTitle" name="addOpTitle" placeholder="Operation title...">
                                </div>
                                <div class="form-group">
                                    <label for="addOpDesc">Operation Description: </label>
                                    <textarea class="form-control" id="addOpDesc" name="addOpDesc" placeholder="Operation description..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="addOpImg">Operation Image (<span class="text-warning"><small>805x275 preferably</small></span>): </label>
                                    <input type="file" class="form-control" id="addOpImg" name="addOpImg" disabled>
                                </div>
                                <div class="row" id="fireteams">
                                </div><!-- END form .row -->
                                <hr>
                                <button type="submit" id="saveButton" name="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-danger">Reset</button>
                            </form>
                    </div>
                </div>
            </div>
            
            <!-- SIDEBAR -->
            <div class="col-lg-3">
                <div class="list-group">
                    <div class="list-group-item">
                        <h4 class="list-group-item-heading">HTML tags: </h4>
                        <p class="list-group-item-text">Available HTML tags in operation description:</p>
                        <code>&lt;h4&gt;header&lt;/h4&gt;<br>
                            &lt;strong&gt;strong&lt;/strong&gt;<br>
                            &lt;small&gt;small&lt;/small&gt;<br>
                            &lt;p&gt;paragraph&lt;/p&gt;</code>
                    </div>
                    <a href="#" class="list-group-item list-group-item-success addFireteamButton">
                        <h4 class="list-group-item-heading">Add Fireteam</h4>
                        <p class="list-group-item-text">Adds a new fireteam, used to allow users to sign up on operations.</p>
                    </a>
                </div>
            </div>
            <!-- END SIDEBAR -->

        </div>
    </div>
    <!-- END CONTAINER -->

    <!-- FOOTER  -->
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <a class="navbar-text" href="http://www.malven.se">Powered by Malven.se.</a>
            <a class="navbar-btn btn-info btn pull-right" href="index.php">Join us</a>
        </div>
    </div>
    <!-- END FOOTER -->
    
    <!-- REGISTER MODAL -->
    <div class="modal fade" id="registerModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Register</h4>
                </div>
                <div class="modal-body">
                    <form action="register.php" method="POST" role="form">
                        <div class="form-group">
                            <label for="r_username" class="sr-only">Username: </label>
                            <input type="text" class="form-control" id="r_username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="r_password" class="sr-only">Password: </label>
                            <input type="password" class="form-control" id="r_password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="r_email" class="sr-only">Email: </label>
                            <input type="text" class="form-control" id="r_email" placeholder="Email">
                        </div>
                        <button type="submit" class="btn btn-warning">Register</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- ERROR MSG GOES HERE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END REGISTER MODAL -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/addons.js"></script>
</body>
</html>