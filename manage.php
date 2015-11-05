<?php require_once('include/init.php');
unset ($_SESSION['missing']);
    unset ($_SESSION['errors']);

    if(filter_has_var(INPUT_GET, 'op')){
        $required = array('op');
        $validate = new Pos_Validator($required, 'get');
        $validate->isInt('op');
        $filtered = $validate->validateInput();
        $missing = $validate->getMissing();
        $errors = $validate->getErrors();
        if(!$missing && !$errors) {
            $operation = operation::getOP($filtered['op']);
        } else {
            $_SESSION['missing'][] = $missing;
            $_SESSION['errors'][] = $errors;
            $_SESSION['CantFindOP'] = 'true';
            header('Location: manage.php');
        }
    } else {

        $operation = operation::getLatestOP();
    }


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
                    <li><a href="index.php">News <span class="sr-only">(current)</span></a></li>
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
                                        <input type="Password" class="form-control" id="Password" placeholder="Password">
                                    </div>

                                    <button type="submit" class="btn btn-info">Login</button>
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!-- END HEADER NAV -->

    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="page-header">
                            <h3><?php if(isset($operation)){ echo $operation['opTitle']; } ?> <small>posted 10 July 2015 by Glore</small></h3>
                        </div>
                        <img class="featureImg img-thumbnail" src="http://dummyimage.com/800x275/4d494d/686a82.gif&text=testing" alt="testing">
                        <?php if(isset($operation)) { echo strip_tags(html_entity_decode($operation['opDesc']), '<p><h4><small><strong>'); }  ?>
                    </div>
                </div>
            </div>
            
            <!-- SIDEBAR -->
            <div class="col-lg-3">
                <div class="list-group">
                    <?php 
                        $data = getOps();
                        
                        for($i = 0; $i < count($data); $i++) {
                            $content = '<a href="manage.php?op='. $data[$i]['id'] .'" class="list-group-item">';
                            $content .= '<h4 class="list-group-item-heading">'. $data[$i]['opTitle'] .'</h4>';
                            $content .= '<p class="list-group-item-text">'. strip_tags(html_entity_decode(substr($data[$i]['opDesc'], 0, 100))) .'...</p>';
                            $content .= '</a>';
							echo $content;
                        }
                    ?>
                </div>
            </div>
            <!-- END SIDEBAR -->
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