drop table if exists classes;

create table classes(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	prefix varchar(8),
	num varchar(3),
	title varchar(32),
	description varchar(512),
	prerequisites varchar(255),
	department varchar(255)
)
