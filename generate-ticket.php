<?php
// generate-ticket.php

// Cek argumen baris perintah
if ($argc !== 3) {
    die("Penggunaan: php generate-ticket.php {event_id} {total_ticket}\n");
}

// Dapatkan event_id dan total_ticket dari argumen baris perintah
$event_id = $argv[1];
$total_tickets = $argv[2];

// Koneksi ke database (Anggap MySQL, ubah sesuai dengan database Anda)
$mysqli = new mysqli("localhost", "username", "password", "database");

// Periksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error . "\n");
}

// Generate dan masukkan tiket ke dalam database
for ($i = 0; $i < $total_tickets; $i++) {
    $ticket_code = 'LCS' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 7);
    $status = 'available';

    // Masukkan tiket ke dalam database
    $mysqli->query("INSERT INTO tickets (event_id, ticket_code, status) VALUES ('$event_id', '$ticket_code', '$status')");
}

// Tutup koneksi database
$mysqli->close();

echo "Tiket berhasil dibuat.\n";
