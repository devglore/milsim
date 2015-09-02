<?php
/**
 * Created by PhpStorm.
 * User: marcus
 * Date: 2015-08-10
 * Time: 15:28
 */

class operation {
    public $id, $opTitle, $opDesc, $imgUrl;

    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }

    //både create och update är rätt identiska, create skickar inte med något id utan det skapar databasen automatiskt
    public function create() {
        global $database;
        $query = 'INSERT INTO operations (id, opTitle, opDesc, imgUrl) VALUES (?, ?, ?, ?)';
        $stmt = $database->connection->stmt_init();
        if(!$stmt->prepare($query)) {
            echo 'Det gick inte att förbereda statement.';
        } else {
            $stmt->bind_param('isss', $this->id, $this->opTitle, $this->opDesc, $this->imgUrl);
            $stmt->execute();
            if($stmt->affected_rows == 1) {
                $this->id = $stmt->insert_id;
                $_SESSION['message'] = 'Operation: ' . $this->id . ' have been created.';
                $_SESSION['opID_justCreated'] = $this->id;
            } else {
                echo 'Something went wrong: ' .$database->connection->error;
            }
        }
    }

    public function update() {
        global $database;
        $query = 'UPDATE operations SET opTitle = ?, opDesc = ?, imgUrl = ? WHERE id = ?';
        $stmt = $database->connection->stmt_init();
        if(!$stmt->prepare($query)) {
            echo 'Det gick inte att förbereda statement.';
        } else {
            $stmt->bind_param('sssi', $this->opTitle, $this->opDesc, $this->imgUrl, $this->id);
            $stmt->execute();
            if($stmt->affected_rows == 1) {
                $_SESSION['message'] = 'Operation: ' . $this->id . ' have been updated.';
            } else {
                echo 'Something went wrong: ' .$database->connection->error;
            }
        }
    }

    public static function delete($id) {
        global $database;
        $query = 'DELETE FROM operations WHERE id = ?';
        $stmt = $database->connection->stmt_init();
        if(!$stmt->prepare($query)){
            echo 'Could not prepare statement:'.$database->connection->connect_errno;
        } else {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            if($stmt->affected_rows == 1) {
                $_SESSION['message'] = 'Operation with id: '.$id.' was deleted.';
            } else {
                echo 'Could not delete post'. $database->connection->connect_error;
            }
        }
    }

    public static function getOP($id) {
        global $database;
        $query = 'SELECT * FROM operations WHERE id = ?';
        $stmt = $database->connection->stmt_init();
        if(!$stmt->prepare($query)){
            echo 'Could not prepare statement:'.$database->connection->connect_errno;
        } else {
            $stmt->bind_param('s', $id);
            $stmt->execute();
                $result = $stmt->get_result();
                $result = $result->fetch_assoc();
                return $result;
        }
    }
}