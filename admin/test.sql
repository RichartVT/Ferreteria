CREATE TABLE cliente(
    id_cliente INT PRIMARY KEY,
    primer_apellido VARCHAR(50) NOT NULL,
    segundo_apellido VARCHAR(50),
    nombre VARCHAR(50) NOT NULL,
    rfc VARCHAR(13) DEFAULT "XXAX000000XXX"
);

CREATE TABLE empleado(
    id_empleado INT PRIMARY KEY,
    primer_apellido VARCHAR(50) NOT NULL,
    segundo_apellido VARCHAR(50),
    nombre VARCHAR(50) NOT NULL,
    rfc VARCHAR(13) NOT NULL,
    curp VARCHAR(18) NOT NULL
);

CREATE TABLE venta(
    id_venta INT PRIMARY KEY,
    id_tienda INT,
    id_empleado INT,
    id_cliente INT,
    fecha DATE DEFAULT NOW(),
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
    FOREIGN KEY (id_tienda) REFERENCES tienda(id_tienda),
    FOREIGN KEY (id_empleado) REFERENCES empleado(id_empleado)
);

CREATE TABLE venta_detalle(
    id_venta INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_venta) REFERENCES venta(id_venta),
    FOREIGN KEY (id_producto) REFERENCES producto(id_producto)
);

INSERT INTO producto (id_producto, producto, precio, id_marca, fotografia)
VALUES
(3, 'Martillo', 100.00, 1, 'cd1019cbc87d6e689956de49e5d2eeb7.jpg'),
(4, 'Pinzas', 45.00, 1, '34aceb1c1e47b8a6b20183a58edd9d26.jpg'),
(5, 'Rotomartillo', 420.00, 8, '65348c6a3d51c140028cbf758a66c5d8.jpg'),
(6, 'Cinta doble cara', 125.00, 7, '7233db0980d0f92fdc9e62593c9d2c23.png'),
(7, 'Llave para manguera', 58.00, 6, '6ac492a4bfd77a75c04b9af77d57ea15.jpg'),
(8, 'Lija de Agua', 10.00, 4, '205dc236a398839c0c6632ea38e9bf69.jpg'),
(9, 'Cinta metrica 8M', 250.00, 2, '1b322012c1c79d91b4bdf6a4c84425e9.jpeg');

INSERT INTO cliente (primer_apellido, segundo_apellido, nombre, rfc)
VALUES ('Ramirez', 'Mireles', 'Gustavo', 'RAMG990924IK8');

INSERT INTO empleado (primer_apellido, segundo_apellido, nombre, rfc, curp)
VALUES ('Maldonado', 'Patiño', 'Victoria', 'MAPV030427IK8', 'MAPV030427MGTLTCA4');

INSERT INTO venta 