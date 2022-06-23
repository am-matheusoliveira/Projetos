USE mysql;
DROP DATABASE IF EXISTS login; 

CREATE DATABASE login 
DEFAULT CHARACTER SET utf8mb4 
DEFAULT COLLATE utf8mb4_general_ci;

USE login;

CREATE TABLE usuario (
  Usuario VARCHAR(30) NOT NULL,
  Senha   VARCHAR(35) NOT NULL
) DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- me.matheus
-- c1907cad19c2aef55ef5ac461891531f