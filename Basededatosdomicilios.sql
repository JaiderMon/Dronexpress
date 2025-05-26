CREATE DATABASE dronexpress;

USE dronexpress;

CREATE TABLE solicitudes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipo_solicitud VARCHAR(50),
    direccion_origen VARCHAR(255),
    direccion_destino VARCHAR(255),
    hora_estimada TIME,
    descripcion TEXT,
    fecha_solicitud TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
