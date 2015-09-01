<?php
require_once('include/init.php');

    if(filter_has_var(INPUT_POST, 'submit')){
        $required = array('addOpTitle', 'addOpDesc');
        $validate = new Pos_Validator($required);
        $validate->removeTags('addOpTitle');
        $validate->useEntities('addOpDesc');
        $filtered = $validate->validateInput();
        $missing = $validate->getMissing();
        $errors = $validate->getErrors();

        if(!$missing && !$errors) {
            $op = new operation();
            $op->opTitle = $filtered['addOpTitle'];
            $op->opDesc = $filtered['addOpDesc'];

            //TODO fileupload
            $op->imgUrl = 'img/usertemp.png';

            $op->save();
        } else {
            $_SESSION['message'] = $missing .' - '. $errors;
            $_SESSION['opError'] = 'true';
            header('Location: op.php');
        }

        foreach ( $_POST['fireteam'] as $team ) {
                $fireteam = new fireteam();
                $fireteam->callsign = $database->connection->real_escape_string($team['member']['callsign']);
                $fireteam->member1 = $database->connection->real_escape_string($team['member'][1]);
                $fireteam->member2 = $database->connection->real_escape_string($team['member'][2]);
                $fireteam->member3 = $database->connection->real_escape_string($team['member'][3]);
                $fireteam->member4 = $database->connection->real_escape_string($team['member'][4]);
                $fireteam->opID = $_SESSION['opID_justCreated'];
                $fireteam->save();
        }
            $_SESSION['message'] = 'Operation saved!';
            header('Location: op.php');
    }

  if(isset($_GET['addFireteam']) == 'true') {
    //TODO skapa fireteam klass och ladda upp i databasen

        $numberOfFireteams = 1;
        $numberOfMembers = 0;
        $salt = 19827 * rand(1,5000);
        echo $content = '<div class="col-md-4 fireteams">
                                    <div class="panel panel-primary">
                                            <div class="panel-heading">
                                              <h3 class="panel-title">Fireteam <button type="button" class="close removeFireteamButton" aria-label="Close"><span aria-hidden="true">&times;</span></button></h3>
                                           </div>
                                           <div class="panel-body">
                                                <div class="form-group fireteam">
                                                    <label>Fireteam callsign: </label>
                                                    <input type="text" class="form-control" name="fireteam['. ($numberOfFireteams * $salt) .'][member][callsign]" placeholder="Alpha 1-1, Alpha 1-2 etc..">
                                                </div>
                                                <div class="form-group fireteam">
                                                    <label>Fireteam position. </label>
                                                    <input type="text" class="form-control" name="fireteam['. ($numberOfFireteams * $salt) .'][member]['. ($numberOfMembers+1) .']" placeholder="Team Leader, AT Soldier, Medic, MG etc..">
                                                </div>
                                                <div class="form-group fireteam">
                                                    <label>Fireteam position. </label>
                                                    <input type="text" class="form-control" name="fireteam['. ($numberOfFireteams * $salt) .'][member]['. ($numberOfMembers+2) .']" placeholder="Team Leader, AT Soldier, Medic, MG etc..">
                                                </div>
                                                <div class="form-group fireteam">
                                                    <label>Fireteam position. </label>
                                                    <input type="text" class="form-control" name="fireteam['. ($numberOfFireteams * $salt) .'][member]['. ($numberOfMembers+3) .']" placeholder="Team Leader, AT Soldier, Medic, MG etc..">
                                                </div>
                                                <div class="form-group fireteam">
                                                    <label>Fireteam position. </label>
                                                    <input type="text" class="form-control" name="fireteam['. ($numberOfFireteams * $salt) .'][member]['. ($numberOfMembers+4) .']" placeholder="Team Leader, AT Soldier, Medic, MG etc..">
                                                </div>
                                          </div>
                                        </div>                                        
                                    </div><!-- END #fireteams .col-md-4 -->';
    }

    if(isset($_GET['removeFireteam'])) {
        //TA bort från databasen
        echo $_GET['removeFireteam'];
    }
        
?>