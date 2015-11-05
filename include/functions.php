<?php 
require_once('init.php');

//Get fireteam from operation id
function getFT($id){
    global $database;
    $query = "SELECT * FROM fireteams WHERE opID = ? ORDER BY id";

    $stmt = $database->connection->stmt_init();
    if(!$stmt->prepare($query)) {
        echo 'Det gick inte att förbereda statement.';
    } else {
        $stmt->bind_param('i',$id );
        $stmt->execute();
        $result = $stmt->get_result();


        while ( $ftData = $result->fetch_assoc() ) {
            //do sessionlogin
            $firedata[] = $ftData;
        }
    }
    return $firedata;
}


//Get all operations
function getOps(){
    global $database;
    
    $query = "SELECT * FROM operations order by id DESC";

    $stmt = $database->connection->stmt_init();
    if(!$stmt->prepare($query)) {
        echo 'Det gick inte att förbereda statement.';
    } else {
        $stmt->execute();
        $result = $stmt->get_result();

        while ( $opData = $result->fetch_assoc() ) {
            //do sessionlogin
            $data[] = $opData;
        }
    }
    return $data;
}

?>