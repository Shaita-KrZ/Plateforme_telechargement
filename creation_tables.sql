CREATE TABLE Editeur (
id 			INTEGER(4) 			PRIMARY KEY,
nom 		VARCHAR(20), 
contact 	VARCHAR(20),
url 		VARCHAR(30),
UNIQUE NOT NULL (nom, contact, url)
);

CREATE TABLE Utilisateur (
idClient 	INTEGER(4) 			PRIMARY KEY,
nom 		VARCHAR(20), 
UNIQUE NOT NULL (nom, prénom)
);

CREATE TABLE CartePrepayee (
numero 			VARCHAR(16) 		PRIMARY KEY,
dateExpiration 	DATE 				NOT NULL, 
montantDepart 	REAL(6) 			NOT NULL,
montantCourant 	REAL(6),
client 			INTEGER(2) 			REFERENCES Editeur(id)
);

--Contrainte : PROJ(CartePrépayée,client)=PROJ(Utilisateur,IdClient)

CREATE TABLE CarteBleue ( 
numero 			VARCHAR(16) 		PRIMARY KEY,
dateExpiration 	DATE 				NOT NULL, 
cryptogramme 	INTEGER(3)			NOT NULL
);

CREATE TABLE Transaction (
id 				INTEGER 			PRIMARY KEY,
montant 		REAL(6)				NOT NULL,
acheteur 		INTEGER(4) 			REFERENCES Utilisateur(idClient) NOT NULL,
destinataire 	INTEGER(4) 			REFERENCES Utilisateur(idClient) NOT NULL,
carte 			INTEGER(10) 		REFERENCES CartePrepayee(numero),
CB 				INTEGER(10) 		REFERENCES CarteBleue(numero),
CHECK (carte IS NOT NULL OR CB IS NOT NULL)
);


CREATE TABLE Application (
nom 			VARCHAR(15) 		PRIMARY KEY,
editeur 		INTEGER(4) 			REFERENCES Editeur(id) NOT NULL,
description 	VARCHAR 
);
--est ce la peine de spécifier le NOT NULL quand clé étrangère ??

CREATE TABLE Ressource (
nom 			VARCHAR(15) 		PRIMARY KEY,
editeur 		INTEGER(4) 			REFERENCES Editeur(id) NOT NULL,
app 			VARCHAR(15) 		REFERENCES Application(nom) NOT NULL,
description 	VARCHAR
);


CREATE TABLE Achat_simple_ressource (
ressource 		VARCHAR(15) 		REFERENCES Ressource(nom),
achat 			INTEGER 			REFERENCES Transaction(id),
dateAchat 		DATE 				NOT NULL,
PRIMARY KEY(ressource, achat)
);

CREATE TABLE Achat_simple_app (
app 			VARCHAR(15) 		REFERENCES Application(nom),
achat 			INTEGER				REFERENCES Transaction(id),
dateAchat 		DATE 				NOT NULL,
PRIMARY KEY(app, achat)
);

CREATE TABLE Avis (
client 			INTEGER(4) 			REFERENCES Utilisateur(idClient),
app 			VARCHAR(15) 		REFERENCES Application(nom),
note 			INTEGER(1),
commentaire 	VARCHAR(500),
PRIMARY KEY(client,app)
--CHECK (note >1 AND note <5),
);

CREATE TABLE Abonnement (
app 			VARCHAR(15) 		REFERENCES Application(nom),
achat 			INTEGER				REFERENCES Transaction(id),
automatique 	BOOLEAN,
nbMois 			INTEGER(2),
prixAbonnement 	REAL(6),
dateAbonnement 	DATE,
PRIMARY KEY(achat,app),
CHECK(nbMois NOT NULL if automatique = FALSE)
);

CREATE TABLE OS (
id 				INTEGER(2) PRIMARY KEY,
constructeur 	VARCHAR(20),
version 		VARCHAR(10),
UNIQUE NOT NULL (constructeur, version)
);

CREATE TABLE Modele (
id 				INTEGER(4) 			PRIMARY KEY,
constructeur 	VARCHAR(20),
designation 	VARCHAR(20),
systeme 		INTEGER(2) 			REFERENCES OS(id) NOT NULL,
UNIQUE NOT NULL (constructeur, designation)
);

CREATE TABLE Terminal (
numero_serie 	VARCHAR(15) 		PRIMARY KEY,
modèle 			INTEGER(4) 			REFERENCES Modele(id) NOT NULL,
propriétaire 	INTEGER(4) 			REFERENCES Utilisateur(idClient) NOT NULL,
);

CREATE TABLE ProduitAchete (
id 				INTEGER(2) 			PRIMARY KEY,
res 			VARCHAR(15) 		REFERENCES Ressource(nom),
app 			VARCHAR(15) 		REFERENCES Application(nom),
propriétaire 	INTEGER(4)			REFERENCES Utilisateur(idClient) NOT NULL,
CHECK(res IS NOT NULL OR app IS NOT NULL)
);

CREATE TABLE Installe_sur (
produit 		INTEGER(2) 			REFERENCES ProduitAchete(id) PRIMARY KEY,
terminal 		VARCHAR(10) 		REFERENCES Terminal(numero_serie)
);

CREATE TABLE Ressource_disponible_pour (
res 			VARCHAR(15) 		REFERENCES Ressource(nom),
systeme 		INTEGER(2) 			REFERENCES OS(id),
PRIMARY KEY (res, systeme)
);

CREATE TABLE Application_disponible_pour (
app 			VARCHAR(15) 		REFERENCES Application(nom),
systeme 		INTEGER(2) 			REFERENCES OS(id),
PRIMARY KEY (app, systeme)
);





