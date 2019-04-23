CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(128) NOT NULL,
    username varchar(128) NOT NULL,
    bio varchar(240) NOT NULL,
    email TEXT NOT NULL,
    password TEXT NOT NULL,
    created datetime NOT NULL,
    ip TEXT NULL
);