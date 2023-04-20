CREATE DATABASE senatimat;
USE senatimat;

CREATE TABLE escuelas(
	idescuela 	INT AUTO_INCREMENT	PRIMARY KEY,
	escuela 	VARCHAR(50) 		NOT NULL,
	CONSTRAINT uk_escuela_esc UNIQUE (escuela)
)ENGINE = INNODB;

INSERT INTO escuelas (escuela) VALUES
	('ETI'), -- CLAVE 1
	('Administración'), -- CLAVE 2
	('Metal Mecánica'); -- CLAVE 3
SELECT * FROM escuelas ORDER BY 1;

CREATE TABLE carreras (
	idcarrera 			INT AUTO_INCREMENT 	PRIMARY KEY,
	idescuela			INT 								NOT NULL, -- FOREIGN KEY
	carrera				VARCHAR(100)		NOT NULL,
	CONSTRAINT fk_idescuela_car 	FOREIGN KEY (idescuela) REFERENCES escuelas (idescuela),
	CONSTRAINT uk_carrera_car 	UNIQUE(carrera)
)ENGINE =INNODB;

INSERT INTO carreras (idescuela, carrera) VALUES
	(1, 'Diseño Gráfico Digital'),
	(1, 'Ingeniería de Software con IA'),
	(1, 'Cyberseguridad'),
	(2, 'Administración de Empresas'),
	(2, 'Administración Industrial'),
	(2, 'Prevencionista de Riesgo'),
	(3, 'Soldador Universal'),
	(3, 'Mecánico de Mantenimiento'),
	(3, 'Soldador Estructuras Métalicas');
SELECT * FROM carreras ORDER BY 1;

-- CREACION DE LA TABLA SEDES
CREATE TABLE sedes (
	idsede 		INT AUTO_INCREMENT 	PRIMARY KEY,
	sede 		VARCHAR(40) 		NOT NULL,
	CONSTRAINT uk_sede_sde UNIQUE (sede)
)ENGINE = INNODB;

INSERT INTO sedes (sede) VALUES
	('Chincha'),
	('Pisco'),
	('Ica'),
	('Ayacucho');
SELECT * FROM sedes ORDER BY 1;

-- CREACIÓN DE LA TABLA ESTUDIANTES
CREATE TABLE estudiantes (
	idestudiante 		INT AUTO_INCREMENT 	PRIMARY KEY,
	apellidos 		VARCHAR(40)		NOT NULL,
	nombres 		VARCHAR(40) 		NOT NULL,
	tipodocumento 		CHAR(1)			NOT NULL DEFAULT 'D',
	nrodocumento		CHAR(8)			NOT NULL,
	fechanacimiento 	DATE 			NOT NULL,
	idcarrera 		INT 			NOT NULL,
	idsede 			INT 			NOT NULL,
	fotografia 		VARCHAR(100) 		NULL,
	fecharegistro 		DATETIME 		NOT NULL DEFAULT NOW(),
	fechaupdate 		DATETIME 		NULL,
	estado 			CHAR(1) 		NOT NULL DEFAULT '1',
	CONSTRAINT uk_nrodocumento_est 	UNIQUE (tipodocumento, nrodocumento),
	CONSTRAINT fk_idcarrera_est FOREIGN KEY (idcarrera) REFERENCES carreras (idcarrera),
	CONSTRAINT fk_idsede_est FOREIGN KEY (idsede) REFERENCES sedes (idsede)
)ENGINE = INNODB;

INSERT INTO estudiantes 
	(apellidos, nombres, nrodocumento, fechanacimiento, idcarrera, idsede) VALUES
	('Hernandez Yeren', 'Yorghet Fernanda', '72159736','2003-07-28', 1, 2),
	('Muñoz Quispe', 'Alonso Enrique','12356789','2003-07-18',4, 2),	
	('Pomachari Canto', 'Yareli Melissa', '60534815', '2003-12-24', 7, 3),
	('Nolberto Flores', 'Keysi', '159346789', '2004-01-04', 9, 4);

SELECT * FROM estudiantes;

-- CREACIÓN DE LA TABLA CARGOS
CREATE TABLE cargos (
	idcargo 	INT AUTO_INCREMENT 		PRIMARY KEY,
	cargo 		VARCHAR(30)			NOT NULL,
	CONSTRAINT uk_cargo_carg UNIQUE (cargo)
)ENGINE = INNODB;

INSERT INTO cargos (cargo) VALUES
	('Instructor'),
	('Jefe Centro'),
	('Asistente Administrativo'),
	('Asistente Académico'),
	('Coordinador ETI'),
	('Coordinador CIS');
SELECT * FROM cargos;

-- CREACION DE LA TABLA COLABORADORES
CREATE TABLE colaboradores (
	idcolaborador 		INT AUTO_INCREMENT 	PRIMARY KEY,
	apellidos 		VARCHAR(40) 		NOT NULL,
	nombres			VARCHAR(40) 		NOT NULL,
	idcargo 		INT 			NOT NULL, -- FOREIGN KEY
	idsede 			INT 			NOT NULL, -- FOREIGN KEY
	telefono		CHAR(9)			NOT NULL,
	direccion 		VARCHAR(40) 		NULL,
	tipocontrato		CHAR(1)			NOT NULL, -- CHECK P (parcial) C (completo)
	cv			VARCHAR(100)		NULL,
	fecharegistro 		DATETIME 		NOT NULL DEFAULT NOW(),
	fechaupdate 		DATETIME 		NULL,
	estado 			CHAR(1) 		NOT NULL DEFAULT '1',
	CONSTRAINT fk_idcargo_col			FOREIGN KEY (idcargo) REFERENCES cargos (idcargo),
	CONSTRAINT fk_idsede_sde 			FOREIGN KEY (idsede)  REFERENCES sedes (idsede),
	CONSTRAINT ck_tipocontrato_col	CHECK(tipocontrato IN ('P','C'))
)ENGINE = INNODB;

INSERT INTO colaboradores 
	(apellidos, nombres, idcargo, idsede, telefono, direccion, tipocontrato, cv) VALUES 
	('Bendezu Cardenas', 'Jose', 5, 1, '954837297', 'Calle Las Gardenias N° 120', 'C', NULL);


SELECT * FROM colaboradores;
