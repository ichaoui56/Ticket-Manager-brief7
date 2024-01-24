<?php
session_start();
unset($_SESSION["user_id"]);
session_destroy();
if (empty($_SESSION["user_id"])) {
    header('Location: ../pages/Authentification.php');
}
