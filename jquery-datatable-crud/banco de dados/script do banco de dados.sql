USE mysql;
DROP DATABASE IF EXISTS course_db; 

CREATE DATABASE course_db 
DEFAULT CHARACTER SET utf8mb4 
DEFAULT COLLATE utf8mb4_general_ci;

USE course_db;

CREATE TABLE course (
  id INT NOT NULL AUTO_INCREMENT,
  course VARCHAR(100) NOT NULL,
  students varchar(50) DEFAULT NULL,
  PRIMARY KEY (id)
)DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;