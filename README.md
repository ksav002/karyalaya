# project
4th sem project
git add . 
git commit -m "1st upload"
git remote add origin https://github.com/ksav002/project.git
git push -u origin main

//database creation for project//copy paste this or use the export file
CREATE TABLE semesters (
    semester_number SMALLINT PRIMARY KEY,
    semester_value varchar(25)
);
INSERT INTO semesters (semester_number,semester_value)
VALUES
    (1, 'first_semester'),
    (2,'second_semester'),
    (3, 'third_semester'),
    (4, 'fourth_semester'),
    (5, 'fifth_semester'),
    (6, 'sixth_semester'),
    (7, 'seventh_semester'),
    (8, 'eighth_semester'),
    (9, ' for_miscellaneous_data');


CREATE TABLE batch (
    batch_year YEAR PRIMARY KEY,
    semester_number SMALLINT,
    FOREIGN KEY (semester_number) REFERENCES semesters(semester_number),
    remarks varchar(20) DEFAULT NULL
);

INSERT INTO batch (batch_year, semester_number)
VALUES
    (2020, 7),
    (2021, 5),
    (2022, 3),
    (2023, 1);

DELIMITER //

CREATE PROCEDURE UpdateSemesterForBatch(IN batchYearParam YEAR)
BEGIN
    DECLARE graduatedRemark VARCHAR(20);
    
    SET graduatedRemark = (SELECT CASE WHEN (SELECT semester_number + 1 FROM batch WHERE batch_year = batchYearParam) > 8 THEN 'graduated' ELSE NULL END);
    
    UPDATE batch
    SET semester_number = semester_number + 1,
        remarks = graduatedRemark
    WHERE batch_year = batchYearParam;
END//

DELIMITER ;

CREATE TABLE courses (
  course_code VARCHAR(10) NOT NULL PRIMARY KEY,
  course_title VARCHAR(50) DEFAULT NULL,
  credit_hours SMALLINT DEFAULT NULL,
  lecture_hours SMALLINT DEFAULT NULL,
  tutorial_hours SMALLINT DEFAULT NULL,
  lab_hours SMALLINT DEFAULT NULL,
  elective_subject BOOLEAN NOT NULL,
  semester_number SMALLINT,
  FOREIGN KEY (semester_number) REFERENCES semesters(semester_number)
);

