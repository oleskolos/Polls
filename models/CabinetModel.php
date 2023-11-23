<?php

class CabinetModel extends Model {

    public function getPolls() {
        $sql = "SELECT
                    polls.id as id,
                    polls.name,
                    polls.options,
                    poll_status.name as status
            FROM polls
            INNER JOIN poll_status ON polls.status = poll_status.id
        ";

        $result = array();
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }

        return $result;
    }

    public function getUsers() {
        $sql = "SELECT
                    users.id as id,
                    users.login,
                    users.email,
                    users.password
                FROM users
        ";

        $result = array();
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[$row['id']] = $row;
        }

        return $result;
    }

    public function getPollById($id) {
        $result = array();
    
        $sql = "SELECT 
                p.id AS poll_id,
                p.name AS poll_name,
                GROUP_CONCAT(po.name) AS option_names_names,
                GROUP_CONCAT(po.votes) AS option_names_votes,
                p.options,
                ps.name AS status_name
            FROM 
                polls p
            JOIN 
                poll_options po ON p.id = po.poll_id
            JOIN 
                poll_status ps ON p.status = ps.id
            WHERE 
                p.id = :id
            GROUP BY
                p.id, p.name, p.options, ps.name";      
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();            
    
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $optionNames = array();
            $namesArray = explode(',', $row['option_names_names']);
            $votesArray = explode(',', $row['option_names_votes']);
    
            foreach ($namesArray as $key => $name) {
                $optionNames[] = array(
                    'name' => $name,
                    'votes' => $votesArray[$key]
                );
            }
    
            $row['option_names'] = $optionNames;
            unset($row['option_names_names']);
            unset($row['option_names_votes']);
    
            $result[$row['poll_id']] = $row;
            // $result[] = $row;
        }

        return $result;
    }
    


public function updatePoll($id, $name, $statusText, $options) { //потрібне допрацювання, не працює оновлення назви опцій

    $sqlStatus = "SELECT id FROM poll_status WHERE name = :statusText";
    $stmtStatus = $this->db->prepare($sqlStatus);
    $stmtStatus->bindValue(":statusText", $statusText, PDO::PARAM_STR);
    $stmtStatus->execute();
    $statusRow = $stmtStatus->fetch(PDO::FETCH_ASSOC);

    if (!$statusRow) {
        
        return;
    }

    $status = $statusRow['id'];

    // Оновлення таблиці polls
    $sqlPolls = "UPDATE polls
                SET name = :name,
                status = :status
                WHERE id = :id";

    $stmtPolls = $this->db->prepare($sqlPolls);
    $stmtPolls->bindValue(":id", $id, PDO::PARAM_INT);
    $stmtPolls->bindValue(":name", $name, PDO::PARAM_STR);
    $stmtPolls->bindValue(":status", $status, PDO::PARAM_INT);

    $stmtPolls->execute();

    foreach ($options as $option) {
        $sqlOptions = "UPDATE poll_options
                        SET name = :nameNew,
                            votes = :votes
                        WHERE poll_id = :poll_id AND name = :nameNew";

        $stmtOptions = $this->db->prepare($sqlOptions);
        $stmtOptions->bindValue(":poll_id", $id, PDO::PARAM_INT);
        // $stmtOptions->bindValue(":old_name", $option['name'], PDO::PARAM_STR);
        $stmtOptions->bindValue(":nameNew", $option['name'], PDO::PARAM_STR);
        $stmtOptions->bindValue(":votes", $option['votes'], PDO::PARAM_INT);
        $stmtOptions->execute();
        error_log(print_r($stmt->errorInfo(), true));
    }
}



public function deletePoll($id) {
    // Починаємо транзакцію
    $this->db->beginTransaction();

    try {
        // Видаляємо дані з таблиці poll_options за відповідним poll_id
        $sqlOptions = "DELETE FROM poll_options WHERE poll_id = :id";
        $stmtOptions = $this->db->prepare($sqlOptions);
        $stmtOptions->bindValue(":id", $id, PDO::PARAM_INT);
        $stmtOptions->execute();

        // Видаляємо дані з таблиці polls за id
        $sqlPolls = "DELETE FROM polls WHERE id = :id";
        $stmtPolls = $this->db->prepare($sqlPolls);
        $stmtPolls->bindValue(":id", $id, PDO::PARAM_INT);
        $stmtPolls->execute();

        // Підтверджуємо транзакцію
        $this->db->commit();

        return true;
    } catch (PDOException $e) {
        // В разі помилки відкочуємо транзакцію
        $this->db->rollBack();
        return false;
    }
}


}