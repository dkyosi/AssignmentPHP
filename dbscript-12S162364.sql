    CREATE DATABASE facultydatabase;

 	CREATE USER 'abdullah'@'localhost' IDENTIFIED BY  '12S162364';
 	CREATE USER 'abdullah'@'127.0.0.1' IDENTIFIED BY  '12S162364';

    GRANT ALL PRIVILEGES ON * . * TO 'abdullah'@'localhost';
    GRANT ALL PRIVILEGES ON * . * TO 'abdullah'@'127.0.0.1';

 	
 	FLUSH PRIVILEGES;


	USE facultydatabase;

	CREATE TABLE faculty(
		id INT primary key auto_increment,
		email VARCHAR(20) unique not null,
		password VARCHAR(100) not null,
		gender VARCHAR(15) not null,
		picture VARCHAR(15) not null
		);

	CREATE TABLE courses(
		id INT primary key auto_increment,
		coursecode VARCHAR(20) unique not null,
		coursename VARCHAR(20) not null,
		regfee INT not null
		);