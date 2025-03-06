USE myapp_db;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20),
    grade VARCHAR(6),
    faculty VARCHAR(100),
    department VARCHAR(100),
    comment TEXT,
    photo VARCHAR(255),
    team VARCHAR(20)
) CHARSET=utf8;
