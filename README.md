# project
4th sem project
git add. 
git commit -m "1st upload"
git remote add origin https://github.com/ksav002/project.git
git push -u origin main

//database creation for project
//create table
CREATE TABLE student(
	student_id SMALLINT PRIMARY KEY AUTO_INCREMENT,
	fname varchar(20),
    lname varchar(20),
    phone bigint,
    email varchar(40),
    username varchar(8),
    password char(255),
    dob date,
    age SMALLINT AS (TIMESTAMPDIFF(year,dob,CURRENT_DATE()))
);

//insert to check//md5 for encryption(secure lai)
INSERT INTO student (fname, lname, phone, email, username, password, dob)
VALUES 
    ('John', 'Doe', 1234567890, 'john@example.com', 'johndoe', MD5('password123'), '1990-05-15'),
    ('Jane', 'Smith', 9876543210, 'jane@example.com', 'janesmith', MD5('p@ssw0rd'), '1995-10-25'),
    ('Alice', 'Johnson', 5551234567, 'alice@example.com', 'alicej', MD5('securepassword'), '1988-12-01');

