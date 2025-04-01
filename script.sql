CREATE DATABASE nomina_empleados;

USE nomina_empleados;

CREATE TABLE empleados (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    horas_extras INT DEFAULT 0,
    prestamo DECIMAL(10,2) DEFAULT 0,
    foto VARCHAR(255)
);