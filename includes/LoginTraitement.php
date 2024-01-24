<?php
include '../Classes/Users.php';
include '../config/config.php';

if (isset($_POST["submit"])) {
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    try {
        $user = new Users($conn);
        $LoginResult = $user->login($email, $password);
        header("Location: ../index.php?login=success");
        exit();
    } catch (Exception $e) {
        $errorMessage = $e->getMessage();
        header("Location: ../pages/Authentification.php?login=error&message=$errorMessage");
        exit();
    }
}
