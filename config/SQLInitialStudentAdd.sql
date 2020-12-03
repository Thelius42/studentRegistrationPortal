USE registration;
--insert data into students table
INSERT INTO students (studentID, lastName, firstName)
VALUES
(1234, 'Smith', 'Jane'),
(2546, 'Donnely', 'Casey'),
(7518, 'Crane', 'Ichabod'),
(1313, 'Munster', 'Herman');
GO

USE registration;
--insert data into classes table
INSERT INTO classes (classID, className, classDescription, timeOfClass)
VALUES
('CS499', 'Computer Science Capstone', 'Class to show final proficiency in Computer Science knowledge', 'M W 8-9:30'),
('MA160', 'Calculus 1', 'Intro to differential calculus', 'T Th 11-12:30'),
('CS165', 'Web Coding with JavaScript', 'A class that would have been helpful in this project', 'M W 10-11:30')
;


SELECT registration.class_student.classID, registration.classes.className, registration.classes.classDescription, registration.classes.timeOfClass
FROM registration.classes
INNER JOIN registration.class_student ON registration.class_student.classID = registration.classes.classID
WHERE registration.class_student.studentID = '1313'