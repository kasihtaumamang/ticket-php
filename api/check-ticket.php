<?php
// api/check-ticket.php

// Koneksi ke database (Anggap MySQL, ubah sesuai dengan database Anda)
$servername = "localhost";
$username = "root";
$password = "ahhmantap";
$database = "db_ticket";

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error . "\n");
} else {
    // Inisialisasi respons
    $response = [];

    // Dapatkan parameter
    $event_id = $argv[1] ?? null;
    $ticket_code = $argv[2] ?? null;

    if ($event_id && $ticket_code) {
        // Query database untuk memeriksa status tiket
        $query = "SELECT ticket_code, status FROM tickets WHERE event_id = ? AND ticket_code = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $event_id, $ticket_code);
        $stmt->execute();
        $result = $stmt->get_result();

        // Periksa hasil query
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $response = [
                    'ticket_code' => $row['ticket_code'],
                    'status' => $row['status']
                ];
            } else {
                $response = [
                    'ticket_code' => $ticket_code,
                    'status' => 'Not Found!'
                ];
            }
        } else {
            $response['error'] = "Error executing query: " . $conn->error;
        }

        $stmt->close();
    } else {
        $response['error'] = "Invalid parameters. Usage: api/check-ticket.php?event_id={event_id}&ticket_code={ticket_code}";
    }

    // Tutup koneksi database (bisa diletakkan di akhir skrip)
    $conn->close();
}

// Keluarkan respons JSON
echo json_encode($response);
