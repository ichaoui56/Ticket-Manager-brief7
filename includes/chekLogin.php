<?php
if (empty($_SESSION["user_id"])) {
    header('Location: http://localhost/IlyasChaoui-Ticket-Manager/pages/Authentification.php');
}
