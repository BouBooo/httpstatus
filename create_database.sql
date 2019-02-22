CREATE DATABASE IF NOT EXISTS nicolas_lecossec;
use nicolas_lecossec;


CREATE TABLE IF NOT EXISTS admins
(
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    api_key VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS sites
(
    id INT NOT NULL AUTO_INCREMENT,
    url VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);


CREATE TABLE IF NOT EXISTS status
(
    id INT NOT NULL AUTO_INCREMENT,
    site_id INT NOT NULL,
    code INT NOT NULL,
    date_report DATETIME NOT NULL,
    PRIMARY KEY (id)
);


INSERT INTO sites (name, url) VALUES ('Facebook', 'https://facebook.com');
INSERT INTO sites (name, url) VALUES ('Youtube', 'https://youtube.com');
INSERT INTO sites (name, url) VALUES ('Florent', 'http://florentnicolas.com');
INSERT INTO sites (name, url) VALUES ('Github', 'https://github.com');

INSERT INTO admins (email, password, api_key) VALUES ('deschaussettes@yopmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'abcdefghjaimelesapis');