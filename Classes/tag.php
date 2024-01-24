<?php

class tag
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllTags()
    {
        $sql = "SELECT * FROM tags";
        $res = $this->conn->query($sql);
        $tagData = [];

        while ($row = $res->fetch_assoc()) {
            $tagData[] = $row;
        }
        return $tagData;
    }

    function insertTags($ticket_id, $tags_id)
    {
        $sql = "INSERT INTO tag_ticket (ticket_id, tag_id)
                VALUES ('$ticket_id', '$tags_id')";

        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
