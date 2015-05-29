--CREATE VIEW Appli_dispo_terminal(AD.app)
--AS 
SELECT AD.app as Application
FROM Terminal T, Modele M, OS, Application_disponible_pour AD, Utilisateur U
WHERE T.modele = M.id
AND M.systeme = OS.id
AND AD.systeme = OS.id
AND U.idClient = T.proprietaire
AND U.idClient = 1; -- A remplacer par une variable 