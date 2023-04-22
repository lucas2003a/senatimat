
-- PRODCEDIMIENTOS ALMACENADO PARA LA TABLA ESTUDIANTES

USE senatimat;

-- PROCEDIMIENTO PARA LISTAR ESTUDIANTES 

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_listar()
BEGIN
	
	SELECT 	EST.idestudiante,
				EST.apellidos, EST.nombres,
				EST.tipodocumento, EST.nrodocumento,
				EST.fechanacimiento,
				ESC.escuela,
				CAR.carrera,
				SED.sede,
				EST.fotografia
		FROM estudiantes EST
		INNER JOIN carreras CAR ON CAR.idcarrera = EST.idcarrera
		INNER JOIN sedes 	SED	ON SED.idsede = EST.idsede 
		INNER JOIN escuelas ESC ON ESC.idescuela = CAR.idescuela
		WHERE EST.estado = '1';
END $$


			
CALL spu_estudiantes_listar();


--  PROCEDIMIENTO PARA REGISTRAR ESTUDIANTES 

DELIMITER $$
CREATE PROCEDURE spu_estudiantes_registrar(
	IN apellidos_ 				VARCHAR(40),
	IN nombres_ 				VARCHAR(40),
	IN tipodocumento_ 		CHAR(1),
	IN nrodocumento_ 			CHAR(8),
	IN fechanacimiento_ 		DATE,
	IN idcarrera_ 				INT,
	IN idsede_ 					INT,
	IN fotografia_ 			VARCHAR(100)
)
BEGIN

	-- Validar el contenido de fotografía (CAMPO NULL)
	IF fotografia_ = '' THEN 
		SET fotografia_ = NULL;
	END IF;
	
	INSERT INTO estudiantes 
	(apellidos, nombres, tipodocumento, nrodocumento, fechanacimiento, idcarrera, idsede, fotografia) VALUES
	(apellidos_, nombres_, tipodocumento_, nrodocumento_, fechanacimiento_, idcarrera_, idsede_, fotografia_);
END $$
CALL spu_estudiantes_registrar('Yeren Carbajal', 'Margarita', 'D', '21819126', '1972-08-05', 5, 1, '');
SELECT * FROM estudiantes;


--  PROCEDIMIENTO PARA ELIMINAR ESTUDIANTES 
DELIMITER $$
CREATE PROCEDURE spu_estudiantes_eliminar(IN idestudiante_ INT)
BEGIN
	DELETE FROM estudiantes WHERE idestudiante = idestudiante_;
END $$
CALL spu_estudiantes_eliminar(5);


-- PROCEDIMIENTO PARA OBTENER FOTOGRAFÍA DEL ESTUDIANTE 

DELIMITER $$
CREATE PROCEDURE spu_obtener_fotografia(IN idestudiante_ INT)
BEGIN
	SELECT fotografia FROM estudiantes WHERE idestudiante = idestudiante_;
END $$
CALL spu_obtener_fotografia(1);


-- PROCEDIMIENTO PARA LISTAR SEDES PARA ESTUDIANTE Y COLABORADORES 

DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN
	SELECT * FROM sedes ORDER BY 2;
END $$


-- PROCEDIMEINTO PARA LISTAR ESCUELAS DE ESTUDIANTES 

DELIMITER $$
CREATE PROCEDURE spu_escuelas_listar()
BEGIN
	SELECT * FROM escuelas ORDER BY 2;
END $$
CALL spu_escuelas_listar();


-- PROCEDIMIENTO PARA LISTAR CARRERAS 

DELIMITER $$
CREATE PROCEDURE spu_carreras_listar(IN idescuela_ INT)
BEGIN
	SELECT idcarrera, carrera
	 FROM carreras
	 WHERE idescuela = idescuela_;
END $$



-- 	PROCEDIMIENTO ALMACENADO PARA LA TABLA COLABORADORES

--  PROCEDIMIENTO PARA LISTAR COLABORADORES 

DELIMITER $$
CREATE PROCEDURE spu_colaboradores_listar()
BEGIN
	SELECT 	COL.idcolaborador,
				COL.apellidos, COL.nombres,
				CARG.cargo,
				SED.sede,
				COL.telefono,
				COL.direccion,
				COL.tipocontrato, 
				COL.cv
	FROM colaboradores COL
	INNER JOIN cargos CARG ON CARG.idcargo = COL.idcargo
	INNER JOIN sedes 	SED  ON SED.idsede = COL.idsede
	WHERE COL.estado = '1';				
END$$
CALL spu_colaboradores_listar();


