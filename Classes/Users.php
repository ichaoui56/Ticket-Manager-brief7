<?php
class Users
{
    private $conn;

    function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllUsers($conn)
    {
        $sql = "SELECT * FROM users";
        $res = $conn->query($sql);
        $userData = [];

        while ($row = $res->fetch_assoc()) {
            $userData[] = $row;
        }
        return $userData;
    }

    function getUserData($email)
    {
        $sql = "SELECT * FROM users WHERE useremail=?";
        $stmt = mysqli_stmt_init($this->conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $error = mysqli_stmt_error($stmt);
        return (mysqli_fetch_assoc($res));

    }



    function login($email, $password)
    {
        $row = $this->getUserData($email);
        if ($row) {
            if (password_verify($password, $row["Password"])) {
                $_SESSION["log"] = true;
                $_SESSION["user_id"] = $row["user_id"];
                $_SESSION["userpicture"] = $row["userpicture"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["email"] = $row["useremail"];
            } else {
                throw new Exception("password_is_not_correct");
                return false;
            }
        } else {
            throw new Exception($row["useremail"]);
            return false;
        }
        return true;
    }

    function register($username, $email, $password, $picture)
    {
        $row = $this->getUserData($email);
        if (!$row) {
            $sql = "INSERT INTO users (username, useremail, Password, userpicture) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($this->conn);
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $password, $picture);
            mysqli_stmt_execute($stmt);
        } else {
            throw new Exception("user_exists");
            return false;
        }
        return true;
    }

    function logout()
    {
        session_destroy();
    }
}
