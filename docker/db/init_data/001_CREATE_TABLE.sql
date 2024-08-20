-- contactsテーブルを作成
CREATE TABLE IF NOT EXISTS contacts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fullname varchar(255),
        kana varchar(255),
        email varchar(255),
        gender char(2),
        zip varchar(10),
        prefs varchar(10),
        municipalities varchar(30),
        furtherDivisions varchar(30),
        building varchar(30),
        comment TEXT,
        discoveryReason varchar(255)
    ) COLLATE = utf8mb4_unicode_ci;
