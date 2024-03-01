<?php
$servername = "localhost";
$username = "root";
$password = "ahhmantap";
$database = "db_ticket";

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
} else {
    function generateTicketCode($event_id)
    {
        return 'LCS' . $event_id . generateRandomAlphaNumeric(7);
    }

    function generateRandomAlphaNumeric($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    function insertTickets($event_id, $total_tickets)
    {
        global $conn;

        for ($i = 0; $i < $total_tickets; $i++) {
            $ticket_code = generateTicketCode($event_id);
            $sql = "INSERT INTO tickets (event_id, ticket_code) VALUES ($event_id, '$ticket_code')";

            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $event_id = $argv[1] ?? null;
    $total_tickets = $argv[2] ?? null;

    if ($event_id && $total_tickets) {
        insertTickets($event_id, $total_tickets);
        echo "Tickets generated successfully.\n";
    } else {
        echo "Invalid command. Usage: php generate-ticket.php {event_id} {total_tickets}\n";
    }
}

$conn->close();