INSERT INTO courses (course_code, course_title, credit_hours, lecture_hours, tutorial_hours, lab_hours, elective_subject, semester_number)
VALUES
('CACS101', 'Computer Fundamentals & Applications', 4, 4, NULL, 4, FALSE, 1),
('CACS105', 'Digital Logic', 3, 3, NULL, 2, FALSE, 1),
('CAEN103', 'English I', 3, 3, 1, NULL, FALSE, 1),
('CAMT104', 'Mathematics I', 3, 3, 1, 1, FALSE, 1),
('CASO102', 'Society and Technology', 3, 3, NULL, NULL, FALSE, 1);
INSERT INTO courses (course_code, course_title, credit_hours, lecture_hours, tutorial_hours, lab_hours, elective_subject, semester_number)
VALUES
('CAAC152', 'Financial Accounting', 3, 3, 1, 1, FALSE, 2),
('CACS151', 'C programming', 4, 4, 1, 3, FALSE, 2),
('CACS155', 'Microprocessor and Computer Architecture', 3, 3, 1, 2, FALSE, 2),
('CAEN153', 'English II', 3, 3, 1, NULL, FALSE, 2),
('CAMT154', 'Mathematics II', 3, 3, 1, 1, FALSE, 2);
INSERT INTO courses (course_code, course_title, credit_hours, lecture_hours, tutorial_hours, lab_hours, elective_subject, semester_number)
VALUES
('CACS201', 'Data Structure and Algorithms', 3, 3, NULL, 3, FALSE, 3),
('CACS203', 'System Analysis and Design', 3, 3, 1, NULL, FALSE, 3),
('CACS204', 'OOP in Java', 3, 3, 1, 2, FALSE, 3),
('CACS205', 'Web Technology', 3, 3, NULL, 3, FALSE, 3),
('CAST202', 'Probability and Statistics', 3, 3, 1, 1, FALSE, 3);
INSERT INTO courses (course_code, course_title, credit_hours, lecture_hours, tutorial_hours, lab_hours, elective_subject, semester_number)
VALUES
('CACS251', 'Operating System', 4, 4, NULL, 4, FALSE, 4),
('CACS252', 'Numerical Methods', 3, 3, NULL, NULL, FALSE, 4),
('CACS253', 'Software Engineering', 3, 3, 1, NULL, FALSE, 4),
('CACS254', 'Scripting Language', 3, 3, 1, 1, FALSE, 4),
('CACS255', 'Database Management System', 3, 3, NULL, 2, FALSE, 4),
('CAPJ256', 'Project I', 2, NULL, NULL, 4, FALSE, 4);
INSERT INTO courses (course_code, course_title, credit_hours, lecture_hours, tutorial_hours, lab_hours, elective_subject, semester_number)
VALUES
('CACS301', 'MIS and e-Business', 3, 3, NULL, 2, FALSE, 5),
('CACS302', 'DotNet Technology', 3, 3, NULL, 3, FALSE, 5),
('CACS303', 'Computer Networking', 3, 3, NULL, 2, FALSE, 5),
('CACS305', 'Computer Graphics and Animation', 3, 3, 1, 2, FALSE, 5),
('CAMG304', 'Introduction to Management', 3, 3, 1, NULL, FALSE, 5);
INSERT INTO courses (course_code, course_title, credit_hours, lecture_hours, tutorial_hours, lab_hours, elective_subject, semester_number)
VALUES
('CACS351', 'Mobile Programming', 3, 3, NULL, 3, FALSE, 6),
('CACS352', 'Distributed System', 3, 3, 1, NULL, FALSE, 6),
('CACS353', 'Applied Economics', 3, 3, 1, NULL, FALSE, 6),
('CACS354', 'Advanced Java Programming', 3, 3, NULL, 3, FALSE, 6),
('CACS355', 'Network Programming', 3, 3, NULL, 2, FALSE, 6),
('CAPJ356', 'Project II', 2, NULL, NULL, 4, FALSE, 6);
INSERT INTO courses (course_code, course_title, credit_hours, lecture_hours, tutorial_hours, lab_hours, elective_subject, semester_number)
VALUES
('CACS401', 'Cyber Law and Professional Ethics', 3, 3, 1, NULL, FALSE, 7),
('CACS402', 'Cloud Computing', 3, 3, NULL, 3, FALSE, 7),
('CACS404', 'Image Processing', 3, 3, NULL, NULL, TRUE, 7),
('CACS405', 'Database Administration', 3, 3, NULL, NULL, TRUE, 7),
('CACS406', 'Network Administration', 3, 3, NULL, NULL, TRUE, 7),
('CACS408', 'Advanced Dot Net Technology', 3, 3, NULL, NULL, TRUE, 7),
('CACS409', 'E-Governance', 3, 3, NULL, NULL, TRUE, 7),
('CACS410', 'Artificial Intelligence', 3, 3, NULL, NULL, TRUE, 7),
('CAIN103', 'Internship', 3, NULL, NULL, NULL, FALSE, 7);


INSERT INTO courses (course_code, course_title, credit_hours, lecture_hours, tutorial_hours, lab_hours, elective_subject, semester_number)
VALUES
('CAOR451', 'Operations Research', 3, 3, 1, NULL, FALSE, 8),
('CAPJ452', 'Project III', 6, NULL, NULL, 12, FALSE, 8),
('CACS453', 'Database Programming', 3, 3, NULL, NULL, TRUE, 8),
('CACS454', 'Geographical Information System', 3, 3, NULL, NULL, TRUE, 8),
('CACS455', 'Data Analysis and Visualization', 3, 3, NULL, NULL, TRUE, 8),
('CACS456', 'Machine Learning', 3, 3, NULL, NULL, TRUE, 8),
('CACS457', 'Multimedia System', 3, 3, NULL, NULL, TRUE, 8),
('CACS458', 'Knowledge Engineering', 3, 3, NULL, NULL, TRUE, 8),
('CACS459', 'Information Security', 3, 3, NULL, NULL, TRUE, 8),
('CACS460', 'Internet of Things', 3, 3, NULL, NULL, TRUE, 8);


