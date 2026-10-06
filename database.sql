CREATE DATABASE campusconnect;

USE campusconnect;

CREATE TABLE problems (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    priority VARCHAR(20) NOT NULL,
    problem_title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    solution TEXT,
    status VARCHAR(30) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);