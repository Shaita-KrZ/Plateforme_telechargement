--CREATE VIEW historique_achat_terminaux(Ressource, Application, Terminal)
--AS 
SELECT res as Ressource, app as Application, designation as Terminal
FROM Utilisateur U, ProduitAchete PA, Installe_sur INS, Terminal T, Modele M
WHERE U.idClient = 2 -- A remplacer par une variable
AND T.numero_serie =INS.terminal
AND PA.id = INS.produit
AND T.modele = M.id
AND PA.proprietaire = U.idClient;