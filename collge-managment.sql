CREATE TABLE Students(
    rollNo INT(5) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    name VARCHAR (55),
    email VARCHAR(55),
    phone INT(10),
    password VARCHAR(55),
    dNo INT(2)
);

CREATE TABLE Course(
    cId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    cName VARCHAR(55),
    credit INT(1),
    fId INT
);

CREATE TABLE Faculty(
    fId INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    fName VARCHAR(55),
    fEmail VARCHAR(55),
    dNo INT(2)
);

CREATE TABLE Department(
    dNo INT(2) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    dName VARCHAR(30)
);

CREATE TABLE Enrolled(
    date datetime,
    rollNo INT(5),
    cId INT
);

CREATE TABLE Exam(rollNo INT(5), cId INT, it1 INT(2), it2 INT(2));

ALTER TABLE
    Students
ADD
    FOREIGN KEY (dNo) REFERENCES Department(dNo);

ALTER TABLE
    Course
ADD
    FOREIGN KEY (fId) REFERENCES Faculty(fId);

ALTER TABLE
    Faculty
ADD
    FOREIGN KEY (dNo) REFERENCES Department(dNo);

ALTER TABLE
    Enrolled
ADD
    FOREIGN KEY (rollNo) REFERENCES Students(rollNo);

ALTER TABLE
    Enrolled
ADD
    FOREIGN KEY (cId) REFERENCES Course(cId);