-- contactsテールブルを作成
CREATE TABLE IF NOT EXISTS contacts (
    -- 最後の行にカンマがあるとエラーになる
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    kana VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    gender TINYINT NOT NULL,
    zip_code VARCHAR(7) NOT NULL,
    prefecture int NOT NULL,
    address1 VARCHAR(200) NOT NULL,
    address2 VARCHAR(200) NOT NULL,
    building_name VARCHAR(200),
    contact VARCHAR(1000) NOT NULL
);
