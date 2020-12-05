
CREATE DATABASE registration;
-- Create students table
CREATE TABLE students (
	studentID int NOT NULL,
	lastName varchar(50) NOT NULL,
	firstName varchar(50) NOT NULL,
	PRIMARY KEY (studentID)
);
-- Creating Classes table
CREATE TABLE classes (
	classID varchar(5) NOT NULL,
	className varchar(50) NOT NULL,
	classDescription varchar(255),
	timeOfClass varchar (100) NOT NULL,
	PRIMARY KEY (classID)
);

CREATE TABLE class_student (
	regID int AUTO_INCREMENT,
	studentID int NOT NULL,
	classID varchar(5) NOT NULL,
	PRIMARY KEY (regID)
	CONSTRAINT Uniq_reg UNIQUE (studentID, classID)
);
	

	