CREATE TABLE `students` (
  `student_id` INT PRIMARY KEY AUTO_INCREMENT,
  `fname` VARCHAR(20) DEFAULT NULL,
  `lname` VARCHAR(20) DEFAULT NULL,
  `phone` BIGINT(20) DEFAULT NULL,
  `email` VARCHAR(40) DEFAULT NULL,
  `username` VARCHAR(8) DEFAULT NULL,
  `password` CHAR(255) DEFAULT NULL,
  `dob` DATE DEFAULT NULL,
  `age` SMALLINT GENERATED ALWAYS AS (TIMESTAMPDIFF(YEAR, `dob`, CURDATE())) VIRTUAL,
  `batch_year` YEAR(4) DEFAULT NULL,
  FOREIGN KEY (`batch_year`) REFERENCES `batch` (`batch_year`)
);

ALTER TABLE `students` AUTO_INCREMENT = 101;

INSERT INTO students (fname, lname, phone, email, username, password, dob, batch_year)
VALUES
    ('John', 'Doe', 1234567890, 'john.doe@example.com', 'johndoe', MD5('password123'), '1995-05-20', 2022),
    ('Jane', 'Smith', 9876543210, 'jane.smith@example.com', 'janesmit', MD5('secret456'), '1998-10-15', 2023),
    ('Alice', 'Johnson', 1112223333, 'alice.johnson@example.com', 'alicej', MD5('mysecurepassword'), '1997-08-28', 2023),
    ('Bob', 'Williams', 5554447777, 'bob.williams@example.com', 'bobby', MD5('bobpass321'), '1996-03-12', 2022),
    ('Emily', 'Brown', 9998887777, 'emily.brown@example.com', 'emilyb', MD5('emily1234'), '1999-12-05', 2020);


CREATE TABLE `teachers` (
  `teacher_id` INT AUTO_INCREMENT PRIMARY KEY,
  `fname` VARCHAR(20) DEFAULT NULL,
  `lname` VARCHAR(20) DEFAULT NULL,
  `phone` BIGINT(20) DEFAULT NULL,
  `email` VARCHAR(40) DEFAULT NULL,
  `username` VARCHAR(8) DEFAULT NULL,
  `password` CHAR(255) DEFAULT NULL,
  `dob` DATE DEFAULT NULL,
  `age` SMALLINT GENERATED ALWAYS AS (TIMESTAMPDIFF(YEAR, `dob`, CURDATE())) VIRTUAL,
  `active_status` BOOLEAN NOT NULL
);
ALTER TABLE `teachers` AUTO_INCREMENT = 101;

INSERT INTO teachers (fname, lname, phone, email, username, password, dob, active_status)
VALUES
    ('David', 'Garcia', 1234567890, 'david.garcia@example.com', 'daveg', MD5('password789'), '1980-06-01', true),
    ('Jessica', 'Rodriguez', 9876543210, 'jessica.rodriguez@example.com', 'jessrodr', MD5('secret567'), '1985-11-17', false),
    ('Daniel', 'Martinez', 1112223333, 'daniel.martinez@example.com', 'danmart', MD5('danpassword'), '1987-02-09', true),
    ('Michelle', 'Lopez', 5554447777, 'michelle.lopez@example.com', 'michllop', MD5('michelle123'), '1989-09-24', false),
    ('Kevin', 'Hernandez', 9998887777, 'kevin.hernandez@example.com', 'kevhern', MD5('kevin1234'), '1992-05-08', true);

