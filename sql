CREATE DATABASE gestion_automoviles;

USE gestion_automoviles;

CREATE TABLE propietario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    tipo_propietario ENUM('natural', 'juridico') NOT NULL,
    cedula VARCHAR(50) UNIQUE NOT NULL,
    telefono VARCHAR(15),
    direccion VARCHAR(255)
);

CREATE TABLE automovil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(30) UNIQUE NOT NULL,
    anio INT NOT NULL,
    color VARCHAR(30) NOT NULL,
    num_motor VARCHAR(60) UNIQUE NOT NULL,
    num_chasis VARCHAR(60) UNIQUE NOT NULL,
    tipo_id INT,
    marca_id INT,
    modelo_id INT,
    propietario_id INT,
    CONSTRAINT fk_propietario FOREIGN KEY (propietario_id) REFERENCES propietario(id),
    CONSTRAINT fk_automovil_marca FOREIGN KEY (marca_id) REFERENCES marca(id),
    CONSTRAINT fk_automovil_modelo FOREIGN KEY (modelo_id) REFERENCES modelo(id),
    CONSTRAINT fk_automovil_tipo FOREIGN KEY (tipo_id) REFERENCES tipo_vehiculo(id)
);

CREATE TABLE marca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_marca VARCHAR(50) NOT NULL,
);

CREATE TABLE modelo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_modelo VARCHAR(50) NOT NULL,
    marca_id INT,
    CONSTRAINT fk_modelo_marca FOREIGN KEY (marca_id) REFERENCES marca(id)
);

CREATE TABLE tipo_vehiculo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_tipo VARCHAR(50) NOT NULL
);


INSERT INTO marca (nombre_marca) VALUES
('Toyota'),
('Ford'),
('Honda'),
('Chevrolet'),
('Nissan'),
('Hyundai'),
('Kia'),
('Volkswagen'),
('Subaru'),
('Mazda'),
('BMW'),
('Mercedes-Benz'),
('Audi'),
('Lexus'),
('Porsche'),
('Jaguar'),
('Land Rover');

INSERT INTO modelo (nombre_modelo, marca_id) VALUES
('Corolla', 1), -- Toyota
('Camry', 1),   -- Toyota
('RAV4', 1),    -- Toyota
('F-150', 2),   -- Ford
('Mustang', 2), -- Ford
('Civic', 3),   -- Honda
('Accord', 3),  -- Honda
('Malibu', 4),  -- Chevrolet
('Silverado', 4), -- Chevrolet
('Altima', 5),  -- Nissan
('Sentra', 5),  -- Nissan
('Sonata', 6),  -- Hyundai
('Elantra', 6), -- Hyundai
('Sportage', 7), -- Kia
('Sorento', 7), -- Kia
('Jetta', 8),   -- Volkswagen
('Golf', 8),    -- Volkswagen
('Outback', 9), -- Subaru
('Forester', 9),-- Subaru
('CX-5', 10),   -- Mazda
('3', 10),      -- Mazda
('3 Series', 11), -- BMW
('X5', 11),     -- BMW
('C-Class', 12), -- Mercedes-Benz
('E-Class', 12), -- Mercedes-Benz
('A4', 13),     -- Audi
('Q5', 13),     -- Audi
('ES', 14),     -- Lexus
('RX', 14),     -- Lexus
('911', 15),    -- Porsche
('Cayenne', 15), -- Porsche
('XF', 16),     -- Jaguar
('F-PACE', 16), -- Jaguar
('Range Rover', 17), -- Land Rover
('Discovery', 17);   -- Land Rover

INSERT INTO tipo_vehiculo (nombre_tipo) VALUES
('Sedán'),
('Camioneta'),
('Camión'),
('Coupé'),
('Hatchback'),
('Convertible'),
('Monovolumen'),
('Pickup'),
('Deportivo');