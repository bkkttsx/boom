
CREATE DATABASE IF NOT EXISTS pdfvault;
USE pdfvault;

CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(100),
password VARCHAR(255)
);

CREATE TABLE files (
id INT AUTO_INCREMENT PRIMARY KEY,
filename VARCHAR(255),
project_name VARCHAR(255),
sender VARCHAR(255),
detail TEXT,
file_path TEXT,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users(username,password)
VALUES('admin',MD5('1234'));
