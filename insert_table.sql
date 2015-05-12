INSERT INTO Editeur
VALUES(1, 'Ubisoft', 'Jean-Paul', 'ubisoft.com');
INSERT INTO Editeur
VALUES(2, 'EA', 'Arthur', 'ea.com');

INSERT INTO Utilisateur
VALUES(1, 'Lucas', 'Willemot');
INSERT INTO Utilisateur
VALUES(2, 'Valentin', 'Paul');
INSERT INTO Utilisateur
VALUES(3, 'Mathilde', 'Fau');
INSERT INTO Utilisateur
VALUES(4, 'Walyd', 'Shaita');
INSERT INTO Utilisateur
VALUES(5, 'Alaeddine', 'Hajjem');


INSERT INTO CartePrepayee
VALUES('00001', '2015-06-30', 100, 100, 1);
INSERT INTO CartePrepayee
VALUES('00002', '2015-07-30', 50, 50, 2);

INSERT INTO CarteBleue
VALUES('8549764853219456', '2017-04-30', '001');
INSERT INTO CarteBleue
VALUES('4579684523567458', '2016-04-15', '555');
INSERT INTO CarteBleue
VALUES('5588774412465879', '2018-12-08', '444');

INSERT INTO Transaction(id, montant, acheteur, destinataire, carte)
VALUES(1, 55.06, 1, 1, '00001');
INSERT INTO Transaction(id, montant, acheteur, destinataire, CB)
VALUES(2, 25, 2, 2, '8549764853219456');
INSERT INTO Transaction(id, montant, acheteur, destinataire, CB)
VALUES(3, 30, 2, 3, '8549764853219456');
INSERT INTO Transaction(id, montant, acheteur, destinataire, CB)
VALUES(4, 9.99, 5, 5, '5588774412465879');

INSERT INTO Application
VALUES('Angry Birds', 1, 'description d\'Angry Birds');
INSERT INTO Application
VALUES('94degrees', 1);
INSERT INTO Application
VALUES('CameraHD', 2, 'description de CameraHD');

INSERT INTO Ressource
VALUES('Cheat code Angry Birds', 1, 'Angry Birds');
INSERT INTO Ressource
VALUES('PhotoFilter', 2, 'CameraHD');

INSERT INTO Achat_simple_ressource
VALUES('Cheat code Angry Birds', 1, '2015-05-04');

INSERT INTO Achat_simple_app
VALUES('Angry Birds', 2, '2015-05-07');
INSERT INTO Achat_simple_app
VALUES('94degrees', 3, '2015-05-11');

INSERT INTO Avis
VALUES(2, 'Angry Birds', 4, 'Super jeu mais quelques bugs encore');

INSERT INTO Abonnement
VALUES('Angry Birds', 4, TRUE, 3, 3.99, '2015-05-12');

INSERT INTO OS
VALUES(1, 'Apple', 'iOS 8.1');
INSERT INTO OS
VALUES(2, 'Apple', 'iOS 7.2');
INSERT INTO OS
VALUES(3, 'Android', '4.5.1');
INSERT INTO OS
VALUES(4, 'Android', '4.4');

INSERT INTO Modele
VALUES(1, 'Apple', 'iPhone 6', 1);
INSERT INTO Modele
VALUES(2, 'Apple', 'iPhone 5', 2);
INSERT INTO Modele
VALUES(3, 'Samsumg', 'Galaxy S5', 3);
INSERT INTO Modele
VALUES(4, 'Samsung', 'Galaxy S4', 4);

INSERT INTO Terminal
VALUES('APPIPH601', 1, 5);
INSERT INTO Terminal
VALUES('APPIPH501', 2, 3);
INSERT INTO Terminal
VALUES('SAMSGALS501', 3, 1);
INSERT INTO Terminal
VALUES('SAMSGALS401', 4, 2);

INSERT INTO ProduitAchete(id, res, proprietaire)
VALUES(1, 'Cheat code Angry Birds', 1);
INSERT INTO ProduitAchete(id, app, proprietaire)
VALUES(2, 'Angry Birds', 2);
INSERT INTO ProduitAchete(id, app, proprietaire)
VALUES(3, '94degrees', 3);
INSERT INTO ProduitAchete(id, app, proprietaire)
VALUES(4, '94degrees', 1);

INSERT INTO Installe_sur
VALUES(1, 'SAMSGALS501');
INSERT INTO Installe_sur
VALUES(2, 'SAMSGALS401');
INSERT INTO Installe_sur
VALUES(3, 'APPIPH501');

INSERT INTO Ressource_disponible_pour
VALUES('Cheat code Angry Birds', 1);
INSERT INTO Ressource_disponible_pour
VALUES('Cheat code Angry Birds', 2);
INSERT INTO Ressource_disponible_pour
VALUES('Cheat code Angry Birds', 3);
INSERT INTO Ressource_disponible_pour
VALUES('PhotoFilter', 1);
INSERT INTO Ressource_disponible_pour
VALUES('PhotoFilter', 3);

INSERT INTO Application_disponible_pour
VALUES('Angry Birds', 1);
INSERT INTO Application_disponible_pour
VALUES('Angry Birds', 2);
INSERT INTO Application_disponible_pour
VALUES('Angry Birds', 3);
INSERT INTO Application_disponible_pour
VALUES('Angry Birds', 4);
INSERT INTO Application_disponible_pour
VALUES('94degrees', 1);
INSERT INTO Application_disponible_pour
VALUES('94degrees', 2);
INSERT INTO Application_disponible_pour
VALUES('94degrees', 3);
INSERT INTO Application_disponible_pour
VALUES('CameraHD', 1);
INSERT INTO Application_disponible_pour
VALUES('CameraHD', 3);
INSERT INTO Application_disponible_pour
VALUES('CameraHD', 4);