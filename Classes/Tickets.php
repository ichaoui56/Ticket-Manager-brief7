<?php

class Ticket
{
    private $conn;
    private $ticket_id;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function createTicket($subject, $description, $assignment, $status, $priority, $date, $user_id)
    {
        $subject = mysqli_real_escape_string($this->conn, $subject);
        $description = mysqli_real_escape_string($this->conn, $description);
        $status = mysqli_real_escape_string($this->conn, $status);
        $priority = mysqli_real_escape_string($this->conn, $priority);

        $sql = "INSERT INTO tickets (subject, description, status, priority, date, user_id) 
                VALUES ('$subject', '$description', '$status', '$priority', '$date', '$user_id')";

        if ($this->conn->query($sql)) {
            return mysqli_insert_id($this->conn);
        } else {
            echo $this->conn->error;
            return false;
        }
    }

    function getTicketDetails($conn)
    {
        $sql = "SELECT * FROM tickets WHERE is_deleted = 0";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $error = mysqli_stmt_error($stmt);
        while ($row = mysqli_fetch_assoc($res)) {
            $ticketData[] = $row;
        }
        return @$ticketData;

    }

    function getTicketById($conn, $user_id)
    {
        $sql = "SELECT * FROM tickets WHERE user_id = $user_id AND is_deleted = 0 ";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $error = mysqli_stmt_error($stmt);
        while ($row = mysqli_fetch_assoc($res)) {
            $users[] = $row;
        }
        return @$users;
    }

    function getAllTags($conn)
    {
        $sql = "SELECT tags.*, tag_ticket.ticket_id  
        FROM tag_ticket
        JOIN tags ON tag_ticket.tag_id=tags.tag_id";
        $res = $conn->query($sql);
        $tagData = [];
        while ($row = $res->fetch_assoc()) {
            $tagData[] = $row;
        }
        echo $conn->error;
        return $tagData;
    }

    function getAllArticleTags($conn)
    {
        $sql = "SELECT tags.* FROM tag_ticket
        JOIN tags ON tag_ticket.tag_id=tags.tag_id 
        WHERE ticket_id='$this->ticket_id'";
        $res = $conn->query($sql);
        $tagsData = [];
        while ($row = $res->fetch_assoc()) {
            $tagData[] = $row;
        }
        echo $conn->error;
        return $tagsData;
    }

    public function getAllassignedAgent($conn, $ticketId)
    {

        $sql = "SELECT users.*, assignment.ticket_id
        FROM assignment 
        JOIN users ON assignment.user_id = users.user_id 
        WHERE ticket_id='$ticketId'";
        $res = $conn->query($sql);
        $AgentsData = [];
        while ($row = $res->fetch_assoc()) {
            $AgentsData[] = $row;
        }
        echo $conn->error;
        return $AgentsData;
    }



    public function getTicketId()
    {
        return $this->ticket_id;
    }


    function assign($ticket_id, $users_id)
    {
        $sql = "INSERT INTO assignment (ticket_id , user_id)
                VALUES ('$ticket_id' ,'$users_id')";

        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTicket($ticket_id)
    {
        $sql = "UPDATE tickets SET is_deleted = 1 WHERE ticket_id = $ticket_id";

        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    public function editTicket($ticket_id, $subject, $description, $assignment, $status, $priority, $date, $tag_id)
    {
        $subject = mysqli_real_escape_string($this->conn, $subject);
        $description = mysqli_real_escape_string($this->conn, $description);
        $status = mysqli_real_escape_string($this->conn, $status);
        $priority = mysqli_real_escape_string($this->conn, $priority);

        $sql = "UPDATE tickets 
                SET subject = '$subject', description = '$description', assignment = '$assignment', 
                    status = '$status', priority = '$priority', date = '$date', tag_id = '$tag_id'
                WHERE ticket_id = $ticket_id";

        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
}
