CREATE DATABASE senntcloud;
use senntcloud;

CREATE TABLE usuarios(
    id int(10) auto_increment not null,
    nombre varchar(100) not null,
    email varchar(100) not null,
    password varchar(100) not null,
    CONSTRAINT pk_usuario PRIMARY KEY(id)
);

ALTER TABLE usuarios ADD CONSTRAINT uq_email UNIQUE(email);