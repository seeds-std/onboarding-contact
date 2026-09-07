-- contactsテーブルを作成
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    furigana VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    zip_code VARCHAR(10) NOT NULL,
    pref VARCHAR(20) NOT NULL,
    juusyo VARCHAR(100) NOT NULL,
    others VARCHAR(255) NOT NULL,
    buiding VARCHAR(255),
    message TEXT NOT NULL,
    interest VARCHAR(255) NOT NULL,
    created_at DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;