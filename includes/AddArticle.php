<?php
include_once '../Classes/tag.php';
include_once '../Classes/Tickets.php';
include_once '../config/config.php';

if(isset($_POST['submit'])) {

    $subject = $_POST["subject"];
    $assignment = $_POST["username"];
    $tags = $_POST["tag"];
    $priority = $_POST["priority"];
    $status = $_POST["status"];
    $description = $_POST["description"];
    $date = date("d/m/Y");


    $ticket = new Ticket($conn);
    $ticket_id = $ticket->createTicket($subject, $description, $assignment, $status, $priority, $date, $_SESSION["user_id"]);

    $tagClass = new tag($conn);

    foreach ($assignment as $users_id) {
        $ticket->assign($ticket_id, $users_id);
    }

    foreach ($tags as $tags_id) {
        $tagClass->insertTags($ticket_id, $tags_id);
    }

    header("Location: http://localhost/IlyasChaoui-Ticket-Manager/index.php");

}       

?>

