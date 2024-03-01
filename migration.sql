-- Create Table
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    ticket_code VARCHAR(255) NOT NULL,
    status VARCHAR(255) DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert Dummy Data
INSERT INTO tickets (event_id, ticket_code) VALUES
(1, 'LCS01ABC123'),
(1, 'LCS01XYZ789');
