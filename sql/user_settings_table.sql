CREATE TABLE user_settings (
    id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
    user_id int NOT NULL,
    image TEXT NULL,
    location TEXT NOT NULL,
    language TEXT NOT NULL
);