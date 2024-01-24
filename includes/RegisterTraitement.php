<?php
include '../Classes/Users.php';
include '../config/config.php';

if (isset($_POST["submit"])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


    $targetDir = "../src/pictures/";
    $fileName = basename($_FILES["picture"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileType, $allowTypes)) {

        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $targetFilePath)) {
            $user = new users($conn);
            $registrationResult = $user->register($username, $email, $hashedPassword, $targetFilePath);
            header('Location: http://localhost/IlyasChaoui-Ticket-Manager/pages/Authentification.php');
        } else {
            echo "Registration failed. Please try again.";
        }
    } else {
        echo "Picture not uploaded. Please choose a picture.";
    }
}
