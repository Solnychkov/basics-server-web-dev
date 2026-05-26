CREATE DATABASE IF NOT EXISTS notebook CHARACTER SET utf8 COLLATE utf8_general_ci;
USE notebook;

CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lastname  VARCHAR(100) NOT NULL,
    firstname VARCHAR(100) NOT NULL,
    patronymic VARCHAR(100),
    gender    ENUM('мужской','женский'),
    birthdate DATE,
    phone     VARCHAR(30),
    address   VARCHAR(255),
    email     VARCHAR(100),
    comment   TEXT
);
