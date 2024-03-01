-- migration.sql

-- Create tickets table
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    ticket_code VARCHAR(10) NOT NULL,
    status VARCHAR(20) DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert dummy data
INSERT INTO tickets (event_id, ticket_code, status) VALUES (1, 'LCS123ABC', 'available');
INSERT INTO tickets (event_id, ticket_code, status) VALUES (1, 'LCS456DEF', 'claimed');
