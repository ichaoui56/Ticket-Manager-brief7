<?php

include '../Classes/Tickets.php';
include_once '../config/config.php';


if(isset($_POST["submit"])) {
    $ticketObj = new Ticket($conn);
    $ticketDetails = $ticketObj->getTicketDetails($conn);
    $ticket_id = $ticketDetails[0]['ticket_id'];
    $DltTicket = $ticketObj->deleteTicket($ticket_id);

    header('Location: http://localhost/IlyasChaoui-Ticket-Manager/index.php?deleted=true');


}



?>