-- sourcesテーブルを作成
CREATE TABLE IF NOT EXISTS sources (
    contact_id INT NOT NULL,
    source VARCHAR(100) NOT NULL,
    FOREIGN KEY (contact_id) REFERENCES contacts(id) ON DELETE CASCADE
);
