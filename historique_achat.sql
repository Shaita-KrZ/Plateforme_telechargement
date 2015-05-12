SELECT res, app
FROM Utilisateur U, ProduitAchete PA
WHERE U.idClient = 3 --A remplacer par une variable
AND U.idClient = proprietaire;