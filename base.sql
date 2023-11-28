CREATE TABLE pizzas (
    id INT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    imagen VARCHAR(255),
    ingredientes TEXT,
    disponibilidad BOOLEAN NOT NULL
);

INSERT INTO Pizzas (id, nombre, descripcion, precio, imagen, ingredientes, disponibilidad) 
VALUES (
    7,
    'Combo Familiares',
    'dos pizza grandes con un refresco de 2 litros y cuatro helados de vainilla',
    200.00,
    'combo7.jpg',
    'muchos', 1 );

INSERT INTO Pizzas (id, nombre, descripcion, precio, imagen, ingredientes, disponibilidad) 
VALUES (
    7,
    'Combo Spaguetti',
    'una pizza grande con un refresco de 2 litros (PEPSI) y UN spaguetti',
    250.00,
    'combo7.jpg',
    'muchos', 1 );


-------------------------------------------------

CREATE TABLE administradores (
    id INT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    usuario VARCHAR(255) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

CREATE TABLE usuarios (
    id INT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    apellido VARCHAR(255) NOT NULL,
    correo VARCHAR(255) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    telefono VARCHAR(15),
    colonia VARCHAR(255),
    municipio VARCHAR(255),
    codigo_postal VARCHAR(10)
);

