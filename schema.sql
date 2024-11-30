CREATE TABLE Surgeon (
    Surgeon_id INT PRIMARY KEY AUTO_INCREMENT,
    Surgeon_name VARCHAR(50) NOT NULL,
    experience_level VARCHAR(20),
    Specialization Varchar(50)
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE ActivityLogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    action_type VARCHAR(50) NOT NULL,
    action_details TEXT NOT NULL,
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP
);