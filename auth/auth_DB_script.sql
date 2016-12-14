start transaction;

create user 'egcajtk_egc1617'@'%' identified by password '*A4855D8518918866408D2F35AFAF572C45746AAA';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, REFERENCES, INDEX, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, TRIGGER ON *.* TO 'egcajtk_egc1617'@'%' IDENTIFIED BY PASSWORD '*A4855D8518918866408D2F35AFAF572C45746AAA' WITH GRANT OPTION;


CREATE DATABASE IF NOT EXISTS egcajtk_egcdb;
USE egcajtk_egcdb;
CREATE TABLE IF NOT EXISTS USERS(
	u_id INT AUTO_INCREMENT,
	username 	VARCHAR(30) NOT NULL,
	password 	VARCHAR(32) NOT NULL,
	email 	VARCHAR(30) NOT NULL,
	genre 	ENUM('Femenino','Masculino') NOT NULL,
	autonomous_community 	ENUM('Andalucia','Murcia','Extremadura','Castilla la Mancha','Comunidad Valenciana','Madrid','Castilla y Leon','Aragon','Cataluña','La Rioja','Galicia','Asturias','Cantabria','Pais Vasco','Navarra')NOT NULL,
	age 	TINYINT NOT NULL,
	PRIMARY KEY(U_ID));

INSERT INTO USERS VALUE(NULL, 'pabcargar2','6d722561cf386015cb1d7c1937806bb5','pabcargar2@alum.us.es','Masculino','Andalucia','22');
INSERT INTO USERS VALUE(NULL, 'julmayalv','69d597adc75eb3dd6bd50263d07ba7d0','julmayalv@alum.us.es','Masculino','Andalucia','22');
INSERT INTO USERS VALUE(NULL, 'josnavmar','9d9f2aad56b353eba0f1455e76ddb232','josnavmar@alum.us.es','Masculino','Andalucia','24');
INSERT INTO USERS VALUE(NULL, 'sercaroli','05091978bbc2a25dc311e825950aeb0f','sercaroli@alum.us.es','Masculino','Andalucia','22');
INSERT INTO USERS VALUE(NULL, 'fuerte94','e048609908aed7af5ffe60ad8c37fb2c','jorrodfue@alum.us.es','Masculino','Andalucia','22');
INSERT INTO USERS VALUE(NULL, 'aletormar','2a714a0e9c5af182865491b0969e5f60','aletormar@alum.us.es','Masculino','Andalucia','27');
COMMIT;