CREATE TABLE teacher_courses (
  teacher_courses_id INT PRIMARY KEY AUTO_INCREMENT,
  teacher_id INT NOT NULL,
  course_code VARCHAR(10) NOT NULL,
  FOREIGN KEY (teacher_id) REFERENCES teachers(teacher_id),
  FOREIGN KEY (course_code) REFERENCES courses(course_code),
  `active_status` BOOLEAN NOT NULL
);

INSERT INTO teacher_courses(teacher_id,course_code,active_status)
VALUES 
('101','CACS205',TRUE),
('101','CACS254',TRUE),
('102','CAST202',TRUE),
('102','CACS252',TRUE),
('103','CACS251',TRUE),
('104','CACS253',TRUE),
('104','CACS203',FALSE),
('105','CACS255',TRUE)

CREATE TABLE assignments (
  assignment_id INT PRIMARY KEY AUTO_INCREMENT,
  teacher_courses_id int NOT NULL,
  assignment_question TEXT NOT NULL,
  deadline DATE,
  FOREIGN KEY (teacher_courses_id) REFERENCES teacher_courses(teacher_courses_id)
) ;
ALTER TABLE assignments AUTO_INCREMENT = 101;

INSERT INTO assignments (teacher_courses_id, assignment_question, deadline)
VALUES 
(1, 'What is html?', '2024-03-15'),
(2, 'Explain the concept of javascript.', '2024-03-20'),
(3, 'What is probability?', '2024-03-22'),
(4, 'Write the chapters of Numerical Method.', '2024-03-25');

CREATE TABLE submission (
    submission_id INT AUTO_INCREMENT PRIMARY KEY,
    assignment_id INT NOT NULL,
    student_id INT NOT NULL,
    teacher_courses_id int NOT NULL,
    uploaded_datetime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (assignment_id) REFERENCES assignments(assignment_id),
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (teacher_courses_id) REFERENCES teacher_courses(teacher_courses_id)
);
ALTER TABLE submission AUTO_INCREMENT = 101;

INSERT INTO submission (assignment_id, student_id, teacher_courses_id)
VALUES 
(101, 101, 1),
(102, 102, 2),
(103, 103, 3),
(104, 104, 4);


CREATE TABLE files (
    file_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    submission_id INT NOT NULL,
    file_data LONGBLOB NOT NULL,
    FOREIGN KEY (submission_id) REFERENCES submission(submission_id)
);
ALTER TABLE files AUTO_INCREMENT = 101;

INSERT INTO files (submission_id, file_data)
VALUES (101, LOAD_FILE('C:/xampp/mysql/data/mysql_error.log'));

CREATE TABLE batch_students_semester (
    batch_year YEAR NOT NULL,
    student_id INT NOT NULL,
    semester_number SMALLINT NOT NULL,
    PRIMARY KEY (batch_year, student_id, semester_number),
    FOREIGN KEY (batch_year) REFERENCES batch(batch_year),
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (semester_number) REFERENCES semesters(semester_number)
);
INSERT INTO batch_students_semester(batch_year, semester_number, student_id)
VALUES
(2023,1,102),
(2023,1,103),
(2022,3,101),
(2022,3,104),
(2020,7,105);


//might need later codes

SELECT course_code, course_title FROM courses INNER JOIN teacher_courses USING (course_code) WHERE teacher_id=101 AND active_status=1;
SELECT course_code, course_title, semester_number FROM courses INNER JOIN batch USING (semester_number) WHERE semester_number=3;

//store teacher_id or student_id into a session named id
            if ($_SESSION['title'] == 'teacher'){
                $_SESSION['id'] = $details[0]['teacher_id'];
                $_SESSION['name'] = $details[0]['fname']." ".$details[0]['lname'];
            }
            else if ($_SESSION['title'] == 'student'){
                $_SESSION['id'] = $details[0]['student_id'];
                $_SESSION['name'] = $details[0]['fname']." ".$details[0]['lname'];
            }