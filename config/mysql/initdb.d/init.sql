USE myapp_db;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    grade VARCHAR(6) NOT NULL,
    faculty VARCHAR(100) NOT NULL,
    department VARCHAR(100) NOT NULL,
    comment TEXT,
    photo VARCHAR(255),
    team VARCHAR(20)
) CHARSET=utf8;
