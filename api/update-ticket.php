<?php
// api/update-ticket.php

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
    $status = $argv[3] ?? null;

    // Periksa apakah parameter diberikan
    if ($event_id && $ticket_code && $status) {
        // Query database untuk memperbarui status tiket
        $query = "UPDATE tickets SET status = ? WHERE event_id = ? AND ticket_code = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss',
            $status,
            $event_id,
            $ticket_code
        );
        $stmt->execute();

        // Periksa hasil query
        if ($stmt->affected_rows > 0
        ) {
            // Dapatkan waktu pembaruan
            $updated_at = time();

            // Output respons JSON
            $response = [
                'ticket_code' => $ticket_code,
                'status' => $status,
                'updated_at' => $updated_at
            ];
        } else {
            $response['error'] = "Ticket not found or status not updated.";
        }

        $stmt->close();
    } else {
        $response['error'] = "Invalid parameters. Usage: api/update-ticket.php {event_id} {ticket_code} {status}";
    }

    // Keluarkan respons JSON
    echo json_encode($response);
}

// Tutup kooneksi ke database
$conn->close();
