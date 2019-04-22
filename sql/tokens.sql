CREATE TABLE tokens (
    id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    uid int(11) NOT NULL,
    token varchar(120) NOT NULL,
    date datetime NOT NULL
);