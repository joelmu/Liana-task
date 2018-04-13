GRANT ALL PRIVILEGES ON *.* TO 'taskuser'@'localhost' IDENTIFIED BY 'nhzh1SWNSKvFZ8A5';

CREATE TABLE list (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
email VARCHAR(50),
activity TINYINT(1) DEFAULT '0'
);

INSERT INTO list ( email ) VALUES ( "test@test.com" );

CREATE TABLE admins (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50) NOT NULL,
code VARCHAR(255) NOT NULL
);

INSERT INTO admins ( username, code ) VALUES ( "admin", "$2y$10$XGOonxBe/zjvp0f4LDVaheG.YgoYz69riYIiyvoc5Ce6/HJWcdS6W" );