-- PROCEDIMIENTO PARA REGISTRAR COLABORADORES 

DELIMITER $$
CREATE PROCEDURE spu_colaboradores_registrar(
	IN apellidos_ 				VARCHAR(40),
	IN nombres_ 				VARCHAR(40),
	IN idcargo_				INT,
	IN idsede_ 				INT,
	IN telefono_ 				CHAR(9),
	IN direccion_				VARCHAR(40),
	IN tipocontrato_			CHAR(1),
	IN cv_ 					VARCHAR(100)
)
BEGIN
	-- VALIDACION DEL CONTENIDO CV (COMO CAMPO NULL)
	IF cv_ = '' THEN
		SET cv_ = NULL;
	END IF;
		
	INSERT INTO colaboradores
	(apellidos, nombres, idcargo, idsede, telefono, direccion, tipocontrato, cv) VALUES
	(apellidos_, nombres_, idcargo_, idsede_, telefono_, direccion_, tipocontrato_, cv_);
END $$
CALL spu_colaboradores_registrar('Francia Minaya','Jhon Edward',1,1, '956834915','Calle Colón - Pueblo Nuevo','C','');
SELECT * FROM colaboradores;


-- ACTUALIZAR COLABORADORES

DELIMITER $$
CREATE PROCEDURE spu_colaboradores_actualizar
(
	IN idcolaborador_			INT,
	IN apellidos_ 				VARCHAR(40),
	IN nombres_ 				VARCHAR(40),
	IN idcargo_				INT,
	IN idsede_ 				INT,
	IN telefono_ 				CHAR(9),
	IN direccion_				VARCHAR(40),
	IN tipocontrato_			CHAR(1),
	IN cv_ 					VARCHAR(100)
)
BEGIN
	UPDATE colaboradores SET
		apellidos = apellidos_,
		nombres = nombres_,
		idcargo = idcargo_,
		idsede = idsede_,
		telefono = telefono_,
		direccion = direccion_,
		tipocontrato = tipocontrato_,
		cv = cv_
	WHERE idcolaborador = idcolaborador_;
END$$

SELECT *FROM colaboradores WHERE idcolaborador = 6;
CALL spu_colaboradores_actualizar(6,'Atuncar','Lucas',4,4,'90367492','av.Snta Rosa #541','C','');


-- RECUPERAR
DELIMITER$$
CREATE PROCEDURE spu_colaboradores_recuperar_id(IN idcolaborador_ INT)
BEGIN
	SELECT * FROM colaboradores WHERE idcolaborador = idcolaborador_;
END$
CALL spu_colaboradores_recuperar_id(4)

-- PROCEDIMIENTO PARA ELIMINARCOLABORADORES
DELIMITER$$
CREATE PROCEDURE spu_colaboradores_eliminar(IN idcolaborador_ INT)
BEGIN
	DELETE FROM colaboradores WHERE idcolaborador = idcolaborador_;
END$
CALL spu_colaboradores_eliminar(2)


-- PROCEDIMIENTO PARA OBTENER CV DEL COLABORADOR 

DELIMITER $$
CREATE PROCEDURE spu_obtener_cv (IN idcolaborador_ INT)
BEGIN
  SELECT cv FROM colaboradores WHERE idcolaborador = idcolaborador_;
END $$
CALL spu_obtener_cv(14);


-- PROCEDIMIENTO PARA LSITAR CARGO DE LOS COLABORADORES 

DELIMITER $$
CREATE PROCEDURE spu_cargos_listar()
BEGIN
	SELECT * FROM cargos ORDER BY 2;
END $$
CALL spu_cargos_listar;


-- USSUARIOS
DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN nombreusuario_ VARCHAR(30))
BEGIN
	SELECT idusuario,
		nombreusuario,
		claveacceso,
		apellidos,
		nombres,
		nivelacceso
	FROM usuarios
	WHERE nombreusuario = nombreusuario_ AND estado = '1';
END$$

 CALL spu_usuarios_login('Jhon');

 --   REGISTRAR

DELIMITER $$
CREATE PROCEDURE usuario_registrar
(
	IN nombreusuario_	VARCHAR(30),
	IN claveacceso_		VARCHAR(30),
	IN apellidos_		VARCHAR(30),
	IN nombres_		VARCHAR(30)
)
BEGIN
	INSERT INTO usuarios (nombreusuario,claveacceso,apellidos,nombres)VALUES
		(nombreusuario_,claveacceso_,apellidos_,nombres_);
END $$

CALL usuario_registrar('PIeri','SENATI','Atuncar','Piero')

SELECT*FROM usuarios;