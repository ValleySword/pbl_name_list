USE myapp_db;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    grade VARCHAR(10) NOT NULL,
    faculty VARCHAR(100) NOT NULL,
    comment TEXT, -- 後で文字数を制限する
    photo VARCHAR(255),
    team VARCHAR(20)
) CHARSET=utf8;

-- 文字化けするので追加しない
-- INSERT INTO users (name, grade, faculty, comment, photo, team)
-- VALUES 
-- ('山田太郎', '1年生', '経営学部', '元気な学生です', 'images/yamada.jpg', '4グループ'),
-- ('佐藤花子', '2年生', '現代社会学部情報専攻', '活発な性格です', 'images/sato.jpg', '5グループ');