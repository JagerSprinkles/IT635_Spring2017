DROP TABLE if exists users;
create table users (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(16),
	displayName VARCHAR(255),
	password VARCHAR(255),
	permissions VARCHAR(255)


);
