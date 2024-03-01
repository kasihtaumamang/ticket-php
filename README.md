# ticket-php
Mini Apps PHP Ticket Management System

## Migrasi
- Jalankan `migration.sql` untuk membuat tabel di MySQL/PgSQL.

## CLI Pembuatan Tiket
1. Jalankan perintah berikut untuk membuat tiket:
~bash
php generate-ticket.php {event_id} {total_ticket}

2. Jalankan perintah berikut untuk api check tiket:
~bash
php api/check-ticket.php {event_id} {total_ticket}

3. Jalankan perintah berikut untuk api update tiket:
~bash
php api/update-ticket.php {event_id} {total_ticket} {status}


/**
*
    * @author Fahri Ardiansyah
    * @copyright (c) 2024
    * @license Fahri Ardiansyah

*
*/
