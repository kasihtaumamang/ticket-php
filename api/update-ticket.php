<?php
// api/update-ticket.php

// Koneksi ke database (Anggap MySQL, ubah sesuai dengan database Anda)
$mysqli = new mysqli("localhost", "username", "password", "database");

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error . "\n");
}

// Dapatkan parameter
$event_id = $_POST['event_id'];
$ticket_code = $_POST['ticket_code'];
$status = $_POST['status'];

// Perbarui status tiket di database
$mysqli->query("UPDATE tickets SET status = '$status' WHERE event_id = '$event_id' AND ticket_code = '$ticket_code'");

// Dapatkan waktu pembaruan
$updated_at = time();

// Tutup koneksi database
$mysqli->close();

// Output respons JSON
$output = [
    'ticket_code' => $ticket_code,
    'status' => $status,
    'updated_at' => $updated_at
];
echo json_encode($output);
