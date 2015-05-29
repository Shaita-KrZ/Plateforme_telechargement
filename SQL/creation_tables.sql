CREATE TABLE Editeur (
id 			INTEGER				PRIMARY KEY,
nom 		VARCHAR(20)			NOT NULL, 
contact 	VARCHAR(20)			NOT NULL,
url 		VARCHAR(30)			NOT NULL,
UNIQUE(nom, contact, url)
);

CREATE TABLE Utilisateur (
idClient 	SERIAL	PRIMARY KEY,
nom 		VARCHAR(20)			NOT NULL, 
prenom 		VARCHAR(20)			NOT NULL,
UNIQUE(nom, prenom)
);

CREATE TABLE CartePrepayee (
numero 			VARCHAR(16) 		PRIMARY KEY,
dateExpiration 	DATE 				NOT NULL, 
montantDepart 	REAL 				NOT NULL,
montantCourant 	REAL,
client 			INTEGER 			REFERENCES Utilisateur(idClient),
CHECK(montantDepart > 0),
CHECK(dateExpiration > CURRENT_DATE)
);

--Contrainte : PROJ(CartePrépayée,client)=PROJ(Utilisateur,IdClient)

CREATE TABLE CarteBleue ( 
numero 			VARCHAR(16) 		PRIMARY KEY,
dateExpiration 	DATE 				NOT NULL, 
cryptogramme 	INTEGER 			NOT NULL,
CHECK(dateExpiration > CURRENT_DATE)
);

CREATE TABLE Transaction (
id 				INTEGER 				PRIMARY KEY,
montant 		REAL					NOT NULL,
acheteur 		INTEGER					REFERENCES Utilisateur(idClient) NOT NULL,
destinataire 	INTEGER					REFERENCES Utilisateur(idClient) NOT NULL,
carte 			VARCHAR(16) 			REFERENCES CartePrepayee(numero),
CB 				VARCHAR(16) 			REFERENCES CarteBleue(numero),
CHECK(carte IS NOT NULL OR CB IS NOT NULL),
CHECK(montant >= 0)
);


CREATE TABLE Application (
nom 			VARCHAR(30) 		PRIMARY KEY,
editeur 		INTEGER				REFERENCES Editeur(id) NOT NULL,
description 	VARCHAR,
prix 			REAL				NOT NULL,
CHECK(prix >= 0)
);

CREATE TABLE Ressource (
nom 			VARCHAR(30) 		PRIMARY KEY,
editeur 		INTEGER				REFERENCES Editeur(id) NOT NULL,
app 			VARCHAR(30) 		REFERENCES Application(nom) NOT NULL,
description 	VARCHAR,
prix 			REAL				NOT NULL,
CHECK(prix >= 0)
);


CREATE TABLE Achat_simple_ressource (
ressource 		VARCHAR(30) 		REFERENCES Ressource(nom),
achat 			INTEGER 			REFERENCES Transaction(id),
dateAchat 		DATE 				NOT NULL,
PRIMARY KEY(ressource, achat)
);

CREATE TABLE Achat_simple_app (
app 			VARCHAR(30) 		REFERENCES Application(nom),
achat 			INTEGER 			REFERENCES Transaction(id),
dateAchat 		DATE 				NOT NULL,
PRIMARY KEY(app, achat)
);

CREATE TABLE Avis (
client 			INTEGER				REFERENCES Utilisateur(idClient),
app 			VARCHAR(30) 		REFERENCES Application(nom),
note 			INTEGER				CHECK(note > 0 AND note < 6),
commentaire 	VARCHAR(500),
PRIMARY KEY(client,app)
);

CREATE TABLE Abonnement (
app 			VARCHAR(30) 		REFERENCES Application(nom),
achat 			INTEGER 			REFERENCES Transaction(id),
automatique 	BOOLEAN,
nbMois 			INTEGER,
prixAbonnement 	REAL,
dateAbonnement 	DATE,
PRIMARY KEY(achat,app),
CHECK(prixAbonnement > 0)
--CHECK(nbMois NOT NULL if automatique = FALSE)
);

CREATE TABLE OS (
id 				INTEGER 			PRIMARY KEY,
constructeur 	VARCHAR(20)			NOT NULL,
version 		VARCHAR(10)			NOT NULL,
UNIQUE(constructeur, version)
);

CREATE TABLE Modele (
id 				INTEGER				PRIMARY KEY,
constructeur 	VARCHAR(20)			NOT NULL,
designation 	VARCHAR(20)			NOT NULL,
systeme 		INTEGER				REFERENCES OS(id) NOT NULL,
UNIQUE(constructeur, designation)
);

CREATE TABLE Terminal (
numero_serie 	VARCHAR(15) 		PRIMARY KEY,
modele 			INTEGER				REFERENCES Modele(id) NOT NULL,
proprietaire 	INTEGER				REFERENCES Utilisateur(idClient) NOT NULL
);

CREATE TABLE ProduitAchete (
id 				INTEGER				PRIMARY KEY,
res 			VARCHAR(30) 		REFERENCES Ressource(nom),
app 			VARCHAR(30) 		REFERENCES Application(nom),
proprietaire 	INTEGER				REFERENCES Utilisateur(idClient) NOT NULL,
CHECK(res IS NOT NULL OR app IS NOT NULL)
);

CREATE TABLE Installe_sur (
produit 		INTEGER				REFERENCES ProduitAchete(id) PRIMARY KEY,
terminal 		VARCHAR(15) 		REFERENCES Terminal(numero_serie)
);

CREATE TABLE Ressource_disponible_pour (
res 			VARCHAR(30) 		REFERENCES Ressource(nom),
systeme 		INTEGER				REFERENCES OS(id),
PRIMARY KEY (res, systeme)
);

CREATE TABLE Application_disponible_pour (
app 			VARCHAR(30) 		REFERENCES Application(nom),
systeme 		INTEGER				REFERENCES OS(id),
PRIMARY KEY (app, systeme)
);
