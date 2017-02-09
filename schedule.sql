drop table if exists schedule;

create table schedule (
	eventID int auto_increment primary key not null,
	classID int,
	dayOfWeek char,
	startTime time,
	endTime time,
	instructor varchar(32),
	roomCode varchar(8),
	studentLimit int

)
