-- Crea la base de datos si no existe
CREATE DATABASE IF NOT EXISTS copalina
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

-- Usa esa base de datos
USE copalina;

-- Tabla donde se guardan los usuarios
CREATE TABLE IF NOT EXISTS usuarios (
  -- Numero unico de cada usuario
  id            INT AUTO_INCREMENT PRIMARY KEY,
  -- Correo (no se puede repetir)
  email         VARCHAR(150) NOT NULL UNIQUE,
  nombre        VARCHAR(100) NOT NULL,
  apellido      VARCHAR(100) NOT NULL,
  -- Contrasena cifrada
  password_hash VARCHAR(255) NOT NULL,
  -- Fecha en que se creo la cuenta
  creado_en     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- TABLA: ofertas (productos o1 a o10)
-- ============================================================
CREATE TABLE IF NOT EXISTS ofertas (
  -- Numero unico de cada producto
  id         INT AUTO_INCREMENT PRIMARY KEY,
  -- Nombre del producto (no se puede repetir)
  nombre     VARCHAR(100) NOT NULL UNIQUE,
  -- Precio en pesos
  precio     DECIMAL(10,2) NOT NULL,
  -- Cuantas piezas hay disponibles
  stock      INT NOT NULL DEFAULT 10,
  -- Fecha en que se agrego el producto
  creado_en  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO ofertas (nombre, precio, stock) VALUES
  ('o1',  199.00, 10),
  ('o2',  249.00, 10),
  ('o3',  299.00, 10),
  ('o4',  349.00, 10),
  ('o5',  399.00, 10),
  ('o6',  449.00, 10),
  ('o7',  499.00, 10),
  ('o8',  549.00, 10),
  ('o9',  599.00, 10),
  ('o10', 649.00, 10);

-- ============================================================
-- TABLA: electronica (productos e1 a e10)
-- ============================================================
CREATE TABLE IF NOT EXISTS electronica (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  nombre     VARCHAR(100) NOT NULL UNIQUE,
  precio     DECIMAL(10,2) NOT NULL,
  stock      INT NOT NULL DEFAULT 10,
  creado_en  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO electronica (nombre, precio, stock) VALUES
  ('e1',  1200.00, 10),
  ('e2',  1500.00, 10),
  ('e3',  1800.00, 10),
  ('e4',  2100.00, 10),
  ('e5',  2400.00, 10),
  ('e6',  2700.00, 10),
  ('e7',  3000.00, 10),
  ('e8',  3300.00, 10),
  ('e9',  3600.00, 10),
  ('e10', 3900.00, 10);

-- ============================================================
-- TABLA: zapatos (productos z1 a z10)
-- ============================================================
CREATE TABLE IF NOT EXISTS zapatos (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  nombre     VARCHAR(100) NOT NULL UNIQUE,
  precio     DECIMAL(10,2) NOT NULL,
  stock      INT NOT NULL DEFAULT 10,
  creado_en  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO zapatos (nombre, precio, stock) VALUES
  ('z1',  450.00, 10),
  ('z2',  520.00, 10),
  ('z3',  590.00, 10),
  ('z4',  660.00, 10),
  ('z5',  730.00, 10),
  ('z6',  800.00, 10),
  ('z7',  870.00, 10),
  ('z8',  940.00, 10),
  ('z9',  1010.00, 10),
  ('z10', 1080.00, 10);

-- ============================================================
-- TABLA: motos (productos m1 a m10)
-- ============================================================
CREATE TABLE IF NOT EXISTS motos (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  nombre     VARCHAR(100) NOT NULL UNIQUE,
  precio     DECIMAL(10,2) NOT NULL,
  stock      INT NOT NULL DEFAULT 10,
  creado_en  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO motos (nombre, precio, stock) VALUES
  ('m1',  25000.00, 10),
  ('m2',  28000.00, 10),
  ('m3',  31000.00, 10),
  ('m4',  34000.00, 10),
  ('m5',  37000.00, 10),
  ('m6',  40000.00, 10),
  ('m7',  43000.00, 10),
  ('m8',  46000.00, 10),
  ('m9',  49000.00, 10),
  ('m10', 52000.00, 10);
