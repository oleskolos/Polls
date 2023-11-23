<?php

class CreatePollModel extends Model {
    public function addPoll($name, $options, $status, $optionNames, $optionVotes) {
        error_log("Received data in addPoll: " . print_r([$name, $options, $status, $optionNames, $optionVotes], true));

        $sql = "INSERT INTO polls (name, options, status) VALUES (:name, :options, :status)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":options", $options, PDO::PARAM_INT);
        $stmt->bindValue(":status", $status, PDO::PARAM_INT);
        $stmt->execute();

    
        $pollId = $this->db->lastInsertId();
    
        foreach ($optionNames as $key => $name) {
            $votes = $optionVotes[$key];
            error_log("Inserting option data: " . print_r([$pollId, $name, $votes], true));

            $this->addPollOption($pollId, $name, $votes);
        }
    
        return true;
    } 
    
    private function addPollOption($pollId, $name, $votes) {

        $sql = "INSERT INTO poll_options (poll_id, name, votes) VALUES (:pollId, :name, :votes)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":pollId", $pollId, PDO::PARAM_INT);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":votes", $votes, PDO::PARAM_INT);
        $stmt->execute();
    } 
}