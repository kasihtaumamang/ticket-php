<?php
// api/check-ticket.php

// Koneksi ke database (Anggap MySQL, ubah sesuai dengan database Anda)
$mysqli = new mysqli("localhost", "username", "password", "database");

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error . "\n");
}

// Dapatkan parameter
$event_id = $_GET['event_id'];
$ticket_code = $_GET['ticket_code'];

// Query database untuk memeriksa status tiket
$result = $mysqli->query("SELECT ticket_code, status FROM tickets WHERE event_id = '$event_id' AND ticket_code = '$ticket_code'");

// Periksa hasil query
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

// Tutup koneksi database
$mysqli->close();

// Keluarkan respons JSON
echo json_encode($response);
