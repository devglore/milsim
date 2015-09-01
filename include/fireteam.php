<?php
/**
 * Created by PhpStorm.
 * User: marcus
 * Date: 2015-08-10
 * Time: 15:02
 */

class fireteam {

    public $id, $opID, $callsign, $member1, $member2, $member3, $member4;

    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }

    //både create och update är rätt identiska, create skickar inte med något id utan det skapar databasen automatiskt
    public function create() {
        global $database;
        $query = 'INSERT INTO fireteams (opID, callsign, member1, member2, member3, member4) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $database->connection->stmt_init();
        if(!$stmt->prepare($query)) {
            echo 'Det gick inte att förbereda statement.';
        } else {
            $stmt->bind_param('isssss', $this->opID, $this->callsign, $this->member1, $this->member2, $this->member3, $this->member4 );
            $stmt->execute();
            if($stmt->affected_rows == 1) {
                $this->id = $stmt->insert_id;
                $_SESSION['message'] = 'Fireteam: ' . $this->id . ' have been created.';
            } else {
                echo 'Something went wrong: ' .$database->connection->error;
            }
        }
    }

    public function update() {
        global $database;
        $query = 'UPDATE fireteams SET opID = ?, callsign = ?, member1 = ?, member2 = ?, member3 = ?, member4 = ? WHERE id = ?';
        $stmt = $database->connection->stmt_init();
        if(!$stmt->prepare($query)) {
            echo 'Det gick inte att förbereda statement.';
        } else {
            $stmt->bind_param('ssssssi', $this->opID, $this->callsign, $this->member1, $this->member2, $this->member3, $this->member4, $this->id);
            $stmt->execute();
            if($stmt->affected_rows == 1) {
                $_SESSION['message'] = 'Fireteam: ' . $this->id . ' have been updated.';
            } else {
                echo 'Something went wrong: ' .$database->connection->error;
            }
        }
    }

    public static function delete($id) {
        global $database;
        $query = 'DELETE FROM fireteams WHERE id = ?';
        $stmt = $database->connection->stmt_init();
        if(!$stmt->prepare($query)){
            echo 'Could not prepare statement:'.$database->connection->connect_errno;
        } else {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            if($stmt->affected_rows == 1) {
                $_SESSION['message'] = 'Fireteam with id: '.$id.' was deleted.';
            } else {
                echo 'Could not delete post'. $database->connection->connect_error;
            }
        }
    }
}