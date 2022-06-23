USE mysql;
DROP DATABASE IF EXISTS dbcomments;

CREATE DATABASE dbcomments 
DEFAULT CHARACTER SET utf8mb4 
DEFAULT COLLATE utf8mb4_general_ci;

USE dbcomments;

CREATE TABLE comments (
  idcomment INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  comment VARCHAR(200) NOT NULL,
  PRIMARY KEY (idcomment)
)DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;