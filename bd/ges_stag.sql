-- GRANT ALL PRIVILEGES ON *.* TO 'php' @'localhost' IDENTIFIED BY '123456' WITH GRANT OPTION;
-- GRANT ALL PRIVILEGES ON *.* TO 'php' @'%' IDENTIFIED BY '123456' WITH GRANT OPTION;

DROP DATABASE IF EXISTS ges_stag;
CREATE DATABASE IF NOT EXISTS ges_stag;
USE ges_stag;


CREATE TABLE UTILISATEUR (
	ID int(4) AUTO_INCREMENT PRIMARY KEY,
	LOGIN VARCHAR(100) NOT NULL,
	PWD VARCHAR(255) NOT NULL,
	ROLE VARCHAR(50),
	EMAIL VARCHAR(255),
	ETAT INT(1)); 
-- 	ETAT = 0 désactivé
-- 	ETAT = 1 activé
		
CREATE TABLE STAGIAIRE (
	ID int(4) AUTO_INCREMENT PRIMARY KEY,
	NOM VARCHAR(50) NOT NULL,
	PRENOM VARCHAR(50) NOT NULL,
	ID_FILIERE int(4),
	PHOTO VARCHAR(50),
	CIVILITE VARCHAR(1),
	FRAIS_INSCRIPTION DOUBLE,
	FRAIS_MOIS DOUBLE,
	FRAIS_EXAMEN DOUBLE,
	FRAIS_DIPLOME DOUBLE);

CREATE TABLE FILIERE (                    
	ID int(4) AUTO_INCREMENT PRIMARY KEY, 
	NOM_FILIERE VARCHAR(100) NOT NULL,    
	NIVEAU VARCHAR(100) NOT NULL); 
	
ALTER TABLE STAGIAIRE ADD constraint fk10 foreign key(ID_FILIERE) references FILIERE(ID);


INSERT INTO FILIERE(NOM_FILIERE,NIVEAU,ID) VALUES
	('Actuaire','Doctorat',1),
	('Agent général','Doctorat',2),
	('Analyste de crédit','Master Spécialisé',3),
	('Guichetière','Licence',4),
	('Chargé de clientèle banque','Master',5),
	('Gérant de portefeuille','Licence',6);	
		
	
	
INSERT INTO UTILISATEUR VALUES 
	(1,'LAMIAE',md5('123'),'ADMIN','sebbarhlamiae22@gmail.com',1),
	(2,'user1',md5('123'),'VISITEUR','user1@gmail.com',1),
	(3,'user2',md5('123'),'VISITEUR','user2@gmail.com',1);	

INSERT INTO STAGIAIRE(NOM,PRENOM,ID_FILIERE,PHOTO,CIVILITE,FRAIS_INSCRIPTION,FRAIS_MOIS,FRAIS_EXAMEN,FRAIS_DIPLOME) VALUES
('SAADAOUI','MOHAMMED',1,'User.png','M',500,500,500,500),
	('CHKIRI','OMAR',2,'user_green.png','M',500,500,500,500),
	('SLIMANI','RACHIDA',3,'User.png','F',500,450,500,500),
	('FAOUZI','NABILA',4,'user_green.png','F',500,500,500,500),
	('ETTAOUSSI','KAMAL',5,'User.png','M',500,450,500,500),
	('EZZAKI','ABDELKARIM',6,'user_green.png','M',500,500,500,500),	
('SIDALI','MOHAMMED',2,'User.png','M',500,500,500,500),
	('CHMANI','BADR',3,'user_green.png','M',500,500,500,500),
	('SOLAHI','KENZA',4,'User.png','F',500,450,500,500),
	('FAKIR','OULAIA',5,'user_green.png','F',500,500,500,500),
	('RHMANI','KAMAL',6,'User.png','M',500,450,500,500),
	('EZZAKIT','ABDELKARIM',1,'user_green.png','M',500,500,500,500),	
('SALMI','MOHAMMED',3,'User.png','M',500,500,500,500),
	('CHKKODRI','ALAE',4,'user_green.png','M',500,500,500,500),
	('SLIMANI','RITA',5,'User.png','F',500,450,500,500),
	('DOUHI','RANIA',6,'user_green.png','F',500,500,500,500),
	('LAARBI','KAMAL',1,'User.png','M',500,450,500,500),
	('EZRKTOUNI','ADAM',2,'user_green.png','M',500,500,500,500);	

SELECT * FROM FILIERE;
SELECT * FROM STAGIAIRE;
SELECT * FROM UTILISATEUR;
				
-- SAUVGARDER UNE BASE DE DONNEE MYSQL
-- ouvrez l'invite de commande cmd
-- mysqldump -u root -p ges_stag > ges_stag.sql				
 