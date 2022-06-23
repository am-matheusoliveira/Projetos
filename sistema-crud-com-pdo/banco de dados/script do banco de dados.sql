USE mysql;
DROP DATABASE IF EXISTS crudpdo;

CREATE DATABASE crudpdo
DEFAULT CHARACTER SET utf8mb4 
DEFAULT COLLATE utf8mb4_general_ci;

USE crudpdo;

CREATE TABLE Pessoa(
idPessoa    INT AUTO_INCREMENT,
Nome        VARCHAR(50) NOT NULL,
Telefone    VARCHAR(15),
Email    VARCHAR(50),
CONSTRAINT PRIMARY KEY(idPessoa) 
)DEFAULT CHARSET utf8mb4;

-- INSERT INTO Pessoa (nome, telefone, email) 
-- VALUES(' Nome ', ' Telefone', ' Email');
-- 
-- SELECT * FROM Pessoa;
-- WHERE Email = 'seu email aqui' AND idPessoa NOT IN(15);