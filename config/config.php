<?php
session_start();
$url = "http://localhost/IlyasChaoui-Ticket-Manager/";

class Database
{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_password = "";
    private $db_name = "Ticket";
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);
        $sql = "CREATE DATABASE IF NOT EXISTS Ticket ";
        $this->conn->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS users (
            user_id INT PRIMARY KEY AUTO_INCREMENT, 
            username TEXT, 
            useremail TEXT UNIQUE, 
            Password TEXT, 
            userpicture text  )";
        $this->conn->query($sql);
        if ($this->conn->query($sql)) {
        }


        $sql = "CREATE TABLE IF NOT EXISTS comments (
            comment_id INT PRIMARY KEY AUTO_INCREMENT, 
            comment TEXT, 
            user_id INT,
            FOREIGN KEY (user_id) REFERENCES users(user_id))";
        $this->conn->query($sql);
        if ($this->conn->query($sql)) {
        }

        

        $sql = "CREATE TABLE IF NOT EXISTS tags (
            tag_id INT PRIMARY KEY AUTO_INCREMENT, 
            tag TEXT UNIQUE)";
        $this->conn->query($sql);
        if ($this->conn->query($sql)) {
        }
        $sql = "CREATE TABLE IF NOT EXISTS tickets (
            ticket_id INT PRIMARY KEY AUTO_INCREMENT, 
            subject TEXT, 
            description TEXT, 
            status TEXT,
            priority text, 
            date INT, 
            is_deleted TINYINT(1) DEFAULT 0,
            user_id INT, 
            FOREIGN KEY (user_id) REFERENCES users(user_id))";

        $sql = "CREATE TABLE IF NOT EXISTS tag_ticket (
            ticket_id INT, 
            tag_id INT,
            FOREIGN KEY (ticket_id) REFERENCES tickets(ticket_id),
            FOREIGN KEY (tag_id) REFERENCES tags(tag_id))";
        $this->conn->query($sql);

        $sql = "CREATE TABLE IF NOT EXISTS assignment (
            ticket_id INT, 
            user_id INT,
            FOREIGN KEY (ticket_id) REFERENCES tickets(ticket_id),
            FOREIGN KEY (user_id) REFERENCES users(user_id))";
        $this->conn->query($sql);

        $sql = "INSERT INTO Tags (tag) VALUES 
            ('Complaint'), 
            ('feedback'), 
            ('request'), 
            ('support'), 
            ('sales')
            ON DUPLICATE KEY UPDATE tag = VALUES(tag)";
        $this->conn->query($sql);
        if ($this->conn->query($sql)) {
        }
    }

    function connection()
    {
        return ($this->conn);
    }
}
$db = new Database;
$conn = $db->connection();